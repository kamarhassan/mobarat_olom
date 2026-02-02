<?php
/* @var $this PersonjudgeController */
/* @var $model Personjudge */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-judge-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'judge_personid'); ?>
		<?php echo $form->textField($model,'judge_personid'); ?>
		<?php echo $form->error($model,'judge_personid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobarat_year'); ?>
		<?php echo $form->textField($model,'mobarat_year'); ?>
		<?php echo $form->error($model,'mobarat_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'judge_speciality1'); ?>
		<?php echo $form->textField($model,'judge_speciality1',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'judge_speciality1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'judge_speciality2'); ?>
		<?php echo $form->textField($model,'judge_speciality2',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'judge_speciality2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'judge_degree1'); ?>
		<?php echo $form->textField($model,'judge_degree1',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'judge_degree1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'judge_degree2'); ?>
		<?php echo $form->textField($model,'judge_degree2',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'judge_degree2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'judge_institute'); ?>
		<?php echo $form->textField($model,'judge_institute',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'judge_institute'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'judge_job'); ?>
		<?php echo $form->textField($model,'judge_job',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'judge_job'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'judge_stage'); ?>
		<?php echo $form->textField($model,'judge_stage',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'judge_stage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'judge_registrationStep'); ?>
		<?php echo $form->textField($model,'judge_registrationStep',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'judge_registrationStep'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'confirmation_code'); ?>
		<?php echo $form->textField($model,'confirmation_code',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'confirmation_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_confirmed'); ?>
		<?php echo $form->textField($model,'is_confirmed'); ?>
		<?php echo $form->error($model,'is_confirmed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->