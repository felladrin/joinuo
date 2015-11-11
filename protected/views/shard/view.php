<?php
/* @var $this ShardController */
/* @var $model Shard */

$this->breadcrumbs=array(
	'Shards'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Shard', 'url'=>array('index')),
	array('label'=>'Create Shard', 'url'=>array('create')),
	array('label'=>'Update Shard', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Shard', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Shard', 'url'=>array('admin')),
);
?>

<h1>View Shard #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'name',
		'host',
		'port',
		'description',
		'emulator',
		'website',
		'banner_url',
		'feed_url',
		'youtube_url',
		'era',
		'language',
		'join_date',
		'clients_now',
		'clients_peak',
		'online_peak_datetime',
		'last_online',
		'times_polled',
		'times_online',
		'votes',
		'hits',
		'premium',
		'active',
	),
)); ?>
