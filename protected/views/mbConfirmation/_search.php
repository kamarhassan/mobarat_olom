<?php
/* @var $this MbConfirmationController */
/* @var $model MbConfirmation */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'confirmation_id'); ?>
		<?php echo $form->textField($model,'confirmation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'confirmation_school'); ?>
		<?php echo $form->textField($model,'confirmation_school'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'confirmation_code'); ?>
		<?php echo $form->textField($model,'confirmation_code',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'confirmation'); ?>
		<?php echo $form->textField($model,'confirmation'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->