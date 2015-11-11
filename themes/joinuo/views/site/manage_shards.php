<?php $this->pageTitle = Yii::app()->name . ' - Shard Management'; ?>
<div id="post-wrapper">
    <?php
    if ($userShards->totalItemCount != 0)
    {
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $userShards,
            'summaryText' => '',
            'pager' => array(
                'htmlOptions' => array('class' => 'page-navi'),
                'header' => '',
                'selectedPageCssClass' => 'current',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>',
                'lastPageLabel' => '>>',
                'firstPageLabel' => '<<',
                'maxButtonCount' => 5
            ),
            // 'sorterHeader' => 'Sort by:',
            // 'sortableAttributes' => array('name', 'clients_now'),
            'itemView' => '_manage_shards',
        ));
    }
    else
    {
        echo '<div class="post">';
        echo '<h3>Oh No!</h3>';
        echo '<p>You have no shards registered yet!</p>';
        echo '</div>';
    }
    ?>
</div>
<div id="sidebar">
    <div class="sidebox">
        <h3>Select a Shard to Manage</h3>
        <p>In this page we list all shards registered under your account. You are the only one who can edit them.</p>
    </div>
    <div class="sidebox">
        <h3>Register a New Shard</h3>
        <ul>
            <li><?php echo CHtml::link("Shard Registration Form", array("site/shardregistration")); ?></li>
        </ul>
    </div>
    <?php echo Adsense::Sidebox(); ?>
</div>