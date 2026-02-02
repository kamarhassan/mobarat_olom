<?php
/* @var $this MbAdminController */
/* @var $model MbAdmin */

$this->breadcrumbs=array(
	'Mb Admins'=>array('index'),
	$model->admin_id,
);

$this->menu=array(
	array('label'=>'List MbAdmin', 'url'=>array('index')),
	array('label'=>'Create MbAdmin', 'url'=>array('create')),
	array('label'=>'Update MbAdmin', 'url'=>array('update', 'id'=>$model->admin_id)),
	array('label'=>'Delete MbAdmin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->admin_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MbAdmin', 'url'=>array('admin')),
);
?>

<h1>View MbAdmin #<?php echo $model->admin_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'admin_id',
		'admin_fname',
		'admin_lname',
		'admin_mname',
		'admin_sex',
		'admin_mobile',
		'admin_email',
		'admin_user',
		'admin_flag',
	),
)); ?>
