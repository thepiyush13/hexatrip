<?php
/* @var $this AlertController */
/* @var $model Alert */

$this->breadcrumbs=array(
	'Alerts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Alert', 'url'=>array('index')),
	array('label'=>'Create Alert', 'url'=>array('create')),
	array('label'=>'View Alert', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Alert', 'url'=>array('admin')),
);
?>

<h1>Update Alert <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>