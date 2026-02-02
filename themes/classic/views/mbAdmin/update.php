<?php
/* @var $this MbAdminController */
/* @var $model MbAdmin */

$this->breadcrumbs=array(
	'Mb Admins'=>array('index'),
	$model->admin_id=>array('view','id'=>$model->admin_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MbAdmin', 'url'=>array('index')),
	array('label'=>'Create MbAdmin', 'url'=>array('create')),
	array('label'=>'View MbAdmin', 'url'=>array('view', 'id'=>$model->admin_id)),
	array('label'=>'Manage MbAdmin', 'url'=>array('admin')),
);
?>

<h1>Update MbAdmin <?php echo $model->admin_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>