<?php
/* @var $this MbNotificationController */
/* @var $model MbNotification */

$this->breadcrumbs=array(
	'Mb Notifications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MbNotification', 'url'=>array('index')),
	array('label'=>'Manage MbNotification', 'url'=>array('admin')),
);
?>

<h1>Create MbNotification</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>