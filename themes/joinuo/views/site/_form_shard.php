<?php
/* @var $this ShardController */
/* @var $model Shard */
/* @var $form CActiveForm */
?>

<div class="comment-form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'shard-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'host'); ?>
        <?php echo $form->textField($model, 'host', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'host'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'port'); ?>
        <?php echo $form->textField($model, 'port', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'port'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'emulator'); ?><br/>
        <?php
        echo $form->dropDownList($model, 'emulator', array(
            'RunUO' => 'RunUO',
            'Sphere' => 'Sphere',
            'POL' => 'POL',
            'Wolfpack' => 'Wolfpack'
        ));
        ?>
        <?php echo $form->error($model, 'emulator'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'era'); ?><br/>
        <?php
        echo $form->dropDownList($model, 'era', array(
            'Custom' => 'Custom',
            'PreT2A' => 'PreT2A',
            'T2A' => 'The Second Age',
            'UOR' => 'UO: Renaissance',
            'AOS' => 'Age of Shadows',
            'SE' => 'Samurai Empire',
            'ML' => 'Mondains Legacy',
            'SA' => 'Stygian Abyss',
            'HS' => 'High Seas'
        ));
        ?>
        <?php echo $form->error($model, 'era'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'website'); ?>
        <?php echo $form->textField($model, 'website', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'website'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'banner_url'); ?>
        <?php echo $form->textField($model, 'banner_url', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'banner_url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'feed_url'); ?>
        <?php echo $form->textField($model, 'feed_url', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'feed_url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'youtube_url'); ?>
        <?php echo $form->textField($model, 'youtube_url', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'youtube_url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'language'); ?>
        <?php echo $form->textField($model, 'language', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'language'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Register Shard' : 'Save Editions', array('style' => 'width: 105px !important; height: 34px !important;')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->