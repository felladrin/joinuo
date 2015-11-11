<?php
/* @var $this ShardController */
/* @var $model Shard */

$this->breadcrumbs=array(
	'Shards'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Shard', 'url'=>array('index')),
	array('label'=>'Manage Shard', 'url'=>array('admin')),
);
?>

<h1>Create Shard</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>