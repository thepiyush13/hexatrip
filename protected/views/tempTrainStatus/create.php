
<?php
/* @var $this TempTrainStatusController */
/* @var $model TempTrainStatus */

$this->breadcrumbs=array(
	'Temp Train Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TempTrainStatus', 'url'=>array('index')),
	array('label'=>'Manage TempTrainStatus', 'url'=>array('admin')),
);
?>

<h1>Create TempTrainStatus</h1>
<!--<div id="PersonTableContainer"></div>-->
<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<?php 
$script = <<< EOD

/* here you write your javascript normally in multiple lines */
$(document).ready(function () {
     //JS FOR JTABLE
       
        
        
    //JS FOR BUTTON    
      

$(".clone").live("click", function(){
        
  $("table tr:last")
      .clone()
      .appendTo("table")
      .find(':input')
      .attr('name', function(index, name) {
         var current = name.match(/\d/);
        current = parseInt(current)+1;       
        return name.replace(/\d/,current);
          });
      })
});

$(".remove").live("click", function(){
    $(this).parents(".clonedInput").remove();
});
        
        
    
EOD;

Yii::app()->clientScript->registerScript('someId', $script);

?>