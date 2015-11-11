<?php
/* @var $this LevelController */
/* @var $model Level */

$this->breadcrumbs=array(
	'Levels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Level', 'url'=>array('index')),
	array('label'=>'Manage Level', 'url'=>array('admin')),
);
?>

<h1>Create Level</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>