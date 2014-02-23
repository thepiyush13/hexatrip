<?php
/* @var $this AlertController */
/* @var $model Alert */

$this->breadcrumbs=array(
	'Alerts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Alert', 'url'=>array('index')),
	array('label'=>'Manage Alert', 'url'=>array('admin')),
);
?>

<h1>Create Alert</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>