<?php
/* @var $this TempTrainStatusController */
/* @var $model TempTrainStatus */
/* @var $form CActiveForm */
?>

<div class="form-inline">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'temp-train-status-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    
    <table id="load_data_table" class="table  table-striped  table-bordered table-hover table-condensed form-content">
              <thead>
                <tr>
                    <th>#</th>
                  <th>From</th>
                  <th>To</th>                                   
                  <th>Class</th>
                  <th>Train Number</th>
                  <th>Train Name</th>
                  <th>Date</th> 
                  <th>Seats Available</th>
                  <th>Comments</th>                  
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr id="clonedInput1" class="clonedInput">
                     <td>
             
		1
  </td>
	
        <td>
             
		<select class="input-small" temp="required" name="TempTrainStatus[1][location_from]" id="TempTrainStatus_location_from">
<option value="">FROM</option>
<option value="1">Mumbai</option>
<option value="2">Delhi</option>
<option value="3">Kolkata</option>
<option value="4" >Bangalore</option>
<option value="5">Chennai</option>
<option value="7">Hyderabad</option>
</select>		  
        


        </td>
  <td>
             
		<select class="input-small" temp="required" name="TempTrainStatus[1][location_to]" id="TempTrainStatus_location_to">
<option value="">TO</option>
<option value="1">Mumbai</option>
<option value="2">Delhi</option>
<option value="3">Kolkata</option>
<option value="4" >Bangalore</option>
<option value="5">Chennai</option>
<option value="7">Hyderabad</option>
</select>		  </td>


<td>
             
		<select class="input-mini" temp="required" name="TempTrainStatus[1][type]" id="TempTrainStatus_type">
<option value="">CLASS</option>
<option value="SL">SLEEPER</option>
<option value="3A">3AC</option>
<option value="1A">1AC</option>
<option value="2A">2AC</option>
</select>		  </td>
  
  <td>
				<input class="input-small" placeholder="train id" temp="required" name="TempTrainStatus[1][train_id]" id="TempTrainStatus_train_id" type="text">			</td>
  
  <td>
				<input size="60" maxlength="255" class="input-small" placeholder="train name" temp="required" name="TempTrainStatus[1][train_name]" id="TempTrainStatus_train_name" type="text">			</td>

  <td>
				
      <!--<input class="input" placeholder="date1" temp="required" name="TempTrainStatus[1][date]" id="TempTrainStatus_date" type="date">-->			
   <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'TempTrainStatus[1][date]',
                        'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd-mm-yy',
                         ),
                 'htmlOptions'=>array(
                          'placeholder'=>'Select a date',
                     'class'=>'datepicker'
                        )
	)); 
            
            ?>

  
  </td>
<td>
				<input class="input-small" placeholder="available seats" temp="required" name="TempTrainStatus[1][available]" id="TempTrainStatus_available" type="number" value="">			</td>
  
  <td>
				<input class="input-mini" placeholder="comment" name="TempTrainStatus[1][desc]" id="TempTrainStatus_desc" type="text">		</td>
  
  
  <td>
		
                
      <a class="btn btn-danger remove" id="delete_row">×</a>&nbsp;|&nbsp;<a class="btn btn-primary clone" id="">+</a>
	</td>
        </tr>
                
              </tbody>
            </table>
    
    
    
    
   

	<div class="row-fluid buttons center">
            <hr/>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save',array('class'=>'btn btn-large btn-primary')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->