<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
  <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'MobaratSchool',
            'enableAjaxValidation' => false,
            'method'=>'post'
        ));
        


        ?>

<div class="row">

    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-bar-chart"></i>  تحديد اليوم، القاعة والجناح للمدرسة</div>
                
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
           
            <div class="portlet-body">
               <div class="caption">
                   <h3><?php if(strlen($msg)>0) echo $msg; ?> </h3>
            </div>
                 <div class="margin-top-10">
                    <button name="subject" type="submit" value="save" class="btn blue">حفظ</button>
                    <button name="subject" type="submit" value="relateall" id="relateall" class="btn blue" >ربط جميع المدارس بالقاعات</button>
                    <button name="subject" type="submit" value="relateremain" class="btn blue">ربط المدارس الباقية بالقاعات</button>
                    <button name="subject" type="submit" value="submit" class="btn blue">موافق</button>
                    <button name="subject" type="submit" value="sendmailall" class="btn blue">إرسال بريد للكل</button>
                    <?php
                  /* echo CHtml::ajaxButton('Send Mail'
                                                , array('Admin/sendAllOteacherSuite' ), array(
                                                   //'update' => '#modalBody',
                                                   // 'complete' => 'function() {$("#basic").modal();}',
                                                     'success'=>'function(data) {'
                                                        . 'if(data==-1){alert("حصل خطأ أثناء إرسال البريد!");}'
                                                        . 'else {$("#Result_SendInvite").html($("#Result_SendInvite").text() + data);}}'
                                                    ,//'data' => array('id' => $this->mobarat_schoolID)
                                                    ),
                                                    array('id' =>'sendInformationAll','confirm' => 'هل أنت متأكد من إرسال بريد للجميع? المعلومات يجب أن يتم حفظها','class'=>"btn blue")
                    );*/
                     echo CHtml::ajaxSubmitButton('Send Mail'
                                                , array('Admin/sendAllOteacherSuite' ), array(
                                                    'type'=>'POST',
                                                   /*'update' => '#modalBody',
                                                    'complete' => 'function() {$("#basic").modal();}',*/
                                                     'success'=>'function(data) {'
                                                        . 'if(data==-1){alert("حصل خطأ أثناء إرسال البريد!");}'
                                                        . 'else {$("#Result_SendInvite").html($("#Result_SendInvite").text() + data);}}'
                                                    ,//'data' => array('id' => $this->mobarat_schoolID)
                                                    ),
                                                    array('id' =>'sendInformationAll','confirm' => 'هل أنت متأكد من إرسال بريد للجميع? المعلومات يجب أن يتم حفظها','class'=>"btn blue")
                    );
                    
                    ?>
                   
                </div>
                <div class="table-scrollable">
                    <?php
                        $this->widget('zii.widgets.grid.CGridView',array(
                            'id'=>'gridSchool',
                            'dataProvider'=>$data,
                            'ajaxUpdate'=>true,
                            'filter'=>$model,
                            'summaryText'=>'{start}-{end}/{count}',
                            'columns'=>array(
                                array('header'=>'الرقم','name'=>'school.school_id',
                                     'filter'=>CHtml::submitButton('بحث', array('class' => 'btn green icon-search','name'=>'subject','value'=>'search'), '<i class="icon-search></i> ')),//'value'=>$data['olumn_name'] in case we want something custom
                                array('header'=>'الإسم','name'=>'schoolName'),
                                array('header'=>'المرحلة','name'=>'school.school_level','value'=>'$data->getSchoolLevelName($data->school->school_level)'),
                                 array('header'=>'عدد المشاريع'
                                            
                                            ,'value'=>'$data->getCountRegisterProject()',//'class'=>'CCheckBoxColumn',
                                            ),
                                array('header'=>'الفئة','value'=>'$data->getRegisterProjectType()',
                                   // 'htmlOptions'=>array('width'=>'100'),
                                    'type'=>'ntext',
                                    'filter'=>Chtml::dropDownList('MobaratSchool[ProjectType]', $model->ProjectType,  CHtml::listData(Mobarat::getCodeEnable(111), 'code_no', 'code_name'), array('empty' => 'اختر الفئة', 'class' => 'form-control'))),
//                                array('header'=>'الفئة'
//                                            
//                                            ,'value'=>'$data->getRegisterProjectType()',//'class'=>'CCheckBoxColumn',
//                                            ),
                               // array('header'=>'الشارع','name'=>'school.school_street'),
                                //array('header'=>'الهاتف','name'=>'school.school_phone'),oteacherPerson
                                array('header'=>'الاستاذ المسؤول','name'=>'OteacherName','filter'=>''),
                                array('header'=>'الهاتف','name'=>'oteacherPerson.Person_CellPhone','filter'=>''),
                                array('name'=>'presence_assurance','type'=>'raw'//,'filter'=>Chtml::checkBox('MobaratSchool[presence_assurance]', $model->presence_assurance)
                                            ,'filter'=>Chtml::dropDownList('MobaratSchool[presence_assurance]', $model->presence_assurance,  CHtml::listData(array(array('code_no'=>1,'code_name'=>'المؤكدة'),array('code_no'=>0,'code_name'=>'غير مؤكدة')), 'code_no', 'code_name')
                                            , array('empty' => 'اختر ', 'class' => 'form-control'))
                                            ,'value'=>'$data->getCheckBox("presence_assurance")',//'class'=>'CCheckBoxColumn',
                                            ),
                                array('name'=>'is_present','type'=>'raw'
                                            ,'filter'=>Chtml::dropDownList('MobaratSchool[is_present]', $model->is_present,  CHtml::listData(array(array('code_no'=>1,'code_name'=>'حاضرة'),array('code_no'=>0,'code_name'=>'غير حاضرة')), 'code_no', 'code_name')
                                            , array('empty' => 'اختر ', 'class' => 'form-control'))
                                            ,'value'=>'$data->getCheckBox("is_present")',//'class'=>'CCheckBoxColumn',
                                            ),
                                array('name'=>'date_day','type'=>'raw','value'=>'$data->getComboFieldDay("date_day")',
                                    'filter'=>Chtml::dropDownList('MobaratSchool[date_day]', $model->date_day,  CHtml::listData(Mobarat::getCodeEnable2(118,2), 'code_no', 'code_name')
                                            , array('empty' => 'اختر اليوم', 'class' => 'form-control'))),
                                array('name'=>'halls','type'=>'raw','value'=>'$data->getComboFieldHalls("halls")',
                                    'filter'=>Chtml::dropDownList('MobaratSchool[halls]', $model->halls,  CHtml::listData(Mobarat::getCodeEnable(120), 'code_no', 'code_name'), array('empty' => 'اختر القاعة', 'class' => 'form-control'))),
                                array('name'=>'suite','type'=>'raw','value'=>'$data->getInputField("suite")','filter'=>''),
                                array('name'=>'Mail','type'=>'raw','value'=>'$data->getMail()',
                                    'filter'=>''),
                                //array('class'=>'CButtonColumn')
                            )
                        ))
                    // $records =Mobarat::getCodeEnable(120);// cls_codes::getCodes_ByCodeKind(111);
           // $list = CHtml::listData(Mobarat::getCodeEnable(120), 'code_no', 'code_name');
            //return @CActiveForm::dropDownList($this, $fieldName, $list, array('empty' => 'اختر القاعة', 'class' => 'form-control',"name"=>"MobaratSchool[".$this->mobarat_schoolID."][".$fieldName."]"));      
                   
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="table-scrollable" id="Result_SendInvite">
            
        </div>
      <?php $this->endWidget(); 
      ?>
    <script>
        document.getElementById("relateall").addEventListener("click",function(evt){
            if(!confirm('هل أنت متأكد من توزيع جميع المدارس على الاجنحة؟')){
                evt.preventDefault();
            }
        })
    </script>
    
     