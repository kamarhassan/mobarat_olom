<?php
/* @var $this MbAdminController */
/* @var $model MbAdmin */

$this->breadcrumbs=array(
	'Mb Admins'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MbAdmin', 'url'=>array('index')),
	array('label'=>'Create MbAdmin', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mb-admin-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mb Admins</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mb-admin-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'admin_id',
		'admin_fname',
		'admin_lname',
		'admin_mname',
		'admin_sex',
		'admin_mobile',
		/*
		'admin_email',
		'admin_user',
		'admin_flag',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
