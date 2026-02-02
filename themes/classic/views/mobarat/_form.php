<?php
/* @var $this MbInfoAdminController */
/* @var $model MbInfoAdmin */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mb-info-admin-form',
        'enableAjaxValidation' => true,
    ));
    ?>

    <!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-md-4 ">
            <a class='btn btn-warning btn-block' href="<?php echo Yii::app()->request->urlReferrer; ?>" style="text-decoration: none;">
                      <i class="icon-arrow-right"></i> رجوع
            </a>
        </div>
        <div class="col-md-4 ">
            <?php echo CHtml::submitButton( 'حفظ', array('class' => 'btn purple btn-block')); ?>
            <br>
        </div>
        </div>
<div >
        <table>
            <tr>
                <!--
                <td width="200">
                    <?php //echo $form->labelEx($model, 'openForRegistration'); 
                    ?>
                </td>
                <td width="100">
                    <?php //echo $form->checkbox($model, 'openForRegistration', array('class' => 'form-control')); 
                    ?>
                </td>-->
                 
                <td width="200">
                    <?php echo $form->labelEx($model, 'phone_trouble'); ?>
                </td>
                <td width="100">
                    <?php echo $form->textField($model, 'phone_trouble', array('class' => 'form-control', )); ?>
                </td>
               <td>
                   
                </td>
                <td>
                   
                </td>
            </tr>
             <tr>
                <td>
                    <?php echo $form->labelEx($model, 'maxNoOfSchool'); ?>
                </td>
                <td>
                     <?php echo $form->textField($model, 'maxNoOfSchool', array('class' => 'form-control', )); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model, 'MaxNoOfProject'); ?>
                </td>
                <td>
                     <?php echo $form->textField($model, 'MaxNoOfProject', array('class' => 'form-control', )); ?>
                </td>
                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model, 'TeacherNbForProject'); ?>
                </td>
                <td>
                    <?php echo $form->textField($model, 'TeacherNbForProject', array('class' => 'form-control', )); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model, 'StudentNbForProject'); ?>
                </td>
                <td>
                     <?php echo $form->textField($model, 'StudentNbForProject', array('class' => 'form-control', )); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model, 'last_register_school'); ?>
                </td>
                <td>
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'one',
                            'model' => $model,
                            'attribute' => 'last_register_school',
                            //'flat' => true, //remove to hide the datepicker
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions' => array(
                                'class' => 'form-control',
                            ),
                        ));
                    ?>
                     <?php echo $form->error($model, 'last_register_school'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model, 'last_register_project'); ?>
                </td>
                <td>
                    
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'twoo',
                            'model' => $model,
                            'attribute' => 'last_register_project',
                            //'flat' => true, //remove to hide the datepicker
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions' => array(
                               'class' => 'form-control',
                            ),
                        ));
                    ?>
                    <?php echo $form->error($model, 'last_register_project'); ?>
                </td>
            </tr>
           <tr>
                <td>
                    <?php echo $form->labelEx($model, 'last_register_teacher_student'); ?>
                
                </td>
                <td>
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'three',
                            'model' => $model,
                            'attribute' => 'last_register_teacher_student',
                            //'flat' => true, //remove to hide the datepicker
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions' => array(
                               'class' => 'form-control',
                            ),
                        ));
                    ?>
                    <?php echo $form->error($model, 'last_register_teacher_student'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model, 'last_update'); ?>
                </td>
                <td>
                    
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'four',
                            'model' => $model,
                            'attribute' => 'last_update',
                           // 'flat' => true, //remove to hide the datepicker
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions' => array(
                                'class' => 'form-control',
                            ),
                        ));
                    ?>
                    <?php echo $form->error($model, 'last_update'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model, 'last_update_judge'); ?>
                
                </td>
                <td>
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'five',
                            'model' => $model,
                            'attribute' => 'last_update_judge',
                            'flat' => false, //remove to hide the datepicker
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions' => array(
                               'class' => 'form-control',
                            ),
                        ));
                    ?>
                    <?php echo $form->error($model, 'last_update_judge'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model, 'ceremonyDay'); ?>
                
                </td>
                <td>
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'ceremonyDay',
                            'model' => $model,
                            'attribute' => 'ceremonyDay',
                            'flat' => false, //remove to hide the datepicker
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions' => array(
                               'class' => 'form-control',
                            ),
                        ));
                    ?>
                    <?php echo $form->error($model, 'ceremonyDay'); ?>
                </td>
                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model, 'firstDayJudge'); ?>
                
                </td>
                <td>
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'firstDayJudge',
                            'model' => $model,
                            'attribute' => 'firstDayJudge',
                            //'flat' => true, //remove to hide the datepicker
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions' => array(
                               'class' => 'form-control',
                            ),
                        ));
                    ?>
                    <?php echo $form->error($model, 'firstDayJudge'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model, 'secondDayJudge'); ?>
                </td>
                <td>
                    
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'secondDayJudge',
                            'model' => $model,
                            'attribute' => 'secondDayJudge',
                           // 'flat' => true, //remove to hide the datepicker
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions' => array(
                                'class' => 'form-control',
                            ),
                        ));
                    ?>
                    <?php echo $form->error($model, 'secondDayJudge'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model, 'morningFrom'); ?>
                </td>
                <td>
                     <?php echo $form->textField($model, 'morningFrom', array('class' => 'form-control', )); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model, 'morningTo'); ?>
                </td>
                <td>
                     <?php echo $form->textField($model, 'morningTo', array('class' => 'form-control', )); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model, 'eveningFrom'); ?>
                </td>
                <td>
                     <?php echo $form->textField($model, 'eveningFrom', array('class' => 'form-control', )); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model, 'eveningTo'); ?>
                </td>
                <td>
                     <?php echo $form->textField($model, 'eveningTo', array('class' => 'form-control', )); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model, 'ceremonyFrom'); ?>
                </td>
                <td>
                     <?php echo $form->textField($model, 'ceremonyFrom', array('class' => 'form-control', )); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model, 'ceremonyTo'); ?>
                </td>
                <td>
                     <?php echo $form->textField($model, 'ceremonyTo', array('class' => 'form-control', )); ?>
                </td>
            </tr>
             <tr>
                <td>
                    <?php echo $form->labelEx($model, 'judgeprojectcount'); ?>
                </td>
                <td>
                     <?php echo $form->textField($model, 'judgeprojectcount', array('class' => 'form-control', )); ?>
                </td>
               
            </tr>
            <tr>
                <td colspan="4"><h4> <b> إمكانية تعديل البيانات الشخصية، تسجيل مشروع، أستاذ مشرف وطالب ضمن: </b></h4></td>
            </tr>
                        <tr>
                <td>
                    <?php echo $form->labelEx($model, 'openforupdate_fromdate'); ?>
                
                </td>
                <td>
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'openforupdate_fromdate',
                            'model' => $model,
                            'attribute' => 'openforupdate_fromdate',
                            //'flat' => true, //remove to hide the datepicker
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions' => array(
                               'class' => 'form-control',
                            ),
                        ));
                    ?>
                    <?php echo $form->error($model, 'openforupdate_fromdate'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model, 'openforupdate_todate'); ?>
                </td>
                <td>
                    
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'openforupdate_todate',
                            'model' => $model,
                            'attribute' => 'openforupdate_todate',
                           // 'flat' => true, //remove to hide the datepicker
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            ),
                            'htmlOptions' => array(
                                'class' => 'form-control',
                            ),
                        ));
                    ?>
                    <?php echo $form->error($model, 'openforupdate_todate'); ?>
                </td>
            </tr>
        </table>
    


