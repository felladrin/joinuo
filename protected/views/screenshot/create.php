<?php
/* @var $this ScreenshotController */
/* @var $model Screenshot */

$this->breadcrumbs=array(
	'Screenshots'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Screenshot', 'url'=>array('index')),
	array('label'=>'Manage Screenshot', 'url'=>array('admin')),
);
?>

<h1>Create Screenshot</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>