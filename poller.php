<?php
// Shard Poller created by Felladrin on February 9, 2014.

date_default_timezone_set('UTC');
error_reporting(true);
set_time_limit(300);

$executionPeriod = '4 minutes';
$resultFile = 'poller.html';

if (file_exists($resultFile))
{
    $fileEditionDatetime = date("Y-m-d H:i:s", filemtime($resultFile));
    $executionDatetimeThreshold = date("Y-m-d H:i:s", strtotime("-$executionPeriod", time()));
    if ($fileEditionDatetime > $executionDatetimeThreshold)
    {
        header("Location: $resultFile");
        die("The poller has already been executed in the last $executionPeriod.");
    }
}
else
{
    file_put_contents($resultFile, 'empty'); // Try to create a new empty result file.
    if (!file_exists($resultFile))
    {
        die("File '$resultFile' not found on this dir. Please create a empty one now.");
    }
}

class Database
{
    protected static $db;

    private function __construct()
    {
        $db_host = '';
        $db_name = '';
        $db_user = '';
        $db_pass = '';
        $db_driver = "mysql";

        try
        {
            self::$db = new PDO("$db_driver:host=$db_host; dbname=$db_name", $db_user, $db_pass);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db->exec('SET NAMES utf8');
        }
        catch (PDOException $e)
        {
            die("Connection Error: " . $e->getMessage());
        }
    }

    public static function connection()
    {
        if (!self::$db)
        {
            new Database();
        }

        return self::$db;
    }

}

$db = Database::connection();

$html = '<html><head><title>JoinUO Poller</title><meta charset="UTF-8"></head><body style="font-family: monospace">';

$queryArray = array();

$html .= ":: Started polling at " . date("Y-m-d H:i:s") . " (UTC) ::<br/><br/>";

$shards = $db->query("SELECT id, name, host, port, clients_peak FROM shard WHERE active = 1 ORDER BY online DESC, clients_now DESC")->fetchAll(PDO::FETCH_ASSOC);

$html .= '<table border="1" cellpadding="5" style="text-align: center; border-collapse: collapse;"><tr><th>Online</th><th>Shard Name</th></tr>';
    
foreach ($shards as $shard)
{
    // Variables to save on History table:
    $clients = $items = $mobiles = $memory = 0;
    $datetime = date("Y-m-d H:i:s");

    // Variables to save on Shard table:
    $online = false;

    // Variables to hold server response.
    $return = $errno = $errstr = "";
    $match = array();

    $con = @fsockopen($shard['host'], $shard['port'], $errno, $errstr, 2);

    if ($con)
    {
        $online = true; // If connection worked, we know the shard is online.

        stream_set_timeout($con, 3);
        @fwrite($con, "\x01\x00\x00\x00\xf1\x00\x04\xff"); // Sends the first packet sequence (acceptable by most shards).
        $return = fgets($con);
        fclose($con);

        if (empty($return))
        {
            $con = @fsockopen($shard['host'], $shard['port'], $errno, $errstr, 2);
            stream_set_timeout($con, 3);
            @fwrite($con, "\x7f\x00\x00\x7f\xf1\x00\x04\xff"); // Sends the second packet sequence.
            $return = fgets($con);
            fclose($con);
        }

        if (!empty($return))
        {
            unset($match[1]);
            preg_match('/Clients=([0-9]{1,})/', $return, $match); // Runuo & Sphere
            if (!empty($match[1]) && is_numeric($match[1]))
            {
                $clients = $match[1] - 1;
            }

            unset($match[1]);
            preg_match('/Items=([0-9]{1,})/', $return, $match); // Runuo & Sphere
            if (!empty($match[1]) && is_numeric($match[1]))
            {
                $items = $match[1];
            }

            unset($match[1]);
            preg_match('/Mobiles=([0-9]{1,})/', $return, $match); // Sphere & Old Runuo Versions
            if (!empty($match[1]) && is_numeric($match[1]))
            {
                $mobiles = $match[1];
            }
            else
            {
                preg_match('/Chars=([0-9]{1,})/', $return, $match); // Runuo
                $mobiles = $match[1];
            }

            unset($match[1]);
            preg_match('/Mem=([0-9]{1,})/', $return, $match); // Runuo & Sphere
            if (!empty($match[1]) && is_numeric($match[1]))
            {
                $memory = $match[1];
            }
        }
    }
    
    $html .= "<tr><td>" . ($online ? $clients : "OFF") . "</td><td>" . $shard['name'] . "</td></tr>"; // Prints the status of each shard.
    
    if (!$online) // If shard was off...
    {
        array_push($queryArray, "UPDATE shard SET online=0, times_polled=times_polled+1 WHERE id={$shard['id']}");
    }
    else // If shard was on...
    {
        $extraFields = ""; // Only used if clients peak record was broken.

        if ($clients > $shard['clients_peak'])
        {
            $extraFields = ", clients_peak='{$clients}', online_peak_datetime='{$datetime}'";
        }

        array_push($queryArray, "UPDATE shard SET online=1, clients_now='{$clients}', last_online='{$datetime}', times_polled=times_polled+1, times_online=times_online+1 {$extraFields} WHERE id={$shard['id']}");
    }

    // Adds the query for history table:
    array_push($queryArray, "INSERT INTO history SET shard_id={$shard['id']}, clients='{$clients}', items='{$items}', mobiles='{$mobiles}', memory='{$memory}', datetime='{$datetime}'");
}

// Deletes all history logs older than 7 days.
array_push($queryArray, "DELETE FROM history WHERE datetime < DATE_SUB(NOW(), INTERVAL 7 DAY)");

// Deletes users who have not activated their accounts for more than 7 days.
array_push($queryArray, "DELETE FROM user WHERE active = '0' AND banned = '0' AND join_date < DATE_SUB(NOW(), INTERVAL 7 DAY)");

// If it's the first day of month, we reset votes.
if (date("j") == 1 && date("G") == 0 && date("i") < 5)
{
    array_push($queryArray, "UPDATE shard SET votes = 0");
    array_push($queryArray, "UPDATE user SET last_vote = NULL");
}

$html .= '</table>';

$query = implode(';', $queryArray);

$db->query($query); // Updates shards on database.

$html .= "<br/>:: Finished polling at " . date("Y-m-d H:i:s") . " (UTC) ::<br/><br/>";

$html .= "</body></html>";

file_put_contents($resultFile, $html);

header("Location: $resultFile");