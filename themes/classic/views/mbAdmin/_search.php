<?php
/* @var $this MbAdminController */
/* @var $model MbAdmin */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'admin_id'); ?>
		<?php echo $form->textField($model,'admin_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_fname'); ?>
		<?php echo $form->textField($model,'admin_fname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_lname'); ?>
		<?php echo $form->textField($model,'admin_lname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_mname'); ?>
		<?php echo $form->textField($model,'admin_mname',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_sex'); ?>
		<?php echo $form->textField($model,'admin_sex',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_mobile'); ?>
		<?php echo $form->textField($model,'admin_mobile',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_email'); ?>
		<?php echo $form->textField($model,'admin_email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_user'); ?>
		<?php echo $form->textField($model,'admin_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'admin_flag'); ?>
		<?php echo $form->textField($model,'admin_flag'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->