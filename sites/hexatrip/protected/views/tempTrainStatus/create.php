
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
   
$(".clone").live("click", function(){
      var selects =  $("#load_data_table tr:last").find("select");
        var date =   $("#load_data_table tr:last").find(".datepicker").datepicker( "getDate" );
  $("#load_data_table tr:last")
      .clone()
      .appendTo("#load_data_table")
      .find(':input')
      .attr('name', function(index, name) {
         var current = name.match(/\d/);
        current = parseInt(current)+1;       
        return name.replace(/\d/,current);
          });
          
        console.log(selects)
	$(selects).each(function(i) {
		var select = this;
		$("#load_data_table tr:last").find("select").eq(i).val($(select).val());
	});
        //setting the datepicker
        var name = $("#load_data_table tr:last").find(".datepicker").attr('name');
        $("#load_data_table tr:last").find(".datepicker").attr('id',name);        
        $("#load_data_table tr:last").find(".datepicker").removeClass('hasDatepicker');        
        $("#load_data_table tr:last").find(".datepicker").not('.hasDatePicker').datepicker({
    changeMonth:true,
    changeYear:true,
    showAnim:'fold',
    showButtonPanel:true,
    autoSize:true,
    dateFormat:'dd-mm-yy'
    
});//.datepicker("setDate", new Date(date));
      })
      
      
      $(".remove").live("click", function(){
    $(this).parents(".clonedInput").remove();
});
});

        
        
    
EOD;

Yii::app()->clientScript->registerScript('someId', $script);

?>