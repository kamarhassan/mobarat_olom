<?php
/* @var $this SchoolController */
/* @var $model School */
/* @var $form CActiveForm */
?>
<?php //Yii::app()->clientScript->registerCoreScript('jquery'); 
?>
<?php
$baseUrl = Yii::app()->theme->baseUrl;

  //Yii::app()->clientScript->registerScript('scid','src="'.$baseUrl.'/assets/plugins/chosen.jquery.min.js" type="text/javascript"',CClientScript::POS_LOAD);


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */?>
<!--
 <link href="<?php echo $baseUrl; ?>/assets/plugins/chosen.min.css" rel="stylesheet" type="text/css"/>
 <script src="<?php echo $baseUrl; ?>/assets/plugins/chosen.jquery.js" type="text/javascript"></script>
-->
 
<!--
 <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-3.2.1.min.js" type="text/javascript"></script> 
                <script src="<?php echo $baseUrl; ?>/assets/plugins/chosen.jquery.min.js" type="text/javascript"></script>-->
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'school-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
        // 'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>



    <div class="row">
        <div class="col-md-2 "></div>
        <div class="col-md-7 ">
            
            <div class="col-md-4 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <a class='btn btn-warning btn-block' href="<?php echo Yii::app()->request->urlReferrer; ?>" style="text-decoration: none;">
                    <i class="icon-arrow-right"></i> رجوع
                </a>
            </div>

            <div class="col-md-4 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <?php
                echo CHtml::resetButton('مسح الكل', array('class' => 'btn btn-danger btn-block'), '<i class="icon-cut"></i> مسح الكل');
                ?>
            </div>

            <div class="col-md-4 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <?php echo CHtml::submitButton( 'Submit', array('class' => 'btn purple btn-block')); ?>
                <br>
            </div>
                <p class="note">جميع الخانات التي بجانبها <span class="required">*</span> ضرورية لإكمال عملية التسجيل.</p>
           

                <div class="portlet-title">
                        <?php 
                            
                            //$this->render('_Fields',$param);

                            $this->renderPartial('_Fields',array('form'=>$form,'model'=>$model),false,true);
                             
                        ?>
                             
                

            </div>
        </div>

    </div>
 
<?php $this->endWidget(); ?>

    </div>