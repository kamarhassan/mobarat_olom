<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'project_id'); ?>
		<?php echo $form->textField($model,'project_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobarat_year'); ?>
		<?php echo $form->textField($model,'mobarat_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_id'); ?>
		<?php echo $form->textField($model,'school_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_name'); ?>
		<?php echo $form->textField($model,'project_name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_type'); ?>
		<?php echo $form->textField($model,'project_type',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_stage'); ?>
		<?php echo $form->textField($model,'project_stage',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_path'); ?>
		<?php echo $form->textField($model,'project_path',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_prize'); ?>
		<?php echo $form->textField($model,'project_prize',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_description'); ?>
		<?php echo $form->textArea($model,'project_description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_goal'); ?>
		<?php echo $form->textArea($model,'project_goal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_tools'); ?>
		<?php echo $form->textField($model,'project_tools',array('size'=>60,'maxlength'=>5000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_steps'); ?>
		<?php echo $form->textArea($model,'project_steps',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_attachment'); ?>
		<?php echo $form->textField($model,'project_attachment',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_oldid'); ?>
		<?php echo $form->textField($model,'project_oldid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->