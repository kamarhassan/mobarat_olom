<?php
/* @var $this MbMessageDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mb Message Details',
);

$this->menu=array(
	array('label'=>'Create MbMessageDetail', 'url'=>array('create')),
	array('label'=>'Manage MbMessageDetail', 'url'=>array('admin')),
);
?>

<h1>Mb Message Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
