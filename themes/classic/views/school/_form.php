<?php
/* @var $this SchoolController */
/* @var $model School */
/* @var $form CActiveForm */
?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
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
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Submit', array('class' => 'btn purple btn-block', 'url' => ('School/completeReg'))); ?>
                <br>
            </div>
                <p class="note">جميع الخانات التي بجانبها <span class="required">*</span> ضرورية لإكمال عملية التسجيل.</p>
           
                <div>
                    <?php
                        if(isset($myear)){
                            echo"<table><tr><td width='100'>";//</td></tr></table>
                            echo CHtml::label('إختيار السنة',false);
                            echo "</td><td width='100'>";
                            $current= Mobarat::getOpenMobaratRecord();
                            $records=Yii::app()->db->createCommand("select mobarat_year as code_no, mobarat_year as code_name from mobarat where  mobarat_year!=".$current['mobarat_year'])->queryAll();
                            $list = CHtml::listData($records, 'code_no', 'code_name');
                            echo CHtml::dropDownList('lstmyear', $myear, $list, array('empty' => 'إختر','class' => 'form-control'));
                            echo"</td></tr></table>";
                            
                            $enmPTOTeacher= enm_PersonType::OLD_OTEACHER;
                            $enmPTManager= enm_PersonType::OLD_MANAGER;
                            $enmST= enm_SchoolType::OLD_SCHOOL;
                        }
                        else{
                            $enmPTOTeacher= enm_PersonType::OTEACHER;
                            $enmPTManager= enm_PersonType::MANAGER;
                            $enmST= enm_SchoolType::SCHOOL;
                        }
                            
                    ?>
                </div>
                <div class="portlet-title">
                        <?php 
    
                            $this->widget('zii.widgets.jui.CJuiTabs',array(
                                'tabs'=>array('المدرسة'=>array('id'=>'tab_School'
                                        ,'content'=>$this->renderPartial('_Fields',array('form'=>$form,'model'=>$model,'enmSchoolType'=>$enmST),TRUE))
                                   ,'المدير'=>array('id'=>'tab_Manager'
                                        ,'content'=>$this->renderPartial('/person/_Fields',array('form'=>$form,'title'=>'معلومات المدير '
                                            ,'model'=>$manager,'enmPersonType'=>  $enmPTManager,'modelIndex'=>1),TRUE))
                                     ,'الاستاذ المسؤول'=>array('id'=>'tab_Oteach'
                                        ,'content'=>$this->renderPartial('/person/_Fields',array('form'=>$form,'title'=>'معلومات الأستاذ المسؤول'
                                            ,'model'=>$oteachperson,'enmPersonType'=>  $enmPTOTeacher,'oteach'=>$oteach,'modelIndex'=>0),TRUE))
                        
         
                        ),
        ));
    ?>
                

            </div>
                
                <p class="note">جميع الخانات التي بجانبها <span class="required">*</span> ضرورية لإكمال عملية التسجيل.</p>
            
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
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Submit', array('class' => 'btn purple btn-block', 'url' => ('School/completeReg'))); ?>
                <br>
            </div>
        </div>

    </div>
 
	



<?php $this->endWidget(); ?>

    </div>