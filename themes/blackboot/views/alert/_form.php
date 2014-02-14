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
	'enableAjaxValidation'=>false,
)); ?>
    <style>
        form label {
/*            float: none;
width: 100%;
padding-top: 5px;
text-align: left;*/
        }
        .btn-status{
            width: 100%;
        }
        
        </style>
    <!--START CUSTOM HTML-->
    <div class="row-fluid">
        
        <div class="row-fluid well well-small">
  <div class="span2">
   <?php echo $form->labelEx($model,'location_from'); ?>
		<?php echo $form->dropDownList($model,'location_from', $model->getLocationOptions()); ?>
		<?php echo $form->error($model,'location_from'); ?>
  </div>
  <div class="span2">
    <?php echo $form->labelEx($model,'location_to'); ?>
		<?php echo $form->dropDownList($model,'location_to', $model->getLocationOptions()); ?>
		<?php echo $form->error($model,'location_to'); ?>
  </div>
            <div class="span2"></div>
  <div class="span3">
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
                        )
	)); 
            
            ?>
  </div>
            <div class="span3">
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
                        )
	)); 
            
            ?>
  </div>
</div>
    
       
		

	
    </div>
    <div class="row-fluid">
        
        <div class="span2">
		    <i class="fa fa-road fa-5x fa-rotate-90 base-color center" style="
    color: #ff8a00;
    font-size: 10em;
"></i>
        </div>
        
        <div class="span8">
            <h3>Train Alert</h3>
            <div class="control-group">
            <label class="control-label" for="password">Alert me when availability between</label>
            <div class="controls">
             <?php echo $form->textField($model,'train_avail_min'); ?><?php echo $form->error($model,'train_avail_min'); ?>  <?php echo $form->textField($model,'train_avail_max'); ?><?php echo $form->error($model,'train_avail_max'); ?>
            </div>
            
          </div>
            
             <div class="control-group">
            <label class="control-label" for="password">Alert me when departure between</label>
            <div class="controls">
             <?php echo $form->textField($model,'train_dept_min'); ?><?php echo $form->error($model,'train_dept_min'); ?>  <?php echo $form->textField($model,'train_dept_max'); ?><?php echo $form->error($model,'train_dept_max'); ?>
            </div>
          </div>
         </div>
        
        <div class="span2">
            <div class="btn-group ">
<!--                <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                    Action 
                    <span class="icon-cog icon-white"></span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#"><span class="icon-wrench"></span> Modify</a></li>
                    <li><a href="#"><span class="icon-trash"></span> Delete</a></li>
                </ul>-->
              
		<?php echo $form->dropDownList($model,'train', $model->getStatusOptions(),array('class'=>'btn  dropdown-toggle btn-info btn-status ')); ?>
		<?php echo $form->error($model,'train'); ?>
            </div>
        </div>
</div>
    
    <div class="row-fluid" style="
    border-top: 1px solid rgb(216, 209, 209);
    padding: 10px;
">
        <div class="span2">
		    <i class="fa fa-plane fa-5x base-color center" style="
    color: #ff8a00;
    font-size: 10em;
"></i>
        </div>
        
        <div class="span8">
            <h3>Flight Alert</h3>
            <div class="control-group">
            <label class="control-label" for="password">Alert me when availability between</label>
            <div class="controls">
             <?php echo $form->textField($model,'flight_avail_min'); ?><?php echo $form->error($model,'flight_avail_min'); ?>  <?php echo $form->textField($model,'flight_avail_max'); ?><?php echo $form->error($model,'flight_avail_max'); ?>
            </div>
            
          </div>
            
             <div class="control-group">
            <label class="control-label" for="password">Alert me when departure between</label>
            <div class="controls">
             <?php echo $form->textField($model,'flight_dept_min'); ?><?php echo $form->error($model,'flight_dept_min'); ?>  <?php echo $form->textField($model,'flight_dept_max'); ?><?php echo $form->error($model,'flight_dept_max'); ?>
            </div>
          </div>
        </div>
        
        <div class="span2">
            <div class="btn-group">
                <?php echo $form->dropDownList($model,'flight', $model->getStatusOptions(),array('class'=>'btn  dropdown-toggle btn-info btn-status ')); ?>
		<?php echo $form->error($model,'flight'); ?>
            </div>
        </div>
</div>
    <div class="row-fluid" style="
    border-top: 1px solid rgb(216, 209, 209);
    padding: 10px;
">
        <div class="span2">
		    <i class="fa fa-truck fa-5x base-color center" style="
    color: #ff8a00;
    font-size: 10em;
"></i>
        </div>
        
        <div class="span8">
            <h3>Bus Alert</h3>
            <h4>Coming Soon......</h4>
            
        </div>
        
        <div class="span2">
            <div class="btn-group">
<!--                <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                    Action 
                    <span class="icon-cog icon-white"></span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#"><span class="icon-wrench"></span> Modify</a></li>
                    <li><a href="#"><span class="icon-trash"></span> Delete</a></li>
                </ul>-->
            </div>
        </div>
</div>
    <!--END CUSTOM HTML-->


	

	

	



	
 <div class="row-fluid well well-small">
            
            <div class="span3">
                <?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?> 
            </div>
            <div class="span3">
                <?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'desc'); ?>
            </div>
     <div class="span3">
                <?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>

		<?php echo $form->error($model,'status'); ?>
            </div>
            
            </div>
	<div class="row buttons" style="text-align: center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-large btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->