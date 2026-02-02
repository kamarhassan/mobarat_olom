<?php
/* @var $this MbMessageDetailController */
/* @var $model MbMessageDetail */

$this->breadcrumbs=array(
	'Mb Message Details'=>array('index'),
	$model->mdetail_id,
);

$this->menu=array(
	array('label'=>'List MbMessageDetail', 'url'=>array('index')),
	array('label'=>'Create MbMessageDetail', 'url'=>array('create')),
	array('label'=>'Update MbMessageDetail', 'url'=>array('update', 'id'=>$model->mdetail_id)),
	array('label'=>'Delete MbMessageDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mdetail_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MbMessageDetail', 'url'=>array('admin')),
);
?>

<h1>View MbMessageDetail #<?php echo $model->mdetail_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mdetail_id',
		'mdetail_message',
		'mdetail_sender',
		'mdetail_receiver',
		'message_read_flag',
	),
)); ?>
