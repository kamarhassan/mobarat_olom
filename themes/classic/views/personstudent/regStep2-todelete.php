
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mb-school-form3453',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => true,
        ));
?>

<?php //$records = MbSchool::model()->findAll('school_flag=2 AND school_name!="" AND school_user!=""');
       // $records = School::model()->findAll('1=1');
?>


<div class="col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption"><i class="icon-bar-chart"></i>إختيار طالب مشارك سابقا </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="note note-success">
                <p>
                   شروط البحث

                </p>
            </div>
            <div class="portlet-body" style="min-height: 100px;" id="portlet-info">

                <div id='k'>
                    <table>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('الاسم',FALSE); ?>
                        </td>
                        <td width="150" >
                             <?php echo CHtml::textField('txtFname','',array('id'=>'txtFname','class' => 'form-control ')); ?>
                        </td>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('الشهرة',FALSE); ?>
                        </td>
                        <td width="150" >
                             <?php echo CHtml::textField('txtLname','',array('id'=>'txtLname','class' => 'form-control ')); ?>
                        </td>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('المدرسة',FALSE); ?>
                        </td>
                        <td width="150">
                             <?php echo CHtml::textField('txtSchool','',array('id'=>'txtSchool','class' => 'form-control ')); ?>
                        </td>
                        
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('السنة',FALSE); ?>
                        </td>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::textField('txtYear','',array('id'=>'txtYear','class' => 'form-control ')); ?>
                        </td>
                        <td width="20"></td>
                         <td width="35">
                             <?php echo CHtml::button('search', array('class' => 'form-control', 'width' => 110,'Empty'=>'',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createAbsoluteUrl('Personstudent/OldStudent'),
                            'data'=>array('prjid'=>$prjid
                                    ,'fname'=>"js:document.getElementById('txtFname').value "
                                    ,'lname'=>"js:document.getElementById('txtLname').value "
                                    ,'school'=>"js:document.getElementById('txtSchool').value "
                                    ,'myear'=>"js:document.getElementById('txtYear').value "
                                    ),
                            'cache'=>FALSE,
                            //'update' => '#level2',
                            'success'=>'function(data) {$("#fill_table").html(data);}',
                        ))); 
                    ?>
                        </td>
                   
                   
                    </table>
                </div>
                <div class="table-scrollable" id="fill_table">
                </div>
            </div>
        </div>
        <p>
        الرجاء إختيار طالب مشارك سابق، في حال تعديل البريد الالكتروني يرجى مراجعة الادارة
        </p>
    </div>
</div>





<?php $this->endWidget(); ?>
