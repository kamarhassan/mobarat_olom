<?php
/* @var $this MbConfirmationController */
/* @var $model MbConfirmation */

$this->breadcrumbs=array(
	'Mb Confirmations'=>array('index'),
	$model->confirmation_id=>array('view','id'=>$model->confirmation_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MbConfirmation', 'url'=>array('index')),
	array('label'=>'Create MbConfirmation', 'url'=>array('create')),
	array('label'=>'View MbConfirmation', 'url'=>array('view', 'id'=>$model->confirmation_id)),
	array('label'=>'Manage MbConfirmation', 'url'=>array('admin')),
);
?>

<h1>Update MbConfirmation <?php echo $model->confirmation_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>