<?php
/* @var $this ShardController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Shards',
);

$this->menu=array(
	array('label'=>'Create Shard', 'url'=>array('create')),
	array('label'=>'Manage Shard', 'url'=>array('admin')),
);
?>

<h1>Shards</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