<div></div>
<br><br>

<div class = "row"> 
    
    <div class="col-md-3">
        <div class="portlet-body" >
            <div class="note note-success">
                <p> المشاريع المتاحة</p>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <?php
                    //$halls_codes
                    foreach ($prj_codes as $prj) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                if ($prj['code_name'] != NULL)
                                    echo $prj['code_name'] ;
                                else
                                    echo "...";
                                ?>
                            </td>
                            <td >
                                <?php
                                    if ($prj['code_Enable'] == 1) {
                                        $cl = "green";
                                        $clt = "نعم";
                                        $path = "Mobarat/CodeEnable";
                                    } else {
                                        $cl = "red";
                                        $clt = "كلا";
                                        $path = "Mobarat/CodeEnable";
                                    }
                                ?>
                                <div <?php echo "id=\"sp". $prj['id'] ."\"" ?>>
                                <?php echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                , array('update' => '#sp'.$prj['id'], 'data' => array('code_id' => $prj['id'],'code_enable'=>$prj['code_Enable'])
                                                    )); ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
     <div class="col-md-3">
        <div class="portlet-body" >
            <div class="note note-success">
                <p> القاعات المتاحة
                    <a class="more" href="<?php echo $this->createAbsoluteUrl('Mobarat/Mobarathallsupdate/'.$model['mobarat_year']); ?>">
                تحديد الاجنحة <i class="m-icon-swapleft m-icon-white"></i>
            </a>
                </p>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <?php
                    //$halls_codes
                    foreach ($halls_codes as $prj) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                if ($prj['code_name'] != NULL)
                                    echo $prj['code_name'] ;
                                else
                                    echo "...";
                                ?>
                            </td>
                            <td >
                                <?php
                                    if ($prj['code_Enable'] == 1) {
                                        $cl = "green";
                                        $clt = "نعم";
                                        $path = "Mobarat/CodeEnable";
                                    } else {
                                        $cl = "red";
                                        $clt = "كلا";
                                        $path = "Mobarat/CodeEnable";
                                    }
                                ?>
                                <div <?php echo "id=\"sp". $prj['id'] ."\"" ?>>
                                <?php echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                , array('update' => '#sp'.$prj['id'], 'data' => array('code_id' => $prj['id'],'code_enable'=>$prj['code_Enable'])
                                                    )); ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <?php $this->endWidget(); ?>

</div><!-- form -->