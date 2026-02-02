<?php
/* @var $this PersonjudgeController */
/* @var $model Personjudge */

$this->breadcrumbs=array(
	'Person Judges'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Personjudge', 'url'=>array('index')),
	array('label'=>'Create Personjudge', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#person-judge-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Person Judges</h1>

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
	'id'=>'person-judge-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'judge_id',
		'judge_personid',
		'mobarat_year',
		'judge_speciality1',
		'judge_speciality2',
		'judge_degree1',
		/*
		'judge_degree2',
		'judge_institute',
		'judge_job',
		'judge_stage',
		'judge_registrationStep',
		'confirmation_code',
		'is_confirmed',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
