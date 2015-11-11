<?php
/* @var $this ShardController */
/* @var $model Shard */

$this->breadcrumbs = array(
    'Shards' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Shard', 'url' => array('index')),
    array('label' => 'Create Shard', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#shard-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Shards</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'shard-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        // 'id',
        array(
            'type' => 'raw',
            'value' => 'CHtml::link($data->user->username, array("user/update", "id" => $data->user->id));',
            'name' => 'user_id',
        ),
        'name',
        'host',
        'port',
        'website',
        array(
            'type' => 'raw',
            'value' => function ($data) { echo ($data->premium) ? 'Yes' : 'No'; },
            'name' => 'premium',
        ),
        /*
          'description',
          'emulator',
          'banner_url',
          'feed_url',
          'youtube_url',
          'era',
          'language',
          'join_date',
          'clients_now',
          'clients_peak',
          'online_peak_datetime',
          'last_online',
          'times_polled',
          'times_online',
          'votes',
          'hits',
          'active',
         */
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
