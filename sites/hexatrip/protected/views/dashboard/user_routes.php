<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);

$this->menu=array(
	array('label'=>'Load Train Data', 'url'=>array('//tempTrainStatus/loadData ')),
	array('label'=>'Send Email', 'url'=>array('sendMail')),
);
?>
<h1>User Routes</h1>

<div class="row-fluid">
    <div class="span12">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
'id'=>'students-grid',
'dataProvider'=> $result, 
)); ?>
    </div>
</div>


<div>
    
    
     
</div>
