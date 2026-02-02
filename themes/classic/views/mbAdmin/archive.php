
<?php
$c = '';
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mb-school-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<?php
echo $form->errorSummary($model, $schoolManager, $officialTeacher);
?>
<form role="form">
    <div class="row">
        <div class="col-md-3 "></div>
        <div class="col-md-6 ">
            <div class="col-md-4 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->


                <a href="<?php echo Yii::app()->request->urlReferrer; ?>" style="text-decoration: none;">
                    <?php
                    echo CHtml::tag('button', array('class' => 'btn btn-warning btn-block'), '<i class="icon-arrow-right"></i> رجوع');
                    ?>
                </a>

            </div>

            <div class="col-md-4 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <?php
                echo CHtml::tag('button', array('class' => 'btn btn-danger btn-block'), '<i class="icon-cut"></i> مسح الكل');
                ?>
            </div>

            <div class="col-md-4 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <!--<?php echo CHtml::submitButton($model->isNewRecord ? 'حفظ البيانات' : 'Save', array('class' => 'btn purple btn-block', 'url' => ('MbSchool/completeReg'))); ?>-->
				<?php echo CHtml::submitButton($model->isNewRecord ? 'حفظ البيانات' : 'Save', array('class' => 'btn purple btn-block')); ?>
                <br>
            </div>

            <p class="note">جميع الخانات التي بجانبها <span class="required">*</span> ضرورية لإكمال عملية التسجيل.</p>
            <div class="portlet box blue">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-reorder"></i> معلومات المدرسة
                    </div>
                    <div class="tools">
                        <a href="#" class="collapse"></a>

                    </div>


                </div>
                <div class="portlet-body form">

                    <div class="form-body">
                        <div class="form-group">
                            2012 = 12 , 2010 = 10 , 2008 = 08......
                            <?php echo $form->labelEx($model, 'school_year'); ?>
                            <?php echo $form->numberField($model, 'school_year', array('class' => 'form-control', 'placeholder' => 'السنة', 'size' => 60, 'maxlength' => 250,)); ?>

                        </div>
                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'school_name'); ?>
                            <?php echo $form->textField($model, 'school_name', array('class' => 'form-control', 'placeholder' => 'إسم المدرسة', 'size' => 60, 'maxlength' => 250,)); ?>

                        </div>

                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'school_ename'); ?>
                            <?php echo $form->textField($model, 'school_ename', array('class' => 'form-control', 'placeholder' => 'School Name', 'size' => 60, 'maxlength' => 100)); ?>

                        </div>


                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'mouha_id'); ?>
                            <?php
                            $records = MbMouhafaza::model()->findAll();
                            $list = CHtml::listData($records, 'mouhafaza_id', 'mouhafaza_name');
							/*
                            echo CHtml::dropDownList('mohafaza', null, $list, array('empty' => 'اختر محافظة', 'class' => 'form-control',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('MbKadaa/kadaaByMohafaza'),
                                    'update' => '#kadaa'
                                ))
                            );*/
                            echo $form->dropDownList($model, 'mouha_id', $list, array('class' => 'list', 'empty' => 'اختر محافظة', 'width' => 110,'class' => 'form-control',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('MbKadaa/kadaaByMohafaza'),
                                    'update' => '#kadaa'
                                ))
                            );
                            ?>

                        </div>


                        <div class="form-group" >
                        	<!--
                            <?php echo $form->labelEx($model, 'school_kadda'); ?>

                            <?php
                            echo $form->dropDownList($model, 'school_kadda', array(), array('empty' => 'قضاء', 'class' => 'form-control', 'id' => 'kadaa'))
                            ?>
                           -->
                          <!-- <?php if ($model->isNewRecord) { ?>-->

                                <?php echo $form->labelEx($model, 'school_kadda'); ?>

                                <?php
                                if (isset($_POST['MbSchool']['mouha_id']) && $_POST['MbSchool']['mouha_id'] != '') {
//                                    die('hh:' . $_POST['MbSchool']['mouha_id']);
                                    $data = MbKadaa::model()->findAll('kadaa_mouhafaza =' . $_POST['MbSchool']['mouha_id']);
                                    $data = CHtml::listData($data, 'kadaa_id', 'kadaa_name');
//                                    foreach ($data as $value => $name) {
//                                        echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
//                                    }
                                    echo $form->dropDownList($model, 'school_kadda', $data, array( 'empty' => 'قضاء', 'width' => 150, 'id' => 'kadaa','class' => 'form-control',));
//                                    die($_POST['MbSchool']['school_kadda']);
                                } else {
                                    echo $form->dropDownList($model, 'school_kadda', array(), array( 'empty' => 'قضاء', 'width' => 150, 'id' => 'kadaa','class' => 'form-control',));
                                }
                                ?>

                                <?php
                            } else {

                                $kad = MbKadaa::model()->findByAttributes(array('kadaa_id' => $model->school_kadda));
                                $kada = MbKadaa::model()->findAll('kadaa_mouhafaza=' . $kad->kadaa_mouhafaza);
                                $data = CHtml::listData($kada, 'kadaa_id', 'kadaa_name');
                                ?>

                                <?php echo $form->labelEx($model, 'school_kadda'); ?>
                                <?php
                                echo $form->dropDownList($model, 'school_kadda', $data, array('class' => 'form-control', 'empty' => 'قضاء', 'width' => 150, 'id' => 'kadaa'));
                                ?>

                            <?php } ?>
                            
                        </div>



                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'school_city'); ?>

                            <!-- <?php echo $form->textField($model, 'school_city', array('class' => 'form-control', 'placeholder' => 'المدينة', 'size' => 50, 'maxlength' => 50)); ?> -->
                            
                            <?php
                            $recordsManucipality = Manucipality::model()->findAll();
                            $listManucipality = CHtml::listData($recordsManucipality, 'id', 'name');
							
                            echo $form->dropDownList($model, 'school_city', $listManucipality, array('class' => '$listManucipality', 'empty' => 'اختر النطاق البلدي', 'width' => 110,'class' => 'form-control' ));
                            ?>

                        </div>


                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'school_street'); ?>
                            <?php echo $form->textField($model, 'school_street', array('class' => 'form-control', 'placeholder' => 'الشارع', 'size' => 50, 'maxlength' => 50)); ?>
                        </div>




                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'school_phone'); ?>
                            <?php echo $form->textField($model, 'school_phone', array('class' => 'form-control', 'placeholder' => 'الهاتف', 'size' => 50, 'maxlength' => 50)); ?>
                        </div>

                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'school_extraphone'); ?>
                            <?php echo $form->textField($model, 'school_extraphone', array('class' => 'form-control', 'placeholder' => 'هاتف آخر', 'size' => 50, 'maxlength' => 50)); ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">فاكس</label>
                            <?php echo $form->labelEx($model, 'school_fax'); ?>
                            <?php echo $form->textField($model, 'school_fax', array('class' => 'form-control', 'placeholder' => 'فاكس', 'size' => 50, 'maxlength' => 50)); ?>
                        </div>

                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'school_pobox'); ?>
                            <?php echo $form->textField($model, 'school_pobox', array('class' => 'form-control', 'placeholder' => 'صندوق بريد', 'size' => 50, 'maxlength' => 50)); ?>
                        </div>

                        <div class="col-md-4 ">
                            <!-- BEGIN SAMPLE FORM PORTLET-->

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-3 "></div>
        <div class="col-md-6 ">

            <div class="portlet box green">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-reorder"></i> معلومات المدير
                    </div>
                    <div class="tools">
                        <a href="#" class="collapse"></a>

                    </div>

                </div>
                <div class="portlet-body form">

                    <div class="form-body">
                        <?php if ($form->error($schoolManager, 'smanager_fname')) $c = "has-error"; ?>
                        <div class="form-group <?php echo $c; ?>">
                            <?php echo $form->labelEx($schoolManager, 'smanager_fname'); ?>
                            <div class="input-group">

                                <?php if ($form->error($schoolManager, 'smanager_fname')) echo "<span class='input-group-addon'><i class='icon-exclamation' data-original-title='please write a valid email' data-container='body'></i></span>"; ?>
                                <?php echo $form->textField($schoolManager, 'smanager_fname', array('class' => 'form-control', 'placeholder' => 'الإسم', 'size' => 60, 'maxlength' => 100)); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($schoolManager, 'smanager_lname'); ?>
                            <?php echo $form->textField($schoolManager, 'smanager_lname', array('class' => 'form-control', 'placeholder' => 'العائلة', 'size' => 60, 'maxlength' => 100)); ?>

                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($schoolManager, 'smanager_ename'); ?>

                            <?php echo $form->textField($schoolManager, 'smanager_ename', array('class' => 'form-control', 'placeholder' => 'Full Name', 'size' => 60, 'maxlength' => 100)); ?>

                        </div>




                        <div class="form-group">
                            <?php echo $form->labelEx($schoolManager, 'smanager_sex'); ?>
                            <div class="radio-list">
                                <?php echo CHtml::activeRadioButton($schoolManager, 'smanager_sex', array('value' => 'ذكر', 'uncheckValue' => null)); ?>ذكر
                                <?php echo CHtml::activeRadioButton($schoolManager, 'smanager_sex', array('value' => 'أنثى', 'uncheckValue' => null)); ?>أنثى

                            </div>                        </div>

                        <div class="form-group">						<div>
                                <?php echo $form->labelEx($schoolManager, 'smanager_email'); ?>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-envelope"></i></span>
                                    <?php echo $form->textField($schoolManager, 'smanager_email', array('class' => 'form-control', 'placeholder' => 'البريد الإلكتروني', 'size' => 50, 'maxlength' => 50)); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($schoolManager, 'smanager_phone'); ?>
                            <?php echo $form->textField($schoolManager, 'smanager_phone', array('class' => 'form-control', 'placeholder' => 'الهاتف', 'size' => 50, 'maxlength' => 50)); ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 "></div>
        <div class="col-md-6 ">

            <div class="portlet box yellow">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-reorder"></i> معلومات الأستاذ المشرف
                    </div>
                    <div class="tools">
                        <a href="#" class="collapse"></a>

                    </div>

                </div>
                <div class="portlet-body form">

                    <div class="form-body">
                        <div class="form-group">
                            <?php echo $form->labelEx($officialTeacher, 'oteacher_fname'); ?>

                            <?php echo $form->textField($officialTeacher, 'oteacher_fname', array('class' => 'form-control', 'placeholder' => 'الإسم', 'size' => 60, 'maxlength' => 100)); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($officialTeacher, 'oteacher_lname'); ?>

                            <?php echo $form->textField($officialTeacher, 'oteacher_lname', array('class' => 'form-control', 'placeholder' => 'العائلة', 'size' => 60, 'maxlength' => 100)); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($officialTeacher, 'oteacher_ename'); ?>
                            <?php echo $form->textField($officialTeacher, 'oteacher_ename', array('class' => 'form-control', 'placeholder' => 'Full Name', 'size' => 60, 'maxlength' => 100)); ?>
                        </div>




                        <div class="form-group">
                            <?php echo $form->labelEx($officialTeacher, 'oteacher_sex'); ?>
                            <div class="radio-list">
                                <?php echo CHtml::activeRadioButton($officialTeacher, 'oteacher_sex', array('value' => 'ذكر', 'uncheckValue' => null)); ?>ذكر
                                <?php echo CHtml::activeRadioButton($officialTeacher, 'oteacher_sex', array('value' => 'أنثى', 'uncheckValue' => null)); ?>أنثى

                            </div>                        </div>

                        <div class="form-group">						<div>
                                <?php echo $form->labelEx($officialTeacher, 'oteacher_email'); ?>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon-envelope"></i></span>
                                    <?php echo $form->textField($officialTeacher, 'oteacher_email', array('class' => 'form-control', 'placeholder' => 'البريد الإلكتروني', 'size' => 50, 'maxlength' => 50)); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($officialTeacher, 'oteacher_mobile'); ?>

                            <?php echo $form->textField($officialTeacher, 'oteacher_mobile', array('class' => 'form-control', 'placeholder' => 'الهاتف', 'size' => 50, 'maxlength' => 50)); ?>
                        </div>

                        <div class="form-group">

                            <?php echo $form->labelEx($officialTeacher, 'oteacher_description'); ?>
                            <?php echo $form->textField($officialTeacher, 'oteacher_description', array('class' => 'form-control', 'placeholder' => 'الوصف', 'size' => 50, 'maxlength' => 50)); ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


</form>

<?php $this->endWidget(); ?>

