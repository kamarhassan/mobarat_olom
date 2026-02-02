<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->project_id,
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Update Project', 'url'=>array('update', 'id'=>$model->project_id)),
	array('label'=>'Delete Project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->project_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h1>View Project #<?php echo $model->project_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'project_id',
		'mobarat_year',
		'school_id',
		'project_name',
		'project_type',
		'project_stage',
		'project_path',
		'project_prize',
		'project_description',
		'project_goal',
		'project_tools',
		'project_steps',
		'project_attachment',
		'project_oldid',
	),
)); ?>
