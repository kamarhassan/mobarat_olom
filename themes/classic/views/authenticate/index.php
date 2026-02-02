<?php
/* @var $this AuthenticateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Authenticates',
);

$this->menu=array(
	array('label'=>'Create Authenticate', 'url'=>array('create')),
	array('label'=>'Manage Authenticate', 'url'=>array('admin')),
);
?>

<h1>Authenticates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
