<?php
/* @var $this AuthenticateController */
/* @var $model Authenticate */

$this->breadcrumbs=array(
	'Authenticates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Authenticate', 'url'=>array('index')),
	array('label'=>'Create Authenticate', 'url'=>array('create')),
	array('label'=>'Update Authenticate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Authenticate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Authenticate', 'url'=>array('admin')),
);
?>

<h1>View Authenticate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userId',
		'pageId',
		'status',
	),
)); ?>
