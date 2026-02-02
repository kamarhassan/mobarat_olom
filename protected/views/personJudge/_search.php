<?php
/* @var $this PersonjudgeController */
/* @var $model Personjudge */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'judge_id'); ?>
		<?php echo $form->textField($model,'judge_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judge_personid'); ?>
		<?php echo $form->textField($model,'judge_personid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobarat_year'); ?>
		<?php echo $form->textField($model,'mobarat_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judge_speciality1'); ?>
		<?php echo $form->textField($model,'judge_speciality1',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judge_speciality2'); ?>
		<?php echo $form->textField($model,'judge_speciality2',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judge_degree1'); ?>
		<?php echo $form->textField($model,'judge_degree1',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judge_degree2'); ?>
		<?php echo $form->textField($model,'judge_degree2',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judge_institute'); ?>
		<?php echo $form->textField($model,'judge_institute',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judge_job'); ?>
		<?php echo $form->textField($model,'judge_job',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judge_stage'); ?>
		<?php echo $form->textField($model,'judge_stage',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'judge_registrationStep'); ?>
		<?php echo $form->textField($model,'judge_registrationStep',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'confirmation_code'); ?>
		<?php echo $form->textField($model,'confirmation_code',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_confirmed'); ?>
		<?php echo $form->textField($model,'is_confirmed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->