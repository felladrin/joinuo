<?php
/* @var $this SiteController */
/* @var $model User */
?>
<?php $this->pageTitle = Yii::app()->name . ' - Sign Up'; ?>
<div id="post-wrapper">
    <div class="post">
        <h1>Sign Up</h1>
        <?php $this->renderPartial('_form_account', array('model'=>$model)); ?>
    </div>
</div>
<div id="sidebar">
    <?php echo Adsense::Sidebox(); ?>
</div>