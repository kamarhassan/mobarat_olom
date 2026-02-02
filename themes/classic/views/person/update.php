<?php
/* @var $this SchoolController */
/* @var $model School */
/* @var $form CActiveForm */
?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); 
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'school-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
         'htmlOptions' => array('enctype' => 'multipart/form-data')
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
               <!-- <input type="hidden" name="destination" value="<?php echo Yii::app()->request->urlReferrer; ?>"/>-->
                <br>
            </div>
                <p class="note">جميع الخانات التي بجانبها <span class="required">*</span> ضرورية لإكمال عملية التسجيل.</p>
           

                <div class="portlet-title">
                        <?php 
                            $param=array();
                            $param['form']=$form;
                            $param['model']=$pers;
                            if(isset($title) )
                                $param['title']=$title;
                            if(isset($enmPersonType) )
                                $param['enmPersonType']=$enmPersonType;
                            if(isset($oteach) )
                                $param['oteach']=$oteach;
                            if(isset($teach) )
                                $param['teach']=$teach;
                            if(isset($std) )
                                $param['std']=$std;
                             if(isset($jud) ){
                                $param['jud']=$jud;
                                $param['judselect']=$judselect;
                             }
                            //$this->render('_Fields',$param);

                            $this->renderPartial('_Fields',$param,false,false);
                             
                        ?>
                             
                

            </div>
        </div>

    </div>
 
<?php $this->endWidget(); ?>

    </div>