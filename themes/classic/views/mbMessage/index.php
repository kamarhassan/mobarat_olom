<?php
/* @var $this MbMessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mb Messages',
);

$this->menu=array(
	array('label'=>'Create MbMessage', 'url'=>array('create')),
	array('label'=>'Manage MbMessage', 'url'=>array('admin')),
);
?>

<h1>Mb Messages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
