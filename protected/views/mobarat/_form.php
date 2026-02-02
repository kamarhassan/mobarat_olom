<?php
/* @var $this MobaratController */
/* @var $model Mobarat */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mobarat-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mobarat_year'); ?>
		<?php echo $form->textField($model,'mobarat_year'); ?>
		<?php echo $form->error($model,'mobarat_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'openForRegistration'); ?>
		<?php echo $form->textField($model,'openForRegistration'); ?>
		<?php echo $form->error($model,'openForRegistration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_register_school'); ?>
		<?php echo $form->textField($model,'last_register_school'); ?>
		<?php echo $form->error($model,'last_register_school'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_register_project'); ?>
		<?php echo $form->textField($model,'last_register_project'); ?>
		<?php echo $form->error($model,'last_register_project'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_register_teacher_student'); ?>
		<?php echo $form->textField($model,'last_register_teacher_student'); ?>
		<?php echo $form->error($model,'last_register_teacher_student'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_update'); ?>
		<?php echo $form->textField($model,'last_update'); ?>
		<?php echo $form->error($model,'last_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_trouble'); ?>
		<?php echo $form->textField($model,'phone_trouble',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'phone_trouble'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MaxNoOfProject'); ?>
		<?php echo $form->textField($model,'MaxNoOfProject'); ?>
		<?php echo $form->error($model,'MaxNoOfProject'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->