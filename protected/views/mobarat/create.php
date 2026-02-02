<?php
/* @var $this MobaratController */
/* @var $model Mobarat */

$this->breadcrumbs=array(
	'Mobarats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Mobarat', 'url'=>array('index')),
	array('label'=>'Manage Mobarat', 'url'=>array('admin')),
);
?>

<h1>Create Mobarat</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>