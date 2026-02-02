<?php
/* @var $this PersonjudgeController */
/* @var $model Personjudge */

$this->breadcrumbs=array(
	'Person Judges'=>array('index'),
	$model->judge_id,
);

$this->menu=array(
	array('label'=>'List Personjudge', 'url'=>array('index')),
	array('label'=>'Create Personjudge', 'url'=>array('create')),
	array('label'=>'Update Personjudge', 'url'=>array('update', 'id'=>$model->judge_id)),
	array('label'=>'Delete Personjudge', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->judge_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Personjudge', 'url'=>array('admin')),
);
?>

<h1>View Personjudge #<?php echo $model->judge_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'judge_id',
		'judge_personid',
		'mobarat_year',
		'judge_speciality1',
		'judge_speciality2',
		'judge_degree1',
		'judge_degree2',
		'judge_institute',
		'judge_job',
		'judge_stage',
		'judge_registrationStep',
		'confirmation_code',
		'is_confirmed',
	),
)); ?>
