<?php
/* @var $this ProjectController */
/* @var $data Project */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->project_id), array('view', 'id'=>$data->project_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobarat_year')); ?>:</b>
	<?php echo CHtml::encode($data->mobarat_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_id')); ?>:</b>
	<?php echo CHtml::encode($data->school_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_name')); ?>:</b>
	<?php echo CHtml::encode($data->project_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_type')); ?>:</b>
	<?php echo CHtml::encode($data->project_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_stage')); ?>:</b>
	<?php echo CHtml::encode($data->project_stage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_path')); ?>:</b>
	<?php echo CHtml::encode($data->project_path); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('project_prize')); ?>:</b>
	<?php echo CHtml::encode($data->project_prize); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_description')); ?>:</b>
	<?php echo CHtml::encode($data->project_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_goal')); ?>:</b>
	<?php echo CHtml::encode($data->project_goal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_tools')); ?>:</b>
	<?php echo CHtml::encode($data->project_tools); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_steps')); ?>:</b>
	<?php echo CHtml::encode($data->project_steps); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_attachment')); ?>:</b>
	<?php echo CHtml::encode($data->project_attachment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_oldid')); ?>:</b>
	<?php echo CHtml::encode($data->project_oldid); ?>
	<br />

	*/ ?>

</div>