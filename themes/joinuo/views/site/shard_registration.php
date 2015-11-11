<?php
/* @var $this SiteController */
/* @var $model Shard */
?>
<?php $this->pageTitle = Yii::app()->name . ' - Shard Registration'; ?>
<div id="post-wrapper">
    <div class="post">
        <h1>Shard Registration</h1>
        <?php $this->renderPartial('_form_shard', array('model' => $model)); ?>
    </div>
</div>
<div id="sidebar">
    <?php echo Adsense::Sidebox(); ?>
    <?php echo Adsense::Sidebox(); ?>
</div>

