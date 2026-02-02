<?php
/* @var $this MbConfirmationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mb Confirmations',
);

$this->menu=array(
	array('label'=>'Create MbConfirmation', 'url'=>array('create')),
	array('label'=>'Manage MbConfirmation', 'url'=>array('admin')),
);
?>

<h1>Mb Confirmations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
