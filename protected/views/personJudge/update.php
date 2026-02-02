<?php
/* @var $this PersonjudgeController */
/* @var $model Personjudge */

$this->breadcrumbs=array(
	'Person Judges'=>array('index'),
	$model->judge_id=>array('view','id'=>$model->judge_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Personjudge', 'url'=>array('index')),
	array('label'=>'Create Personjudge', 'url'=>array('create')),
	array('label'=>'View Personjudge', 'url'=>array('view', 'id'=>$model->judge_id)),
	array('label'=>'Manage Personjudge', 'url'=>array('admin')),
);
?>

<h1>Update Personjudge <?php echo $model->judge_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>