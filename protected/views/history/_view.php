<?php
/* @var $this HistoryController */
/* @var $data History */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shard_id')); ?>:</b>
	<?php echo CHtml::encode($data->shard_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clients')); ?>:</b>
	<?php echo CHtml::encode($data->clients); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('items')); ?>:</b>
	<?php echo CHtml::encode($data->items); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobiles')); ?>:</b>
	<?php echo CHtml::encode($data->mobiles); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('memory')); ?>:</b>
	<?php echo CHtml::encode($data->memory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datetime')); ?>:</b>
	<?php echo CHtml::encode($data->datetime); ?>
	<br />


</div>