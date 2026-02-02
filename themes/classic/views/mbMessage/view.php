<?php
/* @var $this MbMessageController */
/* @var $model MbMessage */

$this->breadcrumbs=array(
	'Mb Messages'=>array('index'),
	$model->message_id,
);

$this->menu=array(
	array('label'=>'List MbMessage', 'url'=>array('index')),
	array('label'=>'Create MbMessage', 'url'=>array('create')),
	array('label'=>'Update MbMessage', 'url'=>array('update', 'id'=>$model->message_id)),
	array('label'=>'Delete MbMessage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->message_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MbMessage', 'url'=>array('admin')),
);
?>

<h1>View MbMessage #<?php echo $model->message_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'message_id',
		'message_subject',
		'message_content',
		'message_date',
	),
)); ?>
