<?php
/* @var $this MbUserController */
/* @var $model MbUser */

$this->breadcrumbs=array(
	'Mb Users'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MbUser', 'url'=>array('index')),
	array('label'=>'Create MbUser', 'url'=>array('create')),
	array('label'=>'View MbUser', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage MbUser', 'url'=>array('admin')),
);
?>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>