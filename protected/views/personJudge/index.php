<?php
/* @var $this PersonjudgeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Person Judges',
);

$this->menu=array(
	array('label'=>'Create Personjudge', 'url'=>array('create')),
	array('label'=>'Manage Personjudge', 'url'=>array('admin')),
);
?>

<h1>Person Judges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
