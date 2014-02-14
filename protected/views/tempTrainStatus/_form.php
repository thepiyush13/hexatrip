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
    
    <table class="table  table-striped  table-bordered table-hover table-condensed form-content">
              <thead>
                <tr>
                    <th>#</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Date</th>                  
                  <th>Class</th>
                  <th>Train Number</th>
                  <th>Train Name</th>
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
             
		<select class="input-small" required="required" name="TempTrainStatus[1][location_from]" id="TempTrainStatus_location_from">
<option value="">FROM</option>
<option value="5">Mumbai</option>
<option value="6">Delhi</option>
<option value="7">Kolkata</option>
<option value="8">Bengaluru</option>
<option value="9">Chennai</option>
<option value="11">Hyderabad</option>
</select>		  </td>
  <td>
             
		<select class="input-small" required="required" name="TempTrainStatus[1][location_to]" id="TempTrainStatus_location_to">
<option value="">TO</option>
<option value="5">Mumbai</option>
<option value="6">Delhi</option>
<option value="7">Kolkata</option>
<option value="8">Bengaluru</option>
<option value="9">Chennai</option>
<option value="11">Hyderabad</option>
</select>		  </td>

<td>
				<input class="input" placeholder="date1" required="required" name="TempTrainStatus[1][date]" id="TempTrainStatus_date" type="date">			</td>
        
       

		
            

<td>
             
		<select class="input-small" required="required" name="TempTrainStatus[1][type]" id="TempTrainStatus_type">
<option value="">CLASS</option>
<option value="SL">SLEEPER</option>
<option value="3A">3AC</option>
<option value="1A">1AC</option>
<option value="2A">2AC</option>
</select>		  </td>
  
  <td>
				<input class="input-small" placeholder="train id" required="required" name="TempTrainStatus[1][train_id]" id="TempTrainStatus_train_id" type="text">			</td>
  
  <td>
				<input size="60" maxlength="255" class="input-small" placeholder="train name" required="required" name="TempTrainStatus[1][train_name]" id="TempTrainStatus_train_name" type="text">			</td>
		
<td>
				<input class="input-small" placeholder="available seats" required="required" name="TempTrainStatus[1][available]" id="TempTrainStatus_available" type="text" value="0">			</td>
  
  <td>
				<textarea class="input-small" placeholder="comment" name="TempTrainStatus[1][desc]" id="TempTrainStatus_desc"></textarea>			</td>
  
  
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