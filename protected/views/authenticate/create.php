<?php
/* @var $this AuthenticateController */
/* @var $model Authenticate */

$this->breadcrumbs=array(
	'Authenticates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Authenticate', 'url'=>array('index')),
	array('label'=>'Manage Authenticate', 'url'=>array('admin')),
);
?>

<h1>Create Authenticate</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>