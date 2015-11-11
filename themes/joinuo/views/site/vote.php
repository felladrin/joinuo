<?php
/* @var $model Shard */

$this->pageTitle = Yii::app()->name . " - Voting for " . $shard->name;
?>

<div id="post-wrapper">
    <div class="post">
        <h2 class="title">Voting for <?php echo CHtml::encode($shard->name); ?></h2>
        <p>
            <?php
            if (isset($message))
            {
                echo $message;
            }
            ?>
        </p>
        <?php echo CHtml::link('[Go to Shard List]', Yii::app()->homeUrl) ?>
        <?php echo CHtml::link('[Go to ' . CHtml::encode($shard->name) . ' Page]', array('shard', 'id' => $shard->id)) ?>
    </div>
</div>
<div id="sidebar">
    <?php echo Adsense::Sidebox(); ?>
</div>