<?php
/* @var $this MbProjectController */
/* @var $model MbProject */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mb-project-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <div class="note note-success">
        <p>
            الوصف والأدوات التنفيذ و..) يمكن أن أكملها فيما بعد.

        </p>
    </div>

    <?php
    echo "

<div class='alert alert-danger'>";
    echo $form->error($model, 'project_name');
    echo $form->error($model, 'project_name_en');
    echo $form->error($model, 'project_type');
    echo $form->error($model, 'project_stage');


    echo "</div>";
    ?>

</div>

<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-6 ">
        <div class="col-md-4 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->

            <a class='btn btn-warning btn-block' href="<?php echo Yii::app()->request->urlReferrer; ?>" style="text-decoration: none;">
                <?php
                //echo CHtml::tag('button', array('class' => 'btn btn-warning btn-block'), '<i class="icon-arrow-right"></i> رجوع');
                ?>
                <i class="icon-arrow-right"></i> رجوع
            </a>


        </div>

        <div class="col-md-4 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <?php
           // echo $school->school_name;
            echo CHtml::resetButton('مسح الكل', array('class' => 'btn btn-danger btn-block'), '<i class="icon-cut"></i> مسح الكل');
            ?>
        </div>

        <div class="col-md-4 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Submit', array('class' => 'btn purple btn-block')); ?>
            <br>
        </div>

        <p class="note">جميع الخانات التي بجانبها <span class="required">*</span> ضرورية لإكمال عملية التسجيل.</p>
        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> حجز مشروع جديد
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>

                </div>


            </div>
            <div class="portlet-body form">

                <div class="form-body">
                    <div class="form-group">

                        <?php echo $form->labelEx($model, 'project_name'); ?>
                        <?php echo $form->textField($model, 'project_name', array('class' => 'form-control', 'placeholder' => 'إسم المشروع بالعربي', 'size' => 60, 'maxlength' => 250)); ?>

                    </div>
                    
                    <div class="form-group">

                        <?php echo $form->labelEx($model, 'project_name_en'); ?>
                        <?php echo $form->textField($model, 'project_name_en', array('class' => 'form-control', 'placeholder' => 'إسم المشروع بالأجنبي', 'size' => 60, 'maxlength' => 250)); ?>

                    </div>

                    <div class="form-group">
                        <?php
                        echo $form->labelEx($model, 'project_type');
                        $records =Mobarat::getCodeEnable(111);// cls_codes::getCodes_ByCodeKind(111);
                        $list = CHtml::listData($records, 'code_no', 'code_name');
                        echo $form->dropDownList($model, 'project_type', $list, array('empty' => 'اختر الفئة', 'class' => 'form-control'));
                        ?>
                    </div>
                    <?php
			                   // $n = new Functions();
			                    //$school = MbSchool::model()->findAll('school_id=' . $n->getSchoolId());
                        
                        if ($school->school_level == '03') 
                            $filter="(code_no='01' or code_no='02')";
                        else
                            $filter="code_no='".$school->school_level."'";
                        //$records=cls_codes::getChildCodes_ByCodeKind(106,$filter,2);
                        $records=cls_codes::getCodes_ByCodeKindQuery(106,$filter);
                        $list = CHtml::listData($records, 'code_no', 'code_name');
                    ?>
					<div class="form-group" >
                           <?php
                             echo $form->labelEx($model, 'project_stage');
                              echo $form->dropDownList($model, 'project_stage', $list, array('empty' => 'اختر المرحلة', 'class' => 'form-control'));
                            ?>
                    </div>	

                    <div class="col-md-4 ">
                        <!-- BEGIN SAMPLE FORM PORTLET-->

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<?php $this->endWidget(); ?>



