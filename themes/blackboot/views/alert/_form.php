<?php
/* @var $this AlertController */
/* @var $model Alert */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'alert-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>FALSE,
)); ?>
    
<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->
<?php  
if(($form->errorSummary($model))){
echo '<div class="alert alert-error">'.$form->errorSummary($model).'</div>';	
}
?>
    
    <style>
        form label {
/*            float: none;
width: 100%;
padding-top: 5px;
text-align: left;*/
        }
        .btn-status{
            /*width: 100%;*/
        }
        .form-input{
            width: 65px; 
            padding: 1px
        }
        .form-input-date{
            width: 165px; 
            padding: 1px
        }
        .font-icon{            
    color: #ff8a00;
    vertical-align: middle;
    /*font-size: 10em;*/
        }
        fieldset.scheduler-border {
    border: 2px solid #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
        
        </style>
    <!--START CUSTOM HTML-->
    
    <fieldset class="scheduler-border">
    <legend class="scheduler-border"><h3><i class="fa fa-calendar fa-2x  font-icon center" style="font-icon"></i> Travel Details</h3></legend>
    <div class="table-responsive">
         <table class="table">
    
    <tbody>
        <tr>
            <td><?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?> <br/>
                <?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>

		<?php echo $form->error($model,'status'); ?> <br/>
                <?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'desc'); ?>
            
            </td>            
            <td>
                <?php echo $form->labelEx($model,'location_from'); ?>
		<?php echo $form->dropDownList($model,'location_from', $model->getLocationOptions(),array('class'=>'form-input1')); ?>
		<?php echo $form->error($model,'location_from'); ?> <br/>
                <?php echo $form->labelEx($model,'location_to'); ?>
		<?php echo $form->dropDownList($model,'location_to', $model->getLocationOptions(),array('class'=>'form-input1')); ?>
		<?php echo $form->error($model,'location_to'); ?><br/>
                <?php echo $form->labelEx($model,'date_from'); ?>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Alert[date_from]', 
                 'value'=>$model->date_from,
                
                 
                        'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd-mm-yy',
                         ),
                 'htmlOptions'=>array(
                          'placeholder'=>'Select a date',
                     'class'=>'form-input-date'
                        )
	)); 
            
            ?> <br/>
            <?php echo $form->labelEx($model,'date_to'); ?>		
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'Alert[date_to]', 
                 'value'=>$model->date_to,               
                 
                        'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd-mm-yy',
                         ),
                 'htmlOptions'=>array(
                          'placeholder'=>'Select a date',
                     'class'=>'form-input-date'
                        )
	)); 
            
            ?>
                
            </td>
                
            
        </tr>
      
      
       </tbody>
  </table>
    </div>
  
</fieldset>
    <fieldset class="scheduler-border">
    <legend class="scheduler-border "><h3><i class="fa fa-road fa-2x fa-rotate-90 font-icon center" style="font-icon"></i> Alert for Trains</h3></legend>
    <div class="table-responsive">
        <table class="table">
    
    <tbody>
      <tr>
        <td>Alert is&nbsp;&nbsp</td>
        <td><?php echo $form->dropDownList($model,'train', $model->getStatusOptions(),array('class'=>'btn  dropdown-toggle  btn-status')); ?>
		<?php echo $form->error($model,'train'); ?></td></tr>
      <tr>
        <td>Send me alert when Train availability</td>        
        <td>Between  &nbsp;&nbsp;            
            <?php echo $form->textField($model,'train_avail_min',array('type'=>'number','class'=>'form-input')); ?><?php echo $form->error($model,'train_avail_min'); ?> 
            &nbsp;&nbsp;To &nbsp;&nbsp;&nbsp; 
                <?php echo $form->textField($model,'train_avail_max',array('type'=>'number','class'=>'form-input')); ?><?php echo $form->error($model,'train_avail_max'); ?>            
        </td>
      </tr>
       </tbody>
  </table>
    </div>
   
</fieldset>
    
    
    <fieldset class="scheduler-border">
    <legend class="scheduler-border"><h3><i class="fa fa-plane fa-2x  font-icon center" style="font-icon"></i> Alert for Flights</h3></legend>
  Coming Soon....
</fieldset>
    <fieldset class="scheduler-border">
    <legend class="scheduler-border"><h3><i class="fa fa-truck fa-2x  font-icon center" style="font-icon"></i> Alert for Bus</h3></legend>
  Coming Soon....
</fieldset>
    
    


	

	



	
 
	<div class="row buttons" style="text-align: center">
            <div class="span5 offset3">
                	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-large btn-block btn-primary')); ?>
            </div>
	
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->