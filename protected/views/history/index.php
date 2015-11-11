<?php
/* @var $this HistoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Histories',
);

$this->menu=array(
	array('label'=>'Create History', 'url'=>array('create')),
	array('label'=>'Manage History', 'url'=>array('admin')),
);
?>

<h1>Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
