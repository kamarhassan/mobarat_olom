<?php
/* @var $this AuthenticateController */
/* @var $model Authenticate */

$this->breadcrumbs=array(
	'Authenticates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Authenticate', 'url'=>array('index')),
	array('label'=>'Create Authenticate', 'url'=>array('create')),
	array('label'=>'View Authenticate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Authenticate', 'url'=>array('admin')),
);
?>

<h1>Update Authenticate <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>