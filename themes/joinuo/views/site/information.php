<?php
$this->pageTitle = Yii::app()->name;
?>

<div id="post-wrapper">
    <div class="post">
        <h2><?php echo $title; ?></h2>
        <p><?php echo $message; ?></p>
    </div>
</div>
<div id="sidebar">
    <?php echo Adsense::Sidebox(); ?>
</div>