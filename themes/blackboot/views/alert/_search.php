<?php
/* @var $this AlertController */
/* @var $model Alert */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_from'); ?>
		<?php echo $form->textField($model,'location_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_to'); ?>
		<?php echo $form->textField($model,'location_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_from'); ?>
		<?php echo $form->textField($model,'date_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_to'); ?>
		<?php echo $form->textField($model,'date_to'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bus'); ?>
		<?php echo $form->textField($model,'bus'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bus_price_min'); ?>
		<?php echo $form->textField($model,'bus_price_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bus_price_max'); ?>
		<?php echo $form->textField($model,'bus_price_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bus_avail_min'); ?>
		<?php echo $form->textField($model,'bus_avail_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bus_avail_max'); ?>
		<?php echo $form->textField($model,'bus_avail_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bus_dept_min'); ?>
		<?php echo $form->textField($model,'bus_dept_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bus_dept_max'); ?>
		<?php echo $form->textField($model,'bus_dept_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bus_arrive_min'); ?>
		<?php echo $form->textField($model,'bus_arrive_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bus_arrive_max'); ?>
		<?php echo $form->textField($model,'bus_arrive_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'train'); ?>
		<?php echo $form->textField($model,'train'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'train_price_min'); ?>
		<?php echo $form->textField($model,'train_price_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'train_price_max'); ?>
		<?php echo $form->textField($model,'train_price_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'train_avail_min'); ?>
		<?php echo $form->textField($model,'train_avail_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'train_avail_max'); ?>
		<?php echo $form->textField($model,'train_avail_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'train_dept_min'); ?>
		<?php echo $form->textField($model,'train_dept_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'train_dept_max'); ?>
		<?php echo $form->textField($model,'train_dept_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'train_arrive_min'); ?>
		<?php echo $form->textField($model,'train_arrive_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'train_arrive_max'); ?>
		<?php echo $form->textField($model,'train_arrive_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight'); ?>
		<?php echo $form->textField($model,'flight'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_price_min'); ?>
		<?php echo $form->textField($model,'flight_price_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_price_max'); ?>
		<?php echo $form->textField($model,'flight_price_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_avail_min'); ?>
		<?php echo $form->textField($model,'flight_avail_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_avail_max'); ?>
		<?php echo $form->textField($model,'flight_avail_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_dept_min'); ?>
		<?php echo $form->textField($model,'flight_dept_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_dept_max'); ?>
		<?php echo $form->textField($model,'flight_dept_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_arrive_min'); ?>
		<?php echo $form->textField($model,'flight_arrive_min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flight_arrive_max'); ?>
		<?php echo $form->textField($model,'flight_arrive_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->