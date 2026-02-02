<?php
/* @var $this MbMessageDetailController */
/* @var $model MbMessageDetail */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'mdetail_id'); ?>
		<?php echo $form->textField($model,'mdetail_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mdetail_message'); ?>
		<?php echo $form->textField($model,'mdetail_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mdetail_sender'); ?>
		<?php echo $form->textField($model,'mdetail_sender'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mdetail_receiver'); ?>
		<?php echo $form->textField($model,'mdetail_receiver'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message_read_flag'); ?>
		<?php echo $form->textField($model,'message_read_flag'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->