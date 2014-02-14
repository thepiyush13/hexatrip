<?php
/* @var $this DashboardController */

$this->breadcrumbs=array(
	'Dashboard',
);
?>
<h1>Admin Dashboard</h1>


<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Todays Routes', 'url'=>array('/dashboard/routes')),
				array('label'=>'Upload Route Data', 'url'=>array('/dashboard/upload')),
				
			),
		)); ?>
<div>
    
    <?php
    if(isset($result)){
        echo  implode('<br/><br/>', $result);
    }
    
   
    ?>
    
</div>
