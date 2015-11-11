<?php
/* @var $this SiteController */
/* @var $model User */
?>
<?php $this->pageTitle = Yii::app()->name . ' - Manage Account'; ?>
<div id="post-wrapper">
    <?php if (Yii::app()->user->hasFlash('message')): ?>
        <div class="post">
            <?php echo Yii::app()->user->getFlash('message'); ?>
        </div>
    <?php endif; ?>
    <div class="post">
        <h1>Manage Account</h1>
        <?php $this->renderPartial('_form_account', array('model' => $model)); ?>
    </div>
    <div class="post">
        <h1>Change Avatar</h1>
        <p>
            <a href="http://gravatar.com/" target="_blank" title="Manage your avatar at Gravatar.com" style="float: right; margin-left: 20px;"><img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($model->email))) ?>?d=identicon&s=60" alt="" /></a>
            You avatar is bound to your email. Login o Signup at <a href="http://gravatar.com" target="_blank">Gravatar.com</a> using this email (<?php echo $model->email ?>) to change your avatar on this site.
        </p>
    </div>
    <div class="post">
        <h1>Delete Account</h1>
        <p>Clicking the button bellow will delete your account and all shards linked to it. Be careful.</p>
        <input type="button" onclick="javascript:confirmDelete();" value='DELETE ACCOUNT'>
        <script type="text/javascript">
            function confirmDelete()
            {
                var confirmed = confirm("Are you sure you want to delete your account and all shards linked to it?");
                if (confirmed)
                {
                    location.href = '<?php echo $this->createUrl('site/deleteaccount'); ?>';
                }
            }
        </script>
    </div>
</div>
<div id="sidebar">
    <?php echo Adsense::Sidebox(); ?>
    <?php echo Adsense::Sidebox(); ?>
</div>