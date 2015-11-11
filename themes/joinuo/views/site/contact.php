<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<div id="comment-form" class="comment-form">
    <h1>Contact Us</h1>

    <?php if (Yii::app()->user->hasFlash('contact')): ?>

        <div class="note">
            <?php echo Yii::app()->user->getFlash('contact'); ?>
        </div>

    <?php else: ?>

        <p>Please fill out the following form to contact us. Thank you.</p><br/>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'contact-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>

        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'name'); ?>

        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'email'); ?>

        <?php echo $form->labelEx($model, 'subject'); ?>
        <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'subject'); ?>

        <?php echo $form->labelEx($model, 'body'); ?>
        <?php echo $form->textArea($model, 'body', array('rows' => 5, 'cols' => 30)); ?>
        <?php echo $form->error($model, 'body'); ?>

        <?php if (CCaptcha::checkRequirements()): ?>
            <?php echo $form->labelEx($model, 'verifyCode'); ?>
            <div>
                <?php $this->widget('CCaptcha'); ?>
                <br />
                <?php echo $form->textField($model, 'verifyCode'); ?>
            </div>
            <?php echo $form->error($model, 'verifyCode'); ?>
        <?php endif; ?>

        <?php echo CHtml::submitButton('Submit', array('style' => 'width: 60px !important; height: 34px !important;')); ?>

        <?php $this->endWidget(); ?>

    <?php endif; ?>
</div>