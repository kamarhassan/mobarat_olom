<?php
/* @var $this MbConfirmationController */
/* @var $data MbConfirmation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('confirmation_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->confirmation_id), array('view', 'id'=>$data->confirmation_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('confirmation_school')); ?>:</b>
	<?php echo CHtml::encode($data->confirmation_school); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('confirmation_code')); ?>:</b>
	<?php echo CHtml::encode($data->confirmation_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('confirmation')); ?>:</b>
	<?php echo CHtml::encode($data->confirmation); ?>
	<br />


</div>