<?php
/* @var $this LevelController */
/* @var $model Level */

$this->breadcrumbs=array(
	'Levels'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Level', 'url'=>array('index')),
	array('label'=>'Create Level', 'url'=>array('create')),
	array('label'=>'View Level', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Level', 'url'=>array('admin')),
);
?>

<h1>Update Level <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>