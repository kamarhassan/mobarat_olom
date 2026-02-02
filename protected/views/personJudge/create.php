<?php
/* @var $this PersonjudgeController */
/* @var $model Personjudge */

$this->breadcrumbs=array(
	'Person Judges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Personjudge', 'url'=>array('index')),
	array('label'=>'Manage Personjudge', 'url'=>array('admin')),
);
?>

<h1>Create Personjudge</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>