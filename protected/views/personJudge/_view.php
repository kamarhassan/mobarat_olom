<?php
/* @var $this PersonjudgeController */
/* @var $data Personjudge */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('judge_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->judge_id), array('view', 'id'=>$data->judge_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judge_personid')); ?>:</b>
	<?php echo CHtml::encode($data->judge_personid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobarat_year')); ?>:</b>
	<?php echo CHtml::encode($data->mobarat_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judge_speciality1')); ?>:</b>
	<?php echo CHtml::encode($data->judge_speciality1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judge_speciality2')); ?>:</b>
	<?php echo CHtml::encode($data->judge_speciality2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judge_degree1')); ?>:</b>
	<?php echo CHtml::encode($data->judge_degree1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judge_degree2')); ?>:</b>
	<?php echo CHtml::encode($data->judge_degree2); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('judge_institute')); ?>:</b>
	<?php echo CHtml::encode($data->judge_institute); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judge_job')); ?>:</b>
	<?php echo CHtml::encode($data->judge_job); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judge_stage')); ?>:</b>
	<?php echo CHtml::encode($data->judge_stage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judge_registrationStep')); ?>:</b>
	<?php echo CHtml::encode($data->judge_registrationStep); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('confirmation_code')); ?>:</b>
	<?php echo CHtml::encode($data->confirmation_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_confirmed')); ?>:</b>
	<?php echo CHtml::encode($data->is_confirmed); ?>
	<br />

	*/ ?>

</div>