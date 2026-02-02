<?php
/* @var $this MbNotificationController */
/* @var $model MbNotification */

$this->breadcrumbs=array(
	'Mb Notifications'=>array('index'),
	$model->notification_id,
);

$this->menu=array(
	array('label'=>'List MbNotification', 'url'=>array('index')),
	array('label'=>'Create MbNotification', 'url'=>array('create')),
	array('label'=>'Update MbNotification', 'url'=>array('update', 'id'=>$model->notification_id)),
	array('label'=>'Delete MbNotification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->notification_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MbNotification', 'url'=>array('admin')),
);
?>

<h1>View MbNotification #<?php echo $model->notification_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'notification_id',
		'sender_id',
		'notification_time',
		'notification_date',
		'notification_content',
	),
)); ?>
