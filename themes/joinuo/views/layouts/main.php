<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" media="all" />
        <link rel="stylesheet" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/type/folks.css" />
        <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie7.css" media="all" />
        <![endif]-->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.5.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ddsmoothmenu.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scripts.js"></script>
    </head>

    <body>
        <div id="container"> 
            <div id="page-top">
                <div id="header-wrapper"> 
                    <div id="header">
                        <div id="logo">
                            <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/images/logo.png", "JoinUO"), Yii::app()->homeUrl); ?>
                        </div>
                        <div id="menu-wrapper">
                            <div id="smoothmenu1" class="ddsmoothmenu">
                                <?php
                                $this->widget('zii.widgets.CMenu', array(
                                    'items' => array(
                                        array('label' => 'Admin', 'url' => array('/shard/admin'), 'visible' => UserLevel::isAdmin()),
                                        array('label' => 'Home', 'url' => Yii::app()->homeUrl),
                                        array('label' => 'Random', 'url' => array('/shard/random'), 'visible' => Yii::app()->user->isGuest),
                                        array('label' => 'Account Management', 'url' => array('/site/account'), 'visible' => !Yii::app()->user->isGuest),
                                        array('label' => 'Shard Management', 'url' => array('/site/shards'), 'visible' => !Yii::app()->user->isGuest),
                                        array('label' => 'Forum', 'url' => array('/forum')),
                                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                                        array('label' => 'More »', 'items' => array(
                                                array('label' => 'Random', 'url' => array('/shard/random'), 'visible' => !Yii::app()->user->isGuest),
                                                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                                                array('label' => 'Contact', 'url' => array('/site/contact')),
                                                array('label' => 'Software', 'url' => array('/site/page', 'view' => 'software')),
                                            )
                                        ),
                                    ),
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="wrapper">
                <?php echo $content; ?>
            </div>

            <div class="clearfix"></div>
            <div class="push"></div>
        </div>

        <div id="footer-wrapper">
            <div id="footer">
                <div style='display: none'>
                    <script id="_waugzm">var _wau = _wau || []; _wau.push(["small", "vovc2vr1pdr0", "gzm"]);
                    (function() {var s=document.createElement("script"); s.async=true;
                    s.src="http://widgets.amung.us/small.js";
                    document.getElementsByTagName("head")[0].appendChild(s);
                    })();</script>
                </div>
                <div id="footer-content"> 
                    <div id="copyright">
                        <p>&copy; Copyright <?php echo date('Y'); ?> JoinUO | Ultima Online Freeshard Community</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>