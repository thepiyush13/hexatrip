<?php
/* @var $this TempTrainStatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Temp Train Statuses',
);

$this->menu=array(
	array('label'=>'Create TempTrainStatus', 'url'=>array('create')),
	array('label'=>'Manage TempTrainStatus', 'url'=>array('admin')),
);
?>

<h1>Temp Train Statuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
