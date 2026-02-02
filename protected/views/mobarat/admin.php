<?php
/* @var $this MobaratController */
/* @var $model Mobarat */

$this->breadcrumbs=array(
	'Mobarats'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Mobarat', 'url'=>array('index')),
	array('label'=>'Create Mobarat', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mobarat-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mobarats</h1>

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
	'id'=>'mobarat-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'mobarat_year',
		'openForRegistration',
		'last_register_school',
		'last_register_project',
		'last_register_teacher_student',
		'last_update',
		/*
		'phone_trouble',
		'MaxNoOfProject',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
