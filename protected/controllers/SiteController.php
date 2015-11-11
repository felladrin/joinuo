<?php

class SiteController extends Controller
{

    public function init()
    {
        Yii::app()->theme = 'joinuo';
    }

    public $layout = '//layouts/main';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $criteria1 = new CDbCriteria;
        $criteria1->compare('active', '1'); // Only returns active shards.
        $shardList = new CActiveDataProvider('Shard', array(
            'criteria' => $criteria1,
            'pagination' => array(
                'pageSize' => 10,
            ),
            'sort' => array('defaultOrder' => 'votes DESC')
        ));

        $criteria2 = new CDbCriteria;
        $criteria2->compare('active', '1'); // Only returns active shards.
        $criteria2->order = 'id DESC';
        $criteria2->limit = 5;
        $latestShards = new CActiveDataProvider('Shard', array(
            'criteria' => $criteria2,
            'pagination' => false
        ));

        $criteria3 = new CDbCriteria;
        $criteria3->compare('active', '1'); // Only returns active comments.
        $criteria3->order = 'id DESC';
        $criteria3->limit = 4;
        $recentComments = new CActiveDataProvider('Comment', array(
            'criteria' => $criteria3,
            'pagination' => false
        ));

        $criteria4 = new CDbCriteria;
        $criteria4->compare('active', '1'); // Only returns active screenshots.
        $criteria4->order = 'RAND()';
        $criteria4->limit = 6;
        $randomScreenshots = new CActiveDataProvider('Screenshot', array(
            'criteria' => $criteria4,
            'pagination' => false
        ));

        $randomShardWithTeaser = Shard::model()->find("youtube_url != '' AND youtube_url IS NOT NULL ORDER BY RAND()");

        $shardOfTheMoment = Shard::model()->findByAttributes(array('premium' => '1'), array('order' => 'RAND()'));

        if (empty($shardOfTheMoment))
        {
            $shardOfTheMoment = Shard::model()->find("banner_url != '' AND banner_url IS NOT NULL ORDER BY RAND()");
        }
        
        $onlineShards = Shard::model()->countByAttributes(array('online' => '1'));
        
        $totalShards = Shard::model()->count();
        
        $totalPlayers = Yii::app()->db->createCommand("SELECT SUM(clients_now) as count FROM shard WHERE active = 1")->queryScalar();

