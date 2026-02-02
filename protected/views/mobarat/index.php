<?php
/* @var $this MobaratController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mobarats',
);

$this->menu=array(
	array('label'=>'Create Mobarat', 'url'=>array('create')),
	array('label'=>'Manage Mobarat', 'url'=>array('admin')),
);
?>

<h1>Mobarats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
