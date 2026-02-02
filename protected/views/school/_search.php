<?php
/* @var $this SchoolController */
/* @var $model School */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'school_id'); ?>
		<?php echo $form->textField($model,'school_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_name'); ?>
		<?php echo $form->textField($model,'school_name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_ename'); ?>
		<?php echo $form->textField($model,'school_ename',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_place'); ?>
		<?php echo $form->textField($model,'school_place',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_street'); ?>
		<?php echo $form->textField($model,'school_street',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_email'); ?>
		<?php echo $form->textField($model,'school_email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_phone'); ?>
		<?php echo $form->textField($model,'school_phone',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_extraphone'); ?>
		<?php echo $form->textField($model,'school_extraphone',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_fax'); ?>
		<?php echo $form->textField($model,'school_fax',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_pobox'); ?>
		<?php echo $form->textField($model,'school_pobox',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_level'); ?>
		<?php echo $form->textField($model,'school_level',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_type'); ?>
		<?php echo $form->textField($model,'school_type',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_oldID'); ?>
		<?php echo $form->textField($model,'school_oldID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'school_ManagerPersonID'); ?>
		<?php echo $form->textField($model,'school_ManagerPersonID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->