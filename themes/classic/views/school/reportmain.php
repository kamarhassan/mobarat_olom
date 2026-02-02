
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
            <div class="caption"><i class="icon-bar-chart"></i>تقرير المدارس المشاركة سابقاً </div>
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
                        <tr>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('السنة',FALSE); ?>
                        </td>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::textField('txtYear','',array('id'=>'txtYear','class' => 'form-control ')); ?>
                        </td>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('المدرسة',FALSE); ?>
                        </td>
                        <td width="150">
                             <?php echo CHtml::textField('txtSchool','',array('id'=>'txtSchool','class' => 'form-control ')); ?>
                        </td>
                         <td width="75" style="text-align:center">
                             <?php echo CHtml::label('الاستاذ المسؤول',FALSE); ?>
                        </td>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('الإسم',FALSE); ?>
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
                                  
                        
                        
                        <td width="20"></td>
                         <td width="35">
                             <?php echo CHtml::button('search', array('class' => 'form-control', 'width' => 110,'Empty'=>'',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createAbsoluteUrl('School/reportbody'),
                            'data'=>array('fname'=>"js:document.getElementById('txtFname').value "
                                    ,'lname'=>"js:document.getElementById('txtLname').value "
                                    ,'school'=>"js:document.getElementById('txtSchool').value "
                                    ,'myear'=>"js:document.getElementById('txtYear').value "
                                    ,'showall'=>"js:document.getElementById('chShowAll').checked "
                                    ),
                            'cache'=>FALSE,
                            //'update' => '#level2',
                            'success'=>'function(data) {$("#fill_table").html(data);}',
                        ))); 
                    ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('إظهار الكل',FALSE); ?>
                        </td>
                        <td width="25" >
                             <?php echo CHtml::checkBox('chShowAll',false,array('id'=>'chShowAll','class' => 'form-control ')); ?>
                        </td>
                    </tr>
                   
                   
                    </table>
                </div>
                <div class="table-scrollable" id="fill_table">
                </div>
            </div>
        </div>
    </div>
</div>





<?php $this->endWidget(); ?>
