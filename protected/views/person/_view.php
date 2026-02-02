<?php
/* @var $this PersonController */
/* @var $data Person */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Person_id), array('view', 'id'=>$data->Person_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_fname')); ?>:</b>
	<?php echo CHtml::encode($data->Person_fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_mname')); ?>:</b>
	<?php echo CHtml::encode($data->Person_mname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_lname')); ?>:</b>
	<?php echo CHtml::encode($data->Person_lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_sex')); ?>:</b>
	<?php echo CHtml::encode($data->Person_sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_Salutation')); ?>:</b>
	<?php echo CHtml::encode($data->Person_Salutation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_birthdate')); ?>:</b>
	<?php echo CHtml::encode($data->Person_birthdate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_Address')); ?>:</b>
	<?php echo CHtml::encode($data->Person_Address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_email1')); ?>:</b>
	<?php echo CHtml::encode($data->Person_email1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_email2')); ?>:</b>
	<?php echo CHtml::encode($data->Person_email2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_Phone')); ?>:</b>
	<?php echo CHtml::encode($data->Person_Phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_CellPhone')); ?>:</b>
	<?php echo CHtml::encode($data->Person_CellPhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_whatsapp')); ?>:</b>
	<?php echo CHtml::encode($data->Person_whatsapp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_pic')); ?>:</b>
	<?php echo CHtml::encode($data->Person_pic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Person_userID')); ?>:</b>
	<?php echo CHtml::encode($data->Person_userID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('person_efname')); ?>:</b>
	<?php echo CHtml::encode($data->person_efname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('person_emname')); ?>:</b>
	<?php echo CHtml::encode($data->person_emname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('person_elname')); ?>:</b>
	<?php echo CHtml::encode($data->person_elname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('person_oldID')); ?>:</b>
	<?php echo CHtml::encode($data->person_oldID); ?>
	<br />

	*/ ?>

</div>