<?php
/* @var $this SiteController */
/* @var $model Shard */
?>
<?php $this->pageTitle = Yii::app()->name . ' - Shard Edition'; ?>
<div id="post-wrapper">
    <div class="post">
        <h1>Shard Edition</h1>
        <?php $this->renderPartial('_form_shard', array('model' => $model)); ?>
    </div>
</div>
<div id="sidebar">
    <div class="sidebox">
        <h3>Premium Membership</h3>
        <?php
        if ($model->premium)
        {
            echo '<p>';
            echo 'Status: <b>Active</b><br/>';
            echo 'Expires On: <b>' . date("Y-m-d H:i", strtotime($model->premium_expiration)) . '</b><br/>';
            echo 'Time Now: <b>' . date("Y-m-d H:i") . '</b>';
            echo '</p>';
            echo CHtml::link('[Add 30 Days to Premium Membership]', array('site/premium', 'id' => $model->id));
        }
        else
        {
            echo '<p>';
            echo 'Status: <b>Inactive</b>';
            echo '</p>';
            echo CHtml::link('[Adquire a 30-Day Premium Membership]', array('site/premium', 'id' => $model->id));
        }
        ?>
    </div>
    <div class="sidebox">
        <h3>Add Screenshot</h3>
        <?php
        echo CHtml::form(array('AddScreenshot'));
        echo CHtml::label("URL:", "screenshot_url");
        echo CHtml::textField("screenshot_url");
        echo CHtml::hiddenField("screenshot_shard_id", $model->id);
        echo CHtml::submitButton("Add it!");
        echo CHtml::endForm();
        ?>
    </div>
    <?php
    $screenshotsProvider = Screenshot::model()->searchFromShard($model->id);
    if ($screenshotsProvider->totalItemCount != 0):
        ?>
        <div class="sidebox">
            <h3>Delete Screenshots</h3>
            Clicking an item below will delete it.
            <ul class="flickr">
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $screenshotsProvider,
                    'summaryText' => '',
                    // 'sorterHeader' => 'Sort by:',
                    // 'sortableAttributes' => array('name', 'clients_now'),
                    'itemView' => '_shard_edition_screenshots',
                ));
                ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="sidebox">
        <h1>Shard Voting URL</h1>
        <?php echo CHtml::textField('voting-url', Yii::app()->createAbsoluteUrl('site/shardvoting', array('id' => $model->id)), array('style' => 'width: 100%')); ?>
    </div>
    <div class="sidebox">
        <h1>Delete Shard</h1>
        <p>Clicking the button bellow will permanently delete this shard.</p>
        <input type="button" onclick="javascript:confirmDelete();" value='DELETE SHARD'>
        <script type="text/javascript">
            function confirmDelete()
            {
                var confirmed = confirm("Are you sure you want to permanently delete this shard?");
                if (confirmed)
                {
                    location.href = '<?php echo $this->createUrl('site/ShardDeletion', array('id' => $model->id)); ?>';
                }
            }
        </script>
    </div>
</div>