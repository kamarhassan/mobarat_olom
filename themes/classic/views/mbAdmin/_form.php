<?php
/* @var $this MbAdminController */
/* @var $model MbAdmin */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mb-admin-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'admin_fname'); ?>
		<?php echo $form->textField($model,'admin_fname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'admin_fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'admin_lname'); ?>
		<?php echo $form->textField($model,'admin_lname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'admin_lname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'admin_mname'); ?>
		<?php echo $form->textField($model,'admin_mname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'admin_mname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'admin_sex'); ?>
		<?php echo $form->textField($model,'admin_sex',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'admin_sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'admin_mobile'); ?>
		<?php echo $form->textField($model,'admin_mobile',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'admin_mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'admin_email'); ?>
		<?php echo $form->textField($model,'admin_email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'admin_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'admin_user'); ?>
		<?php echo $form->textField($model,'admin_user'); ?>
		<?php echo $form->error($model,'admin_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'admin_flag'); ?>
		<?php echo $form->textField($model,'admin_flag'); ?>
		<?php echo $form->error($model,'admin_flag'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->