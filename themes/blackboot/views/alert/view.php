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

<h1>View Alert <?php echo $model->name; ?></h1>

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
		
		'date_from',
		'date_to',
		
		'status',
		
		'updated',
		'created',
        

	),
)); ?>
