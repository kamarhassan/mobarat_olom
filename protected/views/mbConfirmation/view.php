<?php
/* @var $this MbConfirmationController */
/* @var $model MbConfirmation */

$this->breadcrumbs=array(
	'Mb Confirmations'=>array('index'),
	$model->confirmation_id,
);

$this->menu=array(
	array('label'=>'List MbConfirmation', 'url'=>array('index')),
	array('label'=>'Create MbConfirmation', 'url'=>array('create')),
	array('label'=>'Update MbConfirmation', 'url'=>array('update', 'id'=>$model->confirmation_id)),
	array('label'=>'Delete MbConfirmation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->confirmation_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MbConfirmation', 'url'=>array('admin')),
);
?>

<h1>View MbConfirmation #<?php echo $model->confirmation_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'confirmation_id',
		'confirmation_school',
		'confirmation_code',
		'confirmation',
	),
)); ?>
