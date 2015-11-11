<?php
/* @var $this SiteController */
/* @var $data Shard */

$shardTitle = CHtml::encode($data->name) . " - " . CHtml::encode($data->emulator) . " shard running on " . CHtml::encode($data->era) . " Era";
?>

<div class="post">
    <?php if (!empty($data->banner_url)): ?>
    <a href="<?php echo $this->createUrl('shard/view', array('id' => $data->id)) ?>" style="display: block; max-height: 78px; overflow: hidden;" title="<?php echo $shardTitle; ?>">
        <img src="<?php echo CHtml::encode($data->banner_url); ?>" alt="<?php echo CHtml::encode($data->name); ?>" style="width: 100%;" />
    </a>
    <?php else: ?>
    <h2 class="title"><?php echo CHtml::link(CHtml::encode($data->name), array('shard', 'id' => $data->id), array('title' => $shardTitle)); ?></h2>
    <div class="top-border"></div>
    <?php endif; ?>
    <p style="margin-top: 10px;">
        <?php 
        if (strlen($data->description) > 165)
        {
            echo substr(CHtml::encode($data->description), 0, 165) . "... " . CHtml::link("Read More", array('shard', 'id' => $data->id));
        }
        else
        {
            echo CHtml::encode($data->description);
        }
        ?>
    </p>
    <table cellspacing="0" cellpadding="0">
        <tr>
            <th class="center" width="16%">Votes</th>
            <th class="center" width="16%">Online</th>
            <th class="center" width="16%">Peak</th>
            <th class="center">Era</th>
            <th class="center" width="16%">Hits</th>
            <th class="center" width="16%">Uptime</th>
        </tr>
        <tr>
            <td class="center"><?php echo CHtml::encode($data->votes); ?></td>
            <td class="center"><?php echo ($data->online) ? $data->clients_now : "<span style='color:darkred'>OFF</span>"; ?></td>
            <td class="center"><?php echo CHtml::encode($data->clients_peak); ?></td>
            <td class="center"><?php echo CHtml::encode($data->era); ?></td>
            <td class="center"><?php echo CHtml::encode($data->hits); ?></td>
            <td class="center">
            <?php
            if ($data->times_polled != 0)
            {
                echo round(($data->times_online / $data->times_polled) * 100, 2) . "%";
            }
            else
            {
                echo "0%";
            }
            ?>
            </td>
        </tr>
    </table>
</div>