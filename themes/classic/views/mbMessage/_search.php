<?php
/* @var $this MbMessageController */
/* @var $model MbMessage */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'message_id'); ?>
		<?php echo $form->textField($model,'message_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message_subject'); ?>
		<?php echo $form->textField($model,'message_subject',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message_content'); ?>
		<?php echo $form->textArea($model,'message_content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message_date'); ?>
		<?php echo $form->textField($model,'message_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->