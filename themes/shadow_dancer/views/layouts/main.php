<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/buttons.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tables.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu_iestyles.css" />


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">
            <!--
            <div id="topnav">
                <div class="topnav_text"><a href='#'>Home</a> | <a href='#'>My Account</a> | <a href='#'>Settings</a> | <a href='#'>Logout</a> </div>
            </div>
            -->
            <div id="header">
                <div id="logo"><?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/logo.png", "JoinUO"), Yii::app()->homeUrl) ?></div>
            </div>
            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Home', 'url' => Yii::app()->homeUrl),
                        array('label' => 'Comments', 'url' => array('/comment/admin'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'History', 'url' => array('/history/admin'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Levels', 'url' => array('/level/admin'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Screenshots', 'url' => array('/screenshot/admin'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Shards', 'url' => array('/shard/admin'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Users', 'url' => array('/user/admin'), 'visible' => !Yii::app()->user->isGuest),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
            </div> <!--mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> JoinUO<br/>
                All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>