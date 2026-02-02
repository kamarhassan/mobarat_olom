<?php
/* @var $this MbMessageDetailController */
/* @var $model MbMessageDetail */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mb-message-detail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mdetail_message'); ?>
		<?php echo $form->textField($model,'mdetail_message'); ?>
		<?php echo $form->error($model,'mdetail_message'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mdetail_sender'); ?>
		<?php echo $form->textField($model,'mdetail_sender'); ?>
		<?php echo $form->error($model,'mdetail_sender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mdetail_receiver'); ?>
		<?php echo $form->textField($model,'mdetail_receiver'); ?>
		<?php echo $form->error($model,'mdetail_receiver'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message_read_flag'); ?>
		<?php echo $form->textField($model,'message_read_flag'); ?>
		<?php echo $form->error($model,'message_read_flag'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->