<?php
/* @var $this MobaratController */
/* @var $model Mobarat */

$this->breadcrumbs=array(
	'Mobarats'=>array('index'),
	$model->mobarat_year,
);

$this->menu=array(
	array('label'=>'List Mobarat', 'url'=>array('index')),
	array('label'=>'Create Mobarat', 'url'=>array('create')),
	array('label'=>'Update Mobarat', 'url'=>array('update', 'id'=>$model->mobarat_year)),
	array('label'=>'Delete Mobarat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mobarat_year),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mobarat', 'url'=>array('admin')),
);
?>

<h1>إعدادات مباراة سنة <?php echo $model->mobarat_year; ?></h1>
 
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mobarat_year',
		'openForRegistration',
                'phone_trouble',
		'MaxNoOfProject',
                'maxNoOfSchool',
                'StudentNbForProject',
                'TeacherNbForProject',
		'last_register_school',
		'last_register_project',
		'last_register_teacher_student',
                'last_update_judge',
		'last_update',
		
                'firstDayJudge', 'secondDayJudge' , 'ceremonyDay','morningFrom' , 'morningTo' , 'eveningFrom', 'eveningTo' , 'ceremonyFrom', 'ceremonyTo','judgeprojectcount','openforupdate_fromdate','openforupdate_todate'
	),
)); ?>
