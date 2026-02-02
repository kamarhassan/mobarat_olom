<?php
/* @var $this MobaratController */
/* @var $model Mobarat */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'mobarat_year'); ?>
		<?php echo $form->textField($model,'mobarat_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'openForRegistration'); ?>
		<?php echo $form->textField($model,'openForRegistration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_register_school'); ?>
		<?php echo $form->textField($model,'last_register_school'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_register_project'); ?>
		<?php echo $form->textField($model,'last_register_project'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_register_teacher_student'); ?>
		<?php echo $form->textField($model,'last_register_teacher_student'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_update'); ?>
		<?php echo $form->textField($model,'last_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone_trouble'); ?>
		<?php echo $form->textField($model,'phone_trouble',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MaxNoOfProject'); ?>
		<?php echo $form->textField($model,'MaxNoOfProject'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->