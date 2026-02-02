<?php
/* @var $this MobaratController */
/* @var $data Mobarat */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobarat_year')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mobarat_year), array('view', 'id'=>$data->mobarat_year)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('openForRegistration')); ?>:</b>
	<?php echo CHtml::encode($data->openForRegistration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_register_school')); ?>:</b>
	<?php echo CHtml::encode($data->last_register_school); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_register_project')); ?>:</b>
	<?php echo CHtml::encode($data->last_register_project); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_register_teacher_student')); ?>:</b>
	<?php echo CHtml::encode($data->last_register_teacher_student); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_update')); ?>:</b>
	<?php echo CHtml::encode($data->last_update); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_trouble')); ?>:</b>
	<?php echo CHtml::encode($data->phone_trouble); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('MaxNoOfProject')); ?>:</b>
	<?php echo CHtml::encode($data->MaxNoOfProject); ?>
	<br />

	*/ ?>

</div>