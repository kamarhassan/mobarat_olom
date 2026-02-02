<?php
/* @var $this SchoolController */
/* @var $data School */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->school_id), array('view', 'id'=>$data->school_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_name')); ?>:</b>
	<?php echo CHtml::encode($data->school_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_ename')); ?>:</b>
	<?php echo CHtml::encode($data->school_ename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_place')); ?>:</b>
	<?php echo CHtml::encode($data->school_place); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_street')); ?>:</b>
	<?php echo CHtml::encode($data->school_street); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_email')); ?>:</b>
	<?php echo CHtml::encode($data->school_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_phone')); ?>:</b>
	<?php echo CHtml::encode($data->school_phone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('school_extraphone')); ?>:</b>
	<?php echo CHtml::encode($data->school_extraphone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_fax')); ?>:</b>
	<?php echo CHtml::encode($data->school_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_pobox')); ?>:</b>
	<?php echo CHtml::encode($data->school_pobox); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_level')); ?>:</b>
	<?php echo CHtml::encode($data->school_level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_type')); ?>:</b>
	<?php echo CHtml::encode($data->school_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_oldID')); ?>:</b>
	<?php echo CHtml::encode($data->school_oldID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_ManagerPersonID')); ?>:</b>
	<?php echo CHtml::encode($data->school_ManagerPersonID); ?>
	<br />

	*/ ?>

</div>