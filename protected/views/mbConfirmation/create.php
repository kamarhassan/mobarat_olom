<?php
/* @var $this MbConfirmationController */
/* @var $model MbConfirmation */

$this->breadcrumbs=array(
	'Mb Confirmations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MbConfirmation', 'url'=>array('index')),
	array('label'=>'Manage MbConfirmation', 'url'=>array('admin')),
);
?>

<h1>Create MbConfirmation</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>