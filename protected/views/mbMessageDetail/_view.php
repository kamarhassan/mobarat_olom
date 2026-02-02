<?php
/* @var $this MbMessageDetailController */
/* @var $data MbMessageDetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mdetail_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mdetail_id), array('view', 'id'=>$data->mdetail_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mdetail_message')); ?>:</b>
	<?php echo CHtml::encode($data->mdetail_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mdetail_sender')); ?>:</b>
	<?php echo CHtml::encode($data->mdetail_sender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mdetail_receiver')); ?>:</b>
	<?php echo CHtml::encode($data->mdetail_receiver); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message_read_flag')); ?>:</b>
	<?php echo CHtml::encode($data->message_read_flag); ?>
	<br />


</div>