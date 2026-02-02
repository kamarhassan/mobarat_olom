<?php
/* @var $this MbNotificationController */
/* @var $model MbNotification */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'notification_id'); ?>
		<?php echo $form->textField($model,'notification_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sender_id'); ?>
		<?php echo $form->textField($model,'sender_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notification_time'); ?>
		<?php echo $form->textField($model,'notification_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notification_date'); ?>
		<?php echo $form->textField($model,'notification_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notification_content'); ?>
		<?php echo $form->textField($model,'notification_content',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->