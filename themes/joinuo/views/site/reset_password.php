<?php
$this->pageTitle = Yii::app()->name . ' - Reset Password';
?>
<div id="post-wrapper">
    <div class="post">
        <h3>Reset Password</h3>
        <div class="comment-form">
            <?php
            echo CHtml::beginForm();
            echo CHtml::label('Please, inform your email:','email');
            echo CHtml::textField('email');
            echo CHtml::submitButton('Reset', array('style' => 'width: 50px !important; height: 34px !important;'));
            echo CHtml::endForm();
            ?>
        </div>
    </div>
</div>
<div id="sidebar">
    <?php echo Adsense::Sidebox(); ?>
</div>