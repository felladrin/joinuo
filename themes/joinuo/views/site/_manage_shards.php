<?php
/* @var $this SiteController */
/* @var $data Shard */
?>

<div class="post">
    <h2 class="title" style="text-align: center;"><?php echo CHtml::link(CHtml::encode($data->name), array('site/shardedition', 'id' => $data->id)); ?></h2>
    <a href="<?php echo $this->createUrl('site/shardedition', array('id' => $data->id)) ?>"><img src="<?php echo CHtml::encode($data->banner_url); ?>" alt="" style="max-width: 100%;" /></a>
</div>