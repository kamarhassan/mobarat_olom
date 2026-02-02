<?php
$baseUrl = Yii::app()->theme->baseUrl;

?>

<h3 class="page-title">
    صفحة إدارة لسنة <?php
    $clsPerson=Yii::app()->session['clsPerson'] ;
    echo $mobarat['mobarat_year'];

    ?>
</h3>

<div class="row">
    
        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <!--<h4 class="modal-title">إحصائيات المشاريع</h4>-->
                </div>
                <div class="modal-body" id="modalBody">

                </div>
                <!--                              <div class="modal-footer">
                                                 <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                 <button type="button" class="btn blue">Save changes</button>
                                              </div>-->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class=" icon-warning-sign"></i>
            </div>
            <div class="details">
                <div class="number">
                    تأكيد تسجيل
                </div>
                <div class="desc">
                    المدارس
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Admin/PendingSchool'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-2">
        <div class="dashboard-stat red">
            <div class="visual">
                <i class=" icon-warning-sign"></i>
            </div>
            <div class="details">
                <div class="number">
                    المدارس
                </div>
                <div class="desc">
                    المنتظرة
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Admin/Waitingconfirmcodeschool'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
   
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-bar-chart"></i>
            </div>
            <div class="details">
                <div class="number">المدارس</div>
                <div class="desc"> المؤكدة</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('School/reportacceptedschoolmain'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="icon-tasks"></i>
            </div>
            <div class="details">
                <div class="number">المشاريع</div>
                <div class="desc">المسجلة</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/listprojects'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class=" icon-user"></i>
            </div>
            <div class="details">
                <div class="number">
                    تقرير
                </div>
                <div class="desc">
                    الأعضاء
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('User/reportall'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    

</div>

<div class = "row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="icon-calendar"></i>
            </div>
            <div class="details">
                <div class="number">
                    إعدادات
                </div>
                <div class="desc">
                    عامة
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Admin/config');
                                        //echo $this->createAbsoluteUrl('Admin/PendingSchool');
            
            ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-bar-chart"></i>
            </div>
            <div class="details">
                <div class="number">تقرير المدارس</div>
                <div class="desc"> غير مكتملة البيانات</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('School/reportnotcomplete'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat orange">
            <div class="visual">
                <i class=" icon-bar-chart"></i>
            </div>
            <div class="details">
                <div class="number">
                    تقارير المشاريع
                </div>
                <div class="desc">
                    الغير مكتملة
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/listprojectsnotcomplete'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-bar-chart"></i>
            </div>
            <div class="details">
                <div class="number">تقرير الطلاب</div>
                <div class="desc"> غير مكتملة البيانات</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Personstudent/reportnotcomplete'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
<!--
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="icon-magic"></i>
            </div>
            <div class="details">
                <div class="number"> سنة جديدة</div>
                <div class="desc"><?php echo Mobarat::getMaxYear(); ?></div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('MbAdmin/newYear'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
-->



</div>

<div class="row">
    <div class = "col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class = "dashboard-stat yellow">
            <div class = "visual">
                <i class = "icon-pencil"></i>
            </div>
            <div class = "details">
                <div class = "number">تعديل</div>
                <div class = "desc">البيانات الشخصية</div>
            </div>
            <a class = "more" href = "<?php echo $this->createAbsoluteUrl('Person/Update/'.$clsPerson->person_id); ?>">
                دخول <i class = "m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class = "col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class = "dashboard-stat green">
            <div class = "visual">
                <i class = "icon-certificate"></i>
            </div>
            <div class = "details">
                <div class = "number">تسجيل</div>
                <div class = "desc">مدرسة أرشيف</div>
            </div>
            <a class = "more" href = "<?php echo $this->createAbsoluteUrl('school/createold') ?>">
                دخول <i class = "m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red">
            <div class="visual">
                <i class="icon-trophy"></i>
            </div>
            <div class="details">
                <div class="number">
                    توزيع
                </div>
                <div class="desc">
                    الميداليات
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/trophydistribution'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
   <!-- التحكيم -->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-check"></i>
            </div>
            <div class="details">
                <div class="number">
                    التحكيم
                </div>
                <div class="desc">
                   
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Admin/judge'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
   <!-- التحكيم -->
    
</div>


<div class="row">
    <div class = "col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class = "dashboard-stat orange">
            <div class = "visual">
                <i class = "icon-archive"></i>
            </div>
            <div class = "details">
                <div class = "number">أرشيف</div>
                <div class = "desc">الطلاب </div>
            </div>
            <a class = "more" href = "<?php echo $this->createAbsoluteUrl('Personstudent/reportall') ?>">
                دخول <i class = "m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
        
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat orange">
            <div class="visual">
                <i class=" icon-archive"></i>
            </div>
            <div class="details">
                <div class="number">
                   أرشيف
                </div>
                <div class="desc">
                    المدارس
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('school/reportmain'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="icon-archive"></i>
            </div>
            <div class="details">
                <div class="number">
                    أرشيف
                </div>
                <div class="desc">
                    المشاريع
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/reportmain'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="icon-archive"></i>
            </div>
            <div class="details">
                <div class="number">أرشيف </div>
                <div class="desc">الأساتذة</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Personteacher/reportall'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
</div>


<br><br>
<div class = "row ui-sortable" id = "sortable_portlets">
    <div class = "col-md-5 column sortable">
        <!--BEGIN Portlet PORTLET-->

        <!--END Portlet PORTLET-->
        <!--BEGIN Portlet PORTLET-->
        <div class = " portlet box blue">
            <div class = "portlet-title">
                <div class = "caption"><i class = "icon-reorder"></i>إحصائيات عامة </div>

            </div>
            <div class = "portlet-body">


                <ul class="list-group">

                    <li class="list-group-item">
                        عدد المشاريع المتاحة
                        <span class="badge badge-success">
                            <?php echo $mobarat['MaxNoOfProject']; ?>
                        </span>


                    </li>

                    <li class="list-group-item">
                        عدد المدارس الغير مؤكدة
                        <span class="badge badge-success">
                            <?php echo MobaratSchool::getCoutingPendingSchool($mobarat['mobarat_year']); ?>
                        </span>


                    </li>
                    <li class="list-group-item">
                          <?php
                         //echo time();
                            echo CHtml::ajaxLink('عدد المدارس المؤكدة', array('Statistics/SchoolStat'), array('update' => '#modalBody',
                                            'complete' => 'function() {$("#basic").modal();}'));
                        ?>
                        
                        <span class="badge badge-info">
                            <?php echo MobaratSchool::getCoutingConfirmedSchool($mobarat['mobarat_year']); 
                                    
                            ?>
                        </span>
                    </li>
                    <!--
                    <li class="list-group-item">
                        
                        عدد المدارس المؤكدة  رسمي
                        <span class="badge badge-info">
                            <?php //echo $n->getCoutingConfirmedPublicSchool(); 
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                         عدد المدارس المؤكدة   خاص
                        <span class="badge badge-info">
                            <?php //echo $n->getCoutingConfirmedPrivateSchool(); 
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                         عدد المدارس المؤكدة  الجديدة
                        <span class="badge badge-info">
                            <?php //echo $n->getCoutingConfirmedSchoolNew(); 
                            ?>
                        </span>
                    </li>
                     <li class="list-group-item">
                         عدد المدارس المؤكدة   شاركت السنة الماضية
                        <span class="badge badge-info">
                            <?php //echo $n->getCoutingConfirmedSchoolPrecedentYear(); 
                            ?>
                        </span>
                    </li>
                    -->
                    <li class="list-group-item">
                       
                         <?php
                         
                            echo CHtml::ajaxLink('عدد المشاريع', array('Statistics/ProjectTypeStat'), array('update' => '#modalBody',
                                            'complete' => 'function() {
          $("#basic").modal();
        }'));
                        ?>
                        <span class="badge badge-warning">
                            
                            
                            <?php
                             
                            echo Project::getCountAllProject($mobarat['mobarat_year']);
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        عدد الأساتذة المشرفين
                        <span class="badge badge-danger">
                            <?php echo Personteacher::getCountAllTeacher($mobarat['mobarat_year']);
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                        عدد الطلاب
                        <span class="badge badge-info">
                            <?php echo Personstudent::getCountAllStudent($mobarat['mobarat_year']); 
                            ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--END Portlet PORTLET-->
    <div class="col-md-7">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class = "caption">
                    <i class = "icon-reorder"></i> إرسال رسالة </div>
            </div>
            <div class="portlet-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'mb-message-form',
                    'enableAjaxValidation' => false,
                ));
                ?>
                <?php if ($form->error($model, 'to') || $form->error($model, 'message_content') || $form->error($model, 'message_subject')) { ?>
                    <div class='alert alert-danger'>
                        <?php echo $form->error($model, 'to'); ?>
                        <?php echo $form->error($model, 'message_content'); ?>
                        <?php echo $form->error($model, 'message_subject'); ?>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'to', array('class' => "control-label")); ?>
                            <?php echo $form->dropDownList($model, 'to', $list, array('empty' => 'اختر وجهة الرسالة', 'class' => 'form-control'));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'message_subject', array('class' => "control-label")); ?>
                            <?php echo $form->textField($model, 'message_subject', array('size' => 60, 'maxlength' => 100, 'class' => "form-control")); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'message_content', array('class' => "control-label")); ?>
                            <?php echo $form->textArea($model, 'message_content', array('rows' => 6, 'cols' => 50, 'class' => "form-control")); ?>
                        </div>
                        <div class="margin-top-10">
                            <?php
                            echo CHtml::submitButton('إرسال', array('class' => 'btn blue', 'confirm' => 'هل أنت متأكد من إرسال الرسالة؟'), '<i class="icon-ok"></i> ');
                            echo CHtml::resetButton('مسح', array('class' => 'btn btn-danger'), '<i class="icon-cut"></i> مسح الكل');
                            ?>
                        </div>
                      
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>

</div>




