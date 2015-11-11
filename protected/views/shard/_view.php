<?php
/* @var $this ShardController */
/* @var $data Shard */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('host')); ?>:</b>
	<?php echo CHtml::encode($data->host); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('port')); ?>:</b>
	<?php echo CHtml::encode($data->port); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emulator')); ?>:</b>
	<?php echo CHtml::encode($data->emulator); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
	<?php echo CHtml::encode($data->website); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banner_url')); ?>:</b>
	<?php echo CHtml::encode($data->banner_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('feed_url')); ?>:</b>
	<?php echo CHtml::encode($data->feed_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('youtube_url')); ?>:</b>
	<?php echo CHtml::encode($data->youtube_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('era')); ?>:</b>
	<?php echo CHtml::encode($data->era); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('join_date')); ?>:</b>
	<?php echo CHtml::encode($data->join_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clients_now')); ?>:</b>
	<?php echo CHtml::encode($data->clients_now); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clients_peak')); ?>:</b>
	<?php echo CHtml::encode($data->clients_peak); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('online_peak_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->online_peak_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_online')); ?>:</b>
	<?php echo CHtml::encode($data->last_online); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('times_polled')); ?>:</b>
	<?php echo CHtml::encode($data->times_polled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('times_online')); ?>:</b>
	<?php echo CHtml::encode($data->times_online); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votes')); ?>:</b>
	<?php echo CHtml::encode($data->votes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hits')); ?>:</b>
	<?php echo CHtml::encode($data->hits); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('premium')); ?>:</b>
	<?php echo CHtml::encode($data->premium); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	*/ ?>

</div>