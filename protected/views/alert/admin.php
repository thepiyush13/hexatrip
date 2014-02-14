<?php
/* @var $this AlertController */
/* @var $model Alert */

$this->breadcrumbs=array(
	'Alerts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Alert', 'url'=>array('index')),
	array('label'=>'Create Alert', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#alert-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Alerts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'alert-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    
	'columns'=>array(
		'id',
		'name',
		'desc',
		'location_from',
		'location_to',
		'date_from',
		/*
		'date_to',
		'user_id',
		'status',
		'bus',
		'bus_price_min',
		'bus_price_max',
		'bus_avail_min',
		'bus_avail_max',
		'bus_dept_min',
		'bus_dept_max',
		'bus_arrive_min',
		'bus_arrive_max',
		'train',
		'train_price_min',
		'train_price_max',
		'train_avail_min',
		'train_avail_max',
		'train_dept_min',
		'train_dept_max',
		'train_arrive_min',
		'train_arrive_max',
		'flight',
		'flight_price_min',
		'flight_price_max',
		'flight_avail_min',
		'flight_avail_max',
		'flight_dept_min',
		'flight_dept_max',
		'flight_arrive_min',
		'flight_arrive_max',
		'updated',
		'created',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
