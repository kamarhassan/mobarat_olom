<?php
/* @var $this MbMessageDetailController */
/* @var $model MbMessageDetail */

$this->breadcrumbs=array(
	'Mb Message Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MbMessageDetail', 'url'=>array('index')),
	array('label'=>'Create MbMessageDetail', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mb-message-detail-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mb Message Details</h1>

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
	'id'=>'mb-message-detail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'mdetail_id',
		'mdetail_message',
		'mdetail_sender',
		'mdetail_receiver',
		'message_read_flag',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
