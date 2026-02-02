<?php
/* @var $this MbNotificationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mb Notifications',
);

$this->menu=array(
	array('label'=>'Create MbNotification', 'url'=>array('create')),
	array('label'=>'Manage MbNotification', 'url'=>array('admin')),
);
?>

<h1>Mb Notifications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
