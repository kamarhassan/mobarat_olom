<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
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
		<?php echo $form->labelEx($model,'school_id'); ?>
		<?php echo $form->textField($model,'school_id'); ?>
		<?php echo $form->error($model,'school_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_name'); ?>
		<?php echo $form->textField($model,'project_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'project_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_type'); ?>
		<?php echo $form->textField($model,'project_type',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'project_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_stage'); ?>
		<?php echo $form->textField($model,'project_stage',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'project_stage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_path'); ?>
		<?php echo $form->textField($model,'project_path',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'project_path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_prize'); ?>
		<?php echo $form->textField($model,'project_prize',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'project_prize'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_description'); ?>
		<?php echo $form->textArea($model,'project_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'project_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_goal'); ?>
		<?php echo $form->textArea($model,'project_goal',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'project_goal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_tools'); ?>
		<?php echo $form->textField($model,'project_tools',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'project_tools'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_steps'); ?>
		<?php echo $form->textArea($model,'project_steps',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'project_steps'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_attachment'); ?>
		<?php echo $form->textField($model,'project_attachment',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'project_attachment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_oldid'); ?>
		<?php echo $form->textField($model,'project_oldid'); ?>
		<?php echo $form->error($model,'project_oldid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->