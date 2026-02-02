<?php
/* @var $this PersonController */
/* @var $model Person */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'person-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_fname'); ?>
		<?php echo $form->textField($model,'Person_fname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Person_fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_mname'); ?>
		<?php echo $form->textField($model,'Person_mname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Person_mname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_lname'); ?>
		<?php echo $form->textField($model,'Person_lname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Person_lname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_sex'); ?>
		<?php echo $form->textField($model,'Person_sex',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'Person_sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_Salutation'); ?>
		<?php echo $form->textField($model,'Person_Salutation',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'Person_Salutation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_birthdate'); ?>
		<?php echo $form->textField($model,'Person_birthdate'); ?>
		<?php echo $form->error($model,'Person_birthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_Address'); ?>
		<?php echo $form->textField($model,'Person_Address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Person_Address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_email1'); ?>
		<?php echo $form->textField($model,'Person_email1',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Person_email1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_email2'); ?>
		<?php echo $form->textField($model,'Person_email2',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Person_email2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_Phone'); ?>
		<?php echo $form->textField($model,'Person_Phone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Person_Phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_CellPhone'); ?>
		<?php echo $form->textField($model,'Person_CellPhone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Person_CellPhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_whatsapp'); ?>
		<?php echo $form->textField($model,'Person_whatsapp'); ?>
		<?php echo $form->error($model,'Person_whatsapp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_pic'); ?>
		<?php echo $form->textField($model,'Person_pic',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Person_pic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Person_userID'); ?>
		<?php echo $form->textField($model,'Person_userID'); ?>
		<?php echo $form->error($model,'Person_userID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'person_efname'); ?>
		<?php echo $form->textField($model,'person_efname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'person_efname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'person_emname'); ?>
		<?php echo $form->textField($model,'person_emname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'person_emname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'person_elname'); ?>
		<?php echo $form->textField($model,'person_elname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'person_elname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'person_oldID'); ?>
		<?php echo $form->textField($model,'person_oldID'); ?>
		<?php echo $form->error($model,'person_oldID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->