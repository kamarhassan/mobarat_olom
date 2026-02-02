<?php
/* @var $this SchoolController */
/* @var $model School */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->school_id,
);

$this->menu=array(
	array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Create School', 'url'=>array('create')),
	array('label'=>'Update School', 'url'=>array('update', 'id'=>$model->school_id)),
	array('label'=>'Delete School', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->school_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage School', 'url'=>array('admin')),
);
?>

<h1>View School #<?php echo $model->school_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'school_id',
		'school_name',
		'school_ename',
		'school_place',
		'school_street',
		'school_email',
		'school_phone',
		'school_extraphone',
		'school_fax',
		'school_pobox',
		'school_level',
		'school_type',
		'school_oldID',
		'school_ManagerPersonID',
	),
)); ?>
