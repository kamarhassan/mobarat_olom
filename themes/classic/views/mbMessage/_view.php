<?php
/* @var $this MbMessageController */
/* @var $data MbMessage */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('message_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->message_id), array('view', 'id'=>$data->message_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message_subject')); ?>:</b>
	<?php echo CHtml::encode($data->message_subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message_content')); ?>:</b>
	<?php echo CHtml::encode($data->message_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message_date')); ?>:</b>
	<?php echo CHtml::encode($data->message_date); ?>
	<br />


</div>