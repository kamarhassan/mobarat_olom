<?php
/* @var $this MbConfirmationController */
/* @var $model MbConfirmation */

$this->breadcrumbs=array(
	'Mb Confirmations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MbConfirmation', 'url'=>array('index')),
	array('label'=>'Create MbConfirmation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mb-confirmation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mb Confirmations</h1>

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
	'id'=>'mb-confirmation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'confirmation_id',
		'confirmation_school',
		'confirmation_code',
		'confirmation',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
