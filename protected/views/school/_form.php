<?php
/* @var $this SchoolController */
/* @var $model School */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'school-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'school_name'); ?>
		<?php echo $form->textField($model,'school_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'school_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_ename'); ?>
		<?php echo $form->textField($model,'school_ename',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'school_ename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_place'); ?>
		<?php echo $form->textField($model,'school_place',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'school_place'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_street'); ?>
		<?php echo $form->textField($model,'school_street',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'school_street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_email'); ?>
		<?php echo $form->textField($model,'school_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'school_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_phone'); ?>
		<?php echo $form->textField($model,'school_phone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'school_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_extraphone'); ?>
		<?php echo $form->textField($model,'school_extraphone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'school_extraphone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_fax'); ?>
		<?php echo $form->textField($model,'school_fax',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'school_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_pobox'); ?>
		<?php echo $form->textField($model,'school_pobox',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'school_pobox'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_level'); ?>
		<?php echo $form->textField($model,'school_level',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'school_level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_type'); ?>
		<?php echo $form->textField($model,'school_type',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'school_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_oldID'); ?>
		<?php echo $form->textField($model,'school_oldID'); ?>
		<?php echo $form->error($model,'school_oldID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_ManagerPersonID'); ?>
		<?php echo $form->textField($model,'school_ManagerPersonID'); ?>
		<?php echo $form->error($model,'school_ManagerPersonID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->