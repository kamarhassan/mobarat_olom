<?php
/* @var $this MbAdminController */
/* @var $data MbAdmin */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->admin_id), array('view', 'id'=>$data->admin_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_fname')); ?>:</b>
	<?php echo CHtml::encode($data->admin_fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_lname')); ?>:</b>
	<?php echo CHtml::encode($data->admin_lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_mname')); ?>:</b>
	<?php echo CHtml::encode($data->admin_mname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_sex')); ?>:</b>
	<?php echo CHtml::encode($data->admin_sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_mobile')); ?>:</b>
	<?php echo CHtml::encode($data->admin_mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_email')); ?>:</b>
	<?php echo CHtml::encode($data->admin_email); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_user')); ?>:</b>
	<?php echo CHtml::encode($data->admin_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_flag')); ?>:</b>
	<?php echo CHtml::encode($data->admin_flag); ?>
	<br />

	*/ ?>

</div>