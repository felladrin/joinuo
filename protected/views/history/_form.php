<?php
/* @var $this HistoryController */
/* @var $model History */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'history-form',
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
        <?php echo $form->labelEx($model, 'clients'); ?>
        <?php echo $form->textField($model, 'clients', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'clients'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'items'); ?>
        <?php echo $form->textField($model, 'items', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'items'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'mobiles'); ?>
        <?php echo $form->textField($model, 'mobiles', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'mobiles'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'memory'); ?>
        <?php echo $form->textField($model, 'memory', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'memory'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'datetime'); ?>
        <?php echo $form->textField($model, 'datetime'); ?>
        <?php echo $form->error($model, 'datetime'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->