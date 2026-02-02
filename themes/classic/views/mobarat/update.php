<?php
/* @var $this MobaratController */
/* @var $model Mobarat */

$this->breadcrumbs=array(
	'Mobarats'=>array('index'),
	$model->mobarat_year=>array('view','id'=>$model->mobarat_year),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mobarat', 'url'=>array('index')),
	array('label'=>'Create Mobarat', 'url'=>array('create')),
	array('label'=>'View Mobarat', 'url'=>array('view', 'id'=>$model->mobarat_year)),
	array('label'=>'Manage Mobarat', 'url'=>array('admin')),
);
?>

<h1>تعديل إعدادت مباراة سنة  <?php echo $model->mobarat_year; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'prj_codes' => $prj_codes,'halls_codes'=>$halls_codes)); ?>