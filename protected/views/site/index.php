<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<div class="form">

<?php 
foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
    
 if(Yii::app()->user->isGuest){   
$form=$this->beginWidget('CActiveForm', array(
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
		<label for="email">Your email</label>
		<input type="text" name="email" />
		
	</div>


	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); 
 }
?>

</div><!-- form -->
