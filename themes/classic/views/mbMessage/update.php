<?php
/* @var $this MbMessageController */
/* @var $model MbMessage */

$this->breadcrumbs=array(
	'Mb Messages'=>array('index'),
	$model->message_id=>array('view','id'=>$model->message_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MbMessage', 'url'=>array('index')),
	array('label'=>'Create MbMessage', 'url'=>array('create')),
	array('label'=>'View MbMessage', 'url'=>array('view', 'id'=>$model->message_id)),
	array('label'=>'Manage MbMessage', 'url'=>array('admin')),
);
?>

<h1>Update MbMessage <?php echo $model->message_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>