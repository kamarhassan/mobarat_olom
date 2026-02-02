<?php
/* @var $this MbMessageDetailController */
/* @var $model MbMessageDetail */

$this->breadcrumbs=array(
	'Mb Message Details'=>array('index'),
	$model->mdetail_id=>array('view','id'=>$model->mdetail_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MbMessageDetail', 'url'=>array('index')),
	array('label'=>'Create MbMessageDetail', 'url'=>array('create')),
	array('label'=>'View MbMessageDetail', 'url'=>array('view', 'id'=>$model->mdetail_id)),
	array('label'=>'Manage MbMessageDetail', 'url'=>array('admin')),
);
?>

<h1>Update MbMessageDetail <?php echo $model->mdetail_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>