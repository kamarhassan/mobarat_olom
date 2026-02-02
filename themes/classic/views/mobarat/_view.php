<?php
/* @var $this MobaratController */
/* @var $data Mobarat */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobarat_year')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mobarat_year), array('view', 'id'=>$data->mobarat_year)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('openForRegistration')); ?>:</b>
	<?php echo CHtml::encode($data->openForRegistration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_register_school')); ?>:</b>
	<?php echo CHtml::encode($data->last_register_school); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_register_project')); ?>:</b>
	<?php echo CHtml::encode($data->last_register_project); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_register_teacher_student')); ?>:</b>
	<?php echo CHtml::encode($data->last_register_teacher_student); ?>
	<br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('last_update_judge')); ?>:</b>
	<?php echo CHtml::encode($data->last_update_judge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_update')); ?>:</b>
	<?php echo CHtml::encode($data->last_update); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_trouble')); ?>:</b>
	<?php echo CHtml::encode($data->phone_trouble); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('firstDayJudge')); ?>:</b>
	<?php echo CHtml::encode($data->firstDayJudge); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('secondDayJudge')); ?>:</b>
	<?php echo CHtml::encode($data->secondDayJudge); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('ceremonyDay')); ?>:</b>
	<?php echo CHtml::encode($data->ceremonyDay); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('morningFrom')); ?>:</b>
	<?php echo CHtml::encode($data->morningFrom); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('morningTo')); ?>:</b>
	<?php echo CHtml::encode($data->morningTo); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('eveningFrom')); ?>:</b>
	<?php echo CHtml::encode($data->eveningFrom); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('eveningTo')); ?>:</b>
	<?php echo CHtml::encode($data->eveningTo); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('ceremonyFrom')); ?>:</b>
	<?php echo CHtml::encode($data->ceremonyFrom); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('ceremonyTo')); ?>:</b>
	<?php echo CHtml::encode($data->ceremonyTo); ?>
	<br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('judgeprojectcount')); ?></b>
	<?php echo CHtml::encode($data->judgeprojectcount); ?>
	<br />
        
       

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('MaxNoOfProject')); ?>:</b>
	<?php echo CHtml::encode($data->MaxNoOfProject); ?>
	<br />

	*/ ?>

</div>