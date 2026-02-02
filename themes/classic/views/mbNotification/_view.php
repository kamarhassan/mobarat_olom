<?php
/* @var $this MbNotificationController */
/* @var $data MbNotification */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->notification_id), array('view', 'id'=>$data->notification_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sender_id')); ?>:</b>
	<?php echo CHtml::encode($data->sender_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_time')); ?>:</b>
	<?php echo CHtml::encode($data->notification_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_date')); ?>:</b>
	<?php echo CHtml::encode($data->notification_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_content')); ?>:</b>
	<?php echo CHtml::encode($data->notification_content); ?>
	<br />


</div>