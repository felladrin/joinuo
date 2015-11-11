<?php
/* @var $this ScreenshotController */
/* @var $model Screenshot */

$this->breadcrumbs=array(
	'Screenshots'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Screenshot', 'url'=>array('index')),
	array('label'=>'Create Screenshot', 'url'=>array('create')),
	array('label'=>'View Screenshot', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Screenshot', 'url'=>array('admin')),
);
?>

<h1>Update Screenshot <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>