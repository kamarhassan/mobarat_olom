<?php
/* @var $this PersonController */
/* @var $model Person */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Person_id'); ?>
		<?php echo $form->textField($model,'Person_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_fname'); ?>
		<?php echo $form->textField($model,'Person_fname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_mname'); ?>
		<?php echo $form->textField($model,'Person_mname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_lname'); ?>
		<?php echo $form->textField($model,'Person_lname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_sex'); ?>
		<?php echo $form->textField($model,'Person_sex',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_Salutation'); ?>
		<?php echo $form->textField($model,'Person_Salutation',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_birthdate'); ?>
		<?php echo $form->textField($model,'Person_birthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_Address'); ?>
		<?php echo $form->textField($model,'Person_Address',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_email1'); ?>
		<?php echo $form->textField($model,'Person_email1',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_email2'); ?>
		<?php echo $form->textField($model,'Person_email2',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_Phone'); ?>
		<?php echo $form->textField($model,'Person_Phone',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_CellPhone'); ?>
		<?php echo $form->textField($model,'Person_CellPhone',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_whatsapp'); ?>
		<?php echo $form->textField($model,'Person_whatsapp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_pic'); ?>
		<?php echo $form->textField($model,'Person_pic',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Person_userID'); ?>
		<?php echo $form->textField($model,'Person_userID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'person_efname'); ?>
		<?php echo $form->textField($model,'person_efname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'person_emname'); ?>
		<?php echo $form->textField($model,'person_emname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'person_elname'); ?>
		<?php echo $form->textField($model,'person_elname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'person_oldID'); ?>
		<?php echo $form->textField($model,'person_oldID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->