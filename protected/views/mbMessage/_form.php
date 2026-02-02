<?php
/* @var $this MbMessageController */
/* @var $model MbMessage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mb-message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'message_subject'); ?>
		<?php echo $form->textField($model,'message_subject',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'message_subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message_content'); ?>
		<?php echo $form->textArea($model,'message_content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'message_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message_date'); ?>
		<?php echo $form->textField($model,'message_date'); ?>
		<?php echo $form->error($model,'message_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->