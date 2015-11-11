<?php
/* @var $this ScreenshotController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Screenshots',
);

$this->menu=array(
	array('label'=>'Create Screenshot', 'url'=>array('create')),
	array('label'=>'Manage Screenshot', 'url'=>array('admin')),
);
?>

<h1>Screenshots</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
