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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location_from'); ?>
		<?php echo $form->dropDownList($model,'location_from', $model->getLocationOptions()); ?>
		<?php echo $form->error($model,'location_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location_to'); ?>
		<?php echo $form->dropDownList($model,'location_to', $model->getLocationOptions()); ?>
		<?php echo $form->error($model,'location_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_from'); ?>
		<?php echo $form->textField($model,'date_from'); ?>
		<?php echo $form->error($model,'date_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_to'); ?>
		<?php echo $form->textField($model,'date_to'); ?>
		<?php echo $form->error($model,'date_to'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', $model->getStatusOptions()); ?>

		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bus'); ?>
		<?php echo $form->dropDownList($model,'bus', $model->getStatusOptions()); ?>
		<?php echo $form->error($model,'bus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bus_price_min'); ?>
		<?php echo $form->textField($model,'bus_price_min'); ?>
		<?php echo $form->error($model,'bus_price_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bus_price_max'); ?>
		<?php echo $form->textField($model,'bus_price_max'); ?>
		<?php echo $form->error($model,'bus_price_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bus_avail_min'); ?>
		<?php echo $form->textField($model,'bus_avail_min'); ?>
		<?php echo $form->error($model,'bus_avail_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bus_avail_max'); ?>
		<?php echo $form->textField($model,'bus_avail_max'); ?>
		<?php echo $form->error($model,'bus_avail_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bus_dept_min'); ?>
		<?php echo $form->textField($model,'bus_dept_min'); ?>
		<?php echo $form->error($model,'bus_dept_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bus_dept_max'); ?>
		<?php echo $form->textField($model,'bus_dept_max'); ?>
		<?php echo $form->error($model,'bus_dept_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bus_arrive_min'); ?>
		<?php echo $form->textField($model,'bus_arrive_min'); ?>
		<?php echo $form->error($model,'bus_arrive_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bus_arrive_max'); ?>
		<?php echo $form->textField($model,'bus_arrive_max'); ?>
		<?php echo $form->error($model,'bus_arrive_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'train'); ?>
		<?php echo $form->dropDownList($model,'train', $model->getStatusOptions()); ?>
		<?php echo $form->error($model,'train'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'train_price_min'); ?>
		<?php echo $form->textField($model,'train_price_min'); ?>
		<?php echo $form->error($model,'train_price_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'train_price_max'); ?>
		<?php echo $form->textField($model,'train_price_max'); ?>
		<?php echo $form->error($model,'train_price_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'train_avail_min'); ?>
		<?php echo $form->textField($model,'train_avail_min'); ?>
		<?php echo $form->error($model,'train_avail_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'train_avail_max'); ?>
		<?php echo $form->textField($model,'train_avail_max'); ?>
		<?php echo $form->error($model,'train_avail_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'train_dept_min'); ?>
		<?php echo $form->textField($model,'train_dept_min'); ?>
		<?php echo $form->error($model,'train_dept_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'train_dept_max'); ?>
		<?php echo $form->textField($model,'train_dept_max'); ?>
		<?php echo $form->error($model,'train_dept_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'train_arrive_min'); ?>
		<?php echo $form->textField($model,'train_arrive_min'); ?>
		<?php echo $form->error($model,'train_arrive_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'train_arrive_max'); ?>
		<?php echo $form->textField($model,'train_arrive_max'); ?>
		<?php echo $form->error($model,'train_arrive_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flight'); ?>
		<?php echo $form->dropDownList($model,'flight', $model->getStatusOptions()); ?>
		<?php echo $form->error($model,'flight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flight_price_min'); ?>
		<?php echo $form->textField($model,'flight_price_min'); ?>
		<?php echo $form->error($model,'flight_price_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flight_price_max'); ?>
		<?php echo $form->textField($model,'flight_price_max'); ?>
		<?php echo $form->error($model,'flight_price_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flight_avail_min'); ?>
		<?php echo $form->textField($model,'flight_avail_min'); ?>
		<?php echo $form->error($model,'flight_avail_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flight_avail_max'); ?>
		<?php echo $form->textField($model,'flight_avail_max'); ?>
		<?php echo $form->error($model,'flight_avail_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flight_dept_min'); ?>
		<?php echo $form->textField($model,'flight_dept_min'); ?>
		<?php echo $form->error($model,'flight_dept_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flight_dept_max'); ?>
		<?php echo $form->textField($model,'flight_dept_max'); ?>
		<?php echo $form->error($model,'flight_dept_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flight_arrive_min'); ?>
		<?php echo $form->textField($model,'flight_arrive_min'); ?>
		<?php echo $form->error($model,'flight_arrive_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flight_arrive_max'); ?>
		<?php echo $form->textField($model,'flight_arrive_max'); ?>
		<?php echo $form->error($model,'flight_arrive_max'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->