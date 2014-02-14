<?php
/* @var $this AlertController */
/* @var $model Alert */

$this->breadcrumbs=array(
	'Alerts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Alert', 'url'=>array('index')),
	array('label'=>'Create Alert', 'url'=>array('create')),
	array('label'=>'Update Alert', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Alert', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Alert', 'url'=>array('admin')),
);
?>

<h1>View Alert #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'desc',
		    array(
'name'=>'location_from',
'value'=>isset($model->locationFrom)?CHtml::encode($model->locationFrom->name):"unknown"
),    
            array(
'name'=>'location_to',
'value'=>isset($model->locationTo)?CHtml::encode($model->locationTo->name):"unknown"
),
		'location_to',
		'date_from',
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
        

	),
)); ?>
