<?php
/* @var $this MbProjectController */
/* @var $model MbProject */

$this->breadcrumbs=array(
	'Mb Projects'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List MbProject', 'url'=>array('index')),
	array('label'=>'Manage MbProject', 'url'=>array('admin')),
);*/
?>

<h1>تسجيل مشروع جديد</h1>

<?php $this->renderPartial('_form', array('model'=>$model,
                        'school'=>$school,)); ?>