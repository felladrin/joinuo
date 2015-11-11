<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'comment-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'shard_id'); ?>
        <?php echo $form->dropDownList($model, 'shard_id', CHtml::listData(Shard::model()->findAll(), 'id', 'name'), array('empty' => '')); ?>
        <?php echo $form->error($model, 'shard_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
        <?php echo $form->dropDownList($model, 'user_id', CHtml::listData(User::model()->findAll(), 'id', 'username'), array('empty' => '')); ?>
        <?php echo $form->error($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'message'); ?>
        <?php echo $form->textArea($model, 'message', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'message'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'active'); ?>
        <?php echo $form->dropDownList($model, 'active', array('1' => 'Yes', '0' => 'No')); ?>
        <?php echo $form->error($model, 'active'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->