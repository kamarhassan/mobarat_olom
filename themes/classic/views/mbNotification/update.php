<?php
/* @var $this MbNotificationController */
/* @var $model MbNotification */

$this->breadcrumbs=array(
	'Mb Notifications'=>array('index'),
	$model->notification_id=>array('view','id'=>$model->notification_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MbNotification', 'url'=>array('index')),
	array('label'=>'Create MbNotification', 'url'=>array('create')),
	array('label'=>'View MbNotification', 'url'=>array('view', 'id'=>$model->notification_id)),
	array('label'=>'Manage MbNotification', 'url'=>array('admin')),
);
?>

<h1>Update MbNotification <?php echo $model->notification_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>