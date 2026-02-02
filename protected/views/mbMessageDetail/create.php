<?php
/* @var $this MbMessageDetailController */
/* @var $model MbMessageDetail */

$this->breadcrumbs=array(
	'Mb Message Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MbMessageDetail', 'url'=>array('index')),
	array('label'=>'Manage MbMessageDetail', 'url'=>array('admin')),
);
?>

<h1>Create MbMessageDetail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>