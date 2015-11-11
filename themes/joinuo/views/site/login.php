<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>
<div id="post-wrapper">
    <div class="post">
        <h3>Login</h3>
        <div class="comment-form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>

            <div>
                <?php echo $form->labelEx($model, 'username'); ?><br/>
                <?php echo $form->textField($model, 'username'); ?>
                <?php echo $form->error($model, 'username'); ?>
            </div>

            <div>
                <?php echo $form->labelEx($model, 'password'); ?><br/>
                <?php echo $form->passwordField($model, 'password'); ?>
                <?php echo $form->error($model, 'password'); ?>
            </div>

            <div>
                <?php echo $form->checkBox($model, 'rememberMe', array('style' => 'display: inline; width: 16px;')); ?>
                <?php echo $form->label($model, 'rememberMe'); ?>
                <?php echo $form->error($model, 'rememberMe'); ?>
            </div>

            <div>
                <?php echo CHtml::submitButton('Login', array('style' => 'width: 50px !important; height: 34px !important;')); ?>
            </div>

            <?php $this->endWidget(); ?>

            <p>Don't have an account?</p>
            <p><?php echo CHtml::link('[Create a new one]', array('site/signup')) ?></p>
            <br/>
            <p>Forgot your password?</p>
            <p><?php echo CHtml::link('[Reset it now]', array('site/resetpassword')) ?></p>
        </div>
    </div>
</div>
<div id="sidebar">
    <?php echo Adsense::Sidebox(); ?>
</div>