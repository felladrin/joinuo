<?php
/* @var $this ScreenshotController */
/* @var $model Screenshot */

$this->breadcrumbs=array(
	'Screenshots'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Screenshot', 'url'=>array('index')),
	array('label'=>'Create Screenshot', 'url'=>array('create')),
	array('label'=>'Update Screenshot', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Screenshot', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Screenshot', 'url'=>array('admin')),
);
?>

<h1>View Screenshot #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'shard_id',
		'filename',
		'active',
	),
)); ?>
