<?php
/* @var $this AlertController */
/* @var $data Alert */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_from')); ?>:</b>
	<?php echo CHtml::encode($data->location_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_to')); ?>:</b>
	<?php echo CHtml::encode($data->location_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_from')); ?>:</b>
	<?php echo CHtml::encode($data->date_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_to')); ?>:</b>
	<?php echo CHtml::encode($data->date_to); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus')); ?>:</b>
	<?php echo CHtml::encode($data->bus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_price_min')); ?>:</b>
	<?php echo CHtml::encode($data->bus_price_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_price_max')); ?>:</b>
	<?php echo CHtml::encode($data->bus_price_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_avail_min')); ?>:</b>
	<?php echo CHtml::encode($data->bus_avail_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_avail_max')); ?>:</b>
	<?php echo CHtml::encode($data->bus_avail_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_dept_min')); ?>:</b>
	<?php echo CHtml::encode($data->bus_dept_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_dept_max')); ?>:</b>
	<?php echo CHtml::encode($data->bus_dept_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_arrive_min')); ?>:</b>
	<?php echo CHtml::encode($data->bus_arrive_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bus_arrive_max')); ?>:</b>
	<?php echo CHtml::encode($data->bus_arrive_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train')); ?>:</b>
	<?php echo CHtml::encode($data->train); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train_price_min')); ?>:</b>
	<?php echo CHtml::encode($data->train_price_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train_price_max')); ?>:</b>
	<?php echo CHtml::encode($data->train_price_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train_avail_min')); ?>:</b>
	<?php echo CHtml::encode($data->train_avail_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train_avail_max')); ?>:</b>
	<?php echo CHtml::encode($data->train_avail_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train_dept_min')); ?>:</b>
	<?php echo CHtml::encode($data->train_dept_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train_dept_max')); ?>:</b>
	<?php echo CHtml::encode($data->train_dept_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train_arrive_min')); ?>:</b>
	<?php echo CHtml::encode($data->train_arrive_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('train_arrive_max')); ?>:</b>
	<?php echo CHtml::encode($data->train_arrive_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight')); ?>:</b>
	<?php echo CHtml::encode($data->flight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_price_min')); ?>:</b>
	<?php echo CHtml::encode($data->flight_price_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_price_max')); ?>:</b>
	<?php echo CHtml::encode($data->flight_price_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_avail_min')); ?>:</b>
	<?php echo CHtml::encode($data->flight_avail_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_avail_max')); ?>:</b>
	<?php echo CHtml::encode($data->flight_avail_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_dept_min')); ?>:</b>
	<?php echo CHtml::encode($data->flight_dept_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_dept_max')); ?>:</b>
	<?php echo CHtml::encode($data->flight_dept_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_arrive_min')); ?>:</b>
	<?php echo CHtml::encode($data->flight_arrive_min); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flight_arrive_max')); ?>:</b>
	<?php echo CHtml::encode($data->flight_arrive_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated')); ?>:</b>
	<?php echo CHtml::encode($data->updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	*/ ?>

</div>