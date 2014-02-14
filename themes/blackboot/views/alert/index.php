<?php
/* @var $this AlertController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Alerts',
);

$this->menu=array(
	array('label'=>'Create Alert', 'url'=>array('create')),
	array('label'=>'Manage Alert', 'url'=>array('admin')),
);
?>

<h1>Alerts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    
)); ?>
