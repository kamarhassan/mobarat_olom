<?php
/* @var $this MbAdminController */
/* @var $model MbAdmin */

$this->breadcrumbs=array(
	'Mb Admins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MbAdmin', 'url'=>array('index')),
	array('label'=>'Manage MbAdmin', 'url'=>array('admin')),
);
?>

<h1>Create MbAdmin</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>