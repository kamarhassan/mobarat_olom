<?php
/* @var $this SchoolController */
/* @var $model School */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Manage School', 'url'=>array('admin')),
);
?>

<h1>
    <?php
        $param=array( 'model'=>$model,'oteachperson'=>$oteachperson,'oteach'=>$oteach,'manager'=>$manager);
        
        if(isset($myear)){
            $param['myear']=$myear;
            echo 'تسجيل مدرسة مشاركة في مباراة سابقة';
        }
        else 
            echo 'تسجيل مدرسة جديدة';
    ?>
</h1>

<?php 
$this->renderPartial('_form',$param ); 
?>