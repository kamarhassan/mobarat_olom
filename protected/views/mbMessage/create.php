<?php
/* @var $this MbMessageController */
/* @var $model MbMessage */

$this->breadcrumbs=array(
	'Mb Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MbMessage', 'url'=>array('index')),
	array('label'=>'Manage MbMessage', 'url'=>array('admin')),
);
?>

<h1>Create MbMessage</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>