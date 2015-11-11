<?php
/* @var $this ShardController */
/* @var $model Shard */

$this->breadcrumbs=array(
	'Shards'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Shard', 'url'=>array('index')),
	array('label'=>'Create Shard', 'url'=>array('create')),
	array('label'=>'View Shard', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Shard', 'url'=>array('admin')),
);
?>

<h1>Update Shard <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>