        $this->render('index', array(
            'shardList' => $shardList,
            'latestShards' => $latestShards,
            'recentComments' => $recentComments,
            'randomScreenshots' => $randomScreenshots,
            'shardOfTheMoment' => $shardOfTheMoment,
            'shardWithTeaser' => $randomShardWithTeaser,
            'youtubeID' => self::getYoutubeID($randomShardWithTeaser->youtube_url),
            'onlineShards' => $onlineShards,
            'totalShards' => $totalShards,
            'totalPlayers' => $totalPlayers,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        // For now, we will just redirect users to homepage when they access an wrong page.
        $this->redirect(Yii::app()->homeUrl);
        /*
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
        */
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm']))
        {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate())
            {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode("[JoinUO] " . $model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;
        
        if (isset($_GET['activation'])) // If use came from Account Activation Link...
        {
            $userEmail = Encryption::decode($_GET['activation']);
            
            $userToActivate = User::model()->findByAttributes(array('email' => $userEmail));
            
            if (!empty($userToActivate))
            {
                $userToActivate->active = 1;
                $userToActivate->save();
            }
            
            $model->username = $userEmail;
        }

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
            {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionSignUp()
    {
        $model = new User;

        if (isset($_POST['User']))
        {
            $model->attributes = $_POST['User'];
            $model->level_id = 2; // Level: User.
            $model->password = Bcrypt::hash($model->password);
            $model->join_date = date("Y-m-d H:i:s");
            $model->banned = 0;
            $model->active = 0; // New users are inactive till they verify their email.
            if ($model->save())
            {
                // Auto Login user after account creation
                /*
                  $identity = new UserIdentity($model->username, $model->password);
                  $identity->setId($model->id); // had to add WebUser::setId() since WebUser::$_id is private
                  $identity->setState('level', $model->level->name);
                  $identity->errorCode = UserIdentity::ERROR_NONE;
                  Yii::app()->user->login($identity, 0); // "Remember me" disabled.
                 */

                $activationURL = Yii::app()->createAbsoluteUrl('site/login', array('activation' => Encryption::encode($model->email)));
                
                $to = $model->email;

                // subject
                $subject = '[JoinUO] Account Activation Link';

                // message
                $message = '
                <html>
                <head>
                    <title>Account Activation Link from JoinUO</title>
                </head>
                <body>
                    <p>Hello,</p>
                    <p>
                        Here is your Account Activation Link:<br/>
                        <a href="'. $activationURL .'">'. $activationURL .'</a>
                    </p>
                    <p>All you need to do is to click and login to your account.</p>
                    <p>
                        Best Regards,<br/>
                        JoinUO Team
                    </p>
                </body>
                </html>
                ';

                // To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                // Additional headers
                $headers .= 'From: JoinUO <' . Yii::app()->params['adminEmail'] . '>' . "\r\n";

                // Mail it
                mail($to, $subject, $message, $headers);
                
                $this->render('information', array(
                    'title' => 'Activation Email Sent',
                    'message' => "We've sent you an e-mail with an account activation link. You'll only be able to login after clicking that link.",
                    ));
            }
        }

        $this->render('signup', array(
            'model' => $model,
        ));
    }

    public function actionResetPassword()
    {
        if (isset($_POST['email']))
        {
            /** @var $user User */
            $user = User::model()->findByAttributes(array('email' => $_POST['email']));

            if (empty($user))
            {
                $this->render('information', array(
                    'title' => 'Oops!',
                    'message' => "We couldn't find any user with this email ({$_POST['email']}). Did you write it correctly?",
                ));
            }
            else
            {
                $randomPass = substr(strtoupper(md5(rand())), 0, 5); // The new password consists of the first 5 characters of a random md5 hash in upper case.
                $user->password = Bcrypt::hash($randomPass);

                if ($user->save())
                {
                    $loginURL = Yii::app()->createAbsoluteUrl('site/login');

                    $to = $user->email;

                    // subject
                    $subject = '[JoinUO] Password Reset';

                    // message
                    $message = '
                    <html>
                    <head>
                        <title>Password Reset</title>
                    </head>
                    <body>
                        <p>Hello,</p>
                        <p>We\'ve generated a new password for you to <a href="'. $loginURL .'">login on JoinUO</a>.</p>
                        <p>Your new password is: <b>'. $randomPass .'</b></p>
                        <p>Please, change you password for a custom one once you login.</p>
                        <p>
                            Best Regards,<br/>
                            JoinUO Team
                        </p>
                    </body>
                    </html>
                    ';

                    // To send HTML mail, the Content-type header must be set
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

                    // Additional headers
                    $headers .= 'From: JoinUO <' . Yii::app()->params['adminEmail'] . '>' . "\r\n";

                    // Mail it
                    mail($to, $subject, $message, $headers);

                    $this->render('information', array(
                        'title' => 'Password Reset Email Sent',
                        'message' => "We've sent you an e-mail with a new temporary password.",
                    ));
                }
            }
        }
        else
        {
            $this->render('reset_password');
        }
    }

    public function actionAccount()
    {
        if (Yii::app()->user->isGuest)
        {
            $this->redirect(array('site/login'));
        }
        else
        {
            $model = User::model()->findByPk(Yii::app()->user->id);

            if (isset($_POST['User']))
            {
                $oldPassword = $model->password;

                $model->attributes = $_POST['User'];

                if (!Bcrypt::check($model->password, $oldPassword)) // If current password is not the same as the old...
                {
                    $model->password = Bcrypt::hash($model->password); // We hash it again before saving.
                }

                if ($model->save())
                {
                    Yii::app()->user->setFlash('message', 'Account details changed successful!');
                }
            }

            $this->render('manage_account', array(
                'model' => $model,
            ));
        }
    }

    public function actionDeleteAccount()
    {
        $model = User::model()->findByPk(Yii::app()->user->id);

        if (is_null($model) || Yii::app()->user->isGuest) // If user is not logged in or user is not the owner of the account...
        {
            $this->redirect(array('site/login'));
        }
        else
        {
            $model->delete();
            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    public function actionShards()
    {
        if (Yii::app()->user->isGuest)
        {
            $this->redirect(array('site/login'));
        }
        else
        {
            $criteria1 = new CDbCriteria;
            $criteria1->compare('active', '1'); // Only returns active shards.
            $criteria1->compare('user_id', Yii::app()->user->id); // Only returns shards that belongs to the current user.
            $criteria1->order = 'votes DESC';
            $userShards = new CActiveDataProvider('Shard', array(
                'criteria' => $criteria1,
                'pagination' => array(
                    'pageSize' => 5,
                ),
            ));

            $this->render('manage_shards', array(
                'userShards' => $userShards
            ));
        }
    }

    public function actionShardEdition($id)
    {
        $model = Shard::model()->findByPk($id);

        if (Yii::app()->user->isGuest || $model->user_id != Yii::app()->user->id) // If user is not logged in or user is not the owner of the shard...
        {
            $this->redirect(array('site/login'));
        }
        else
        {
            if (isset($_POST['Shard']))
            {
                $model->attributes = $_POST['Shard'];
                $model->website = (strpos($model->website, '://') === false) ? 'http://' . $model->website : $model->website; // Adds "http://" when necessary.
                $model->description = substr($model->description, 0, 1000); // Maximum shard description lenth: 1000 characters.

                if ($model->save())
                {
                    $this->redirect(array('shard', 'id' => $model->id));
                }
            }

            $this->render('shard_edition', array(
                'model' => $model,
            ));
        }
    }

    public function actionShardRegistration()
    {
        if (Yii::app()->user->isGuest) // If user is not logged in...
        {
            $this->redirect(array('site/login'));
        }
        else
        {
            $model = new Shard;

            if (isset($_POST['Shard']))
            {
                $currentDateTime = date("Y-m-d H:i:s");

                $model->attributes = $_POST['Shard'];
                $model->website = (strpos($model->website, '://') === false) ? 'http://' . $model->website : $model->website; // Adds "http://" when necessary.
                $model->description = substr($model->description, 0, 1000); // Maximum shard description lenth: 1000 characters.
                $model->user_id = Yii::app()->user->id;
                $model->join_date = $currentDateTime;
                $model->online = 1;
                $model->clients_now = 0;
                $model->clients_peak = 0;
                $model->online_peak_datetime = $currentDateTime;
                $model->last_online = $currentDateTime;
                $model->times_polled = 1;
                $model->times_online = 1;
                $model->votes = 0;
                $model->hits = 0;
                $model->premium = 0;
                $model->premium_expiration = $currentDateTime;
                $model->active = 1;

                if ($model->save())
                {
                    $this->redirect(array('shard', 'id' => $model->id));
                }
            }

            $this->render('shard_registration', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionShard($id)
    {
        $model = Shard::model()->findByPk($id);

        if (empty($model))
        {
            $this->redirect(Yii::app()->homeUrl);
        }
        else
        {
            // ADD 1 HIT ON THIS SHARD:
            $model->hits++;
            $model->save();

            // GET COMMENTS:
            $criteriaComments = new CDbCriteria;
            $criteriaComments->compare('shard_id', $id);
            $criteriaComments->compare('active', 1);
            $criteriaComments->order = 'id DESC'; // This line makes comments show up in reverse order.
            $shardComments = new CActiveDataProvider('Comment', array(
                'criteria' => $criteriaComments,
                'pagination' => array(
                    'pageSize' => 5,
                ),
            ));

            // GET SCREENSHOTS:
            $criteriaScreenshots = new CDbCriteria;
            $criteriaScreenshots->compare('shard_id', $id);
            $shardScreenshots = new CActiveDataProvider('Screenshot', array(
                'criteria' => $criteriaScreenshots,
            ));
            
            $historyClients = '';
            
            $history = History::model()->findAllByAttributes(array('shard_id' => $id), array('order' => 'id DESC' /*, 'limit' => 1000 */));
            foreach ($history as $h)
            {
                $historyClients .= "[new Date('{$h['datetime']}'), {$h['clients']}],";
            }

            // RENDERS PAGE:
            $this->render('shard', array(
                'model' => $model,
                'shardComments' => $shardComments,
                'shardScreenshots' => $shardScreenshots,
                'youtubeID' => self::getYoutubeID($model->youtube_url),
                'news' => self::getFeed($model->feed_url),
                'historyClients' => $historyClients,
            ));
        }
    }

    public function actionShardDeletion($id)
    {
        $model = User::model()->findByPk(Yii::app()->user->id);
        $shardToDelete = Shard::model()->findByPk($id);

        if (empty($model) || Yii::app()->user->isGuest) // If user is not logged in...
        {
            $this->redirect(array('site/login'));
        }
        else if (Yii::app()->user->id != $shardToDelete->user_id) // Or user is not the owner of the shard..
        {
            $this->redirect(Yii::app()->homeUrl);
        }
        else
        {
            $shardToDelete->delete();
            $this->redirect(array('site/shards'));
        }
    }

    public function actionShardVoting($id)
    {
        $shard = Shard::model()->findByPk($id);

        if (empty($shard)) // If the shard does not existe, return user to homepage.
        {
            $this->redirect(Yii::app()->homeUrl);
        }

        if (Yii::app()->user->isGuest) // Verifies if user is logged in.
        {
            $message = 'You need to ' . CHtml::link('[log in]', array('site/login')) . ' or ' . CHtml::link('[sign up]', array('site/signup')) . ' before voting.';
            Yii::app()->user->returnUrl = Yii::app()->request->url; // Keep track of the most recently visited valid url.
        }
        else
        {
            $user = User::model()->findByPk(Yii::app()->user->id);

            if (time() - strtotime($user->last_vote) > 60 * 60 * 24) // Check if last user's vote is older then 1 day.
            {
                $shard->votes++;
                $shard->save();

                $user->last_vote = date("Y-m-d H:i:s");
                $user->save();

                $message = "You have successfully voted on " . $shard->name . " under this account (" . Yii::app()->user->name . "). Come back in 24 hours to vote again!";
            }
            else
            {
                $message = "You have already voted on a shard in the last 24 hours. Come back later.";
            }
        }

        $this->render('vote', array(
            'shard' => $shard,
            'message' => $message,
        ));
    }

    public function actionAddScreenshot()
    {
        $model = new Screenshot;

        if (isset($_POST['screenshot_url']))
        {
            $model->filename = $_POST['screenshot_url'];
            $model->shard_id = $_POST['screenshot_shard_id'];
            $model->active = 1;

            // Can only add screenshot if is the shard owner:
            $whatShard = Shard::model()->findByPk($model->shard_id);
            if (Yii::app()->user->id != $whatShard->user_id)
            {
                $this->redirect(Yii::app()->homeUrl);
            }
            else
            {
                if ($model->save())
                {
                    $this->redirect(array('ShardEdition', 'id' => $whatShard->id));
                }
            }
        }
    }

    public function actionDeleteScreenshot($id)
    {
        $screenshot = Screenshot::model()->findByPk($id);

        // Can only delete screenshot if is the shard owner:
        $whatShard = Shard::model()->findByPk($screenshot->shard_id);
        if (Yii::app()->user->id != $whatShard->user_id)
        {
            $this->redirect(Yii::app()->homeUrl);
        }
        else
        {
            $screenshot->delete();
            $this->redirect(array('ShardEdition', 'id' => $whatShard->id));
        }
    }

    public static function getYoutubeID($youtube_url)
    {
        $pattern = '~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i';
        $youtube_id = preg_replace($pattern, '$1', $youtube_url);
        return $youtube_id;
    }

    public static function getFeed($url)
    {
        if (empty($url))
        {
            return array();
        }
        
        $feed = @simplexml_load_file($url);

        if (empty($feed))
        {
            return array();
        }
        
        $feed_array = array();
        foreach ($feed->channel->item as $story)
        {
            $story_array = array(
                'title' => $story->title,
                'desc' => $story->description,
                'link' => $story->link,
                'date' => $story->pubDate
            );

            array_push($feed_array, $story_array);
        }

        $only_latest = array_slice($feed_array, 0, 5);

        return $only_latest;
    }

    public function actionPremium($id)
    {
        $shard = Shard::model()->findByPk($id);

        if (is_null($shard))
        {
            $this->redirect(Yii::app()->homeUrl);
        }

        $e = new ExpressCheckout;

        $products = array(
            '0' => array(
                'NAME' => 'JoinUO 30-Day Premium Membership For ' . $shard->name,
                'AMOUNT' => '30.00',
                'QTY' => 1
            ),
        );

        $e->setProducts($products); /* Set array of products */

        $e->returnURL = Yii::app()->createAbsoluteUrl("site/PremiumSuccess", array('id' => $id));

        $e->cancelURL = Yii::app()->createAbsoluteUrl("site/PremiumCancel", array('id' => $id));

        $result = $e->requestPayment();

        if (strtoupper($result["ACK"]) == "SUCCESS")
        {
            header("location:" . $e->PAYPAL_URL . $result["TOKEN"]); // Redirect to the paypal gateway with the given token 
        }
    }

    public function actionPremiumSuccess($id)
    {
        $e = new ExpressCheckout;
        $paymentDetails = $e->getPaymentDetails($_REQUEST['token']); // Get payment details by using the given token

        if (strtoupper($paymentDetails['ACK']) == "SUCCESS") // If payment details are ok...
        {
            $shard = Shard::model()->findByPk($id);

            if (!is_null($shard))
            {
                $ack = $e->doPayment($paymentDetails); // Do payment

                if (strtoupper($ack['ACK']) == "SUCCESS") // If payment was successful...
                {
                    if ($shard->premium_expiration > date('Y-m-d H:i:s')) // If premium has not expirated yet, we just add 30 days to that date...
                    {
                        $shard->premium_expiration = date('Y-m-d H:i:s', strtotime($shard->premium_expiration . ' + 30 days'));
                    }
                    else
                    {
                        $shard->premium_expiration = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 30 days'));
                    }

                    $shard->premium = 1;
                    $shard->save();

                    $transaction = new Paypal;
                    $transaction->shard_id = $id;
                    $transaction->amt = $ack['AMT']; // Sample value: 15.00
                    $transaction->transactionid = $ack['TRANSACTIONID']; // Sample value: 7S255873FM437633X
                    $transaction->ordertime = $ack['ORDERTIME']; // Sample value: 2013-12-12T11:57:17Z
                    $transaction->save();

                    // TODO: Render some page telling user that his shard has been set to premium.
                    $this->redirect(array('site/shardedition', 'id' => $id));
                }
            }
        }
    }

    public function actionPremiumCancel($id)
    {
        // If user cancels the payment, take him back to shard edition...
        $this->redirect(array('site/shardedition', 'id' => $id));
    }

}
