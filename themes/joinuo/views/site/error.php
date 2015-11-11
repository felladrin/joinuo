<?php
$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
    'Error',
);
?>

<div id="post-wrapper">
    <div class="post">
        <h2>Error <?php echo $code; ?></h2>
        <p><?php echo $message; ?></p>
        <?php echo CHtml::link('[What happened?]', Yii::app()->homeUrl) ?>
    </div>
</div>
<div id="sidebar">
    <?php echo Adsense::Sidebox(); ?>
</div>