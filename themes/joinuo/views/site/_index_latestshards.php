<?php
/* @var $this SiteController */
/* @var $data Shard */
?>
<li><?php echo CHtml::link(CHtml::encode($data->name) . " (" . date("F j", strtotime($data->join_date)) . ")", array('shard', 'id' => $data->id)); ?></li>