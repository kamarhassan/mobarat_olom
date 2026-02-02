<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<?php 
    foreach ($schls as $sch){
    ?>
<h3 class="page-title">
    صفحة تحكم المدرسة
</h3>
<h3 >
    عزيزي الاستاذ، لقد تم تحديث موقع مباراة العلوم، في حال شعرتم بعدم دقة المعلومات الواردة يرجى  <a class="more" href="<?php echo $this->createAbsoluteUrl('MbMessage/create'); ?>">
                إنشاء رسالة <i class="m-icon-swapleft m-icon-white"></i>
            </a>
</h3>

<?php
    if(Mobarat::showMessgaeForUpdate($current)){
?>
<h3>
    سوف يتاح لكم إمكانية إضافة مشروع, أستاذ مشرف وطالب مع امكانية التعديل ضمن الفترة:
    <?php echo $current['openforupdate_fromdate']?> و <?php echo $current['openforupdate_todate']?>
</h3>
    <?php }?>
<div class="row">
    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="icon-tasks"></i>
            </div>
            <div class="details">
                <div class="number">
                    تسجيل 
                </div>
                <div class="desc">
                    مشروع جديد
                </div>
            </div>

            <?php
            
            //$d = new DateTime();
            //$date = $d->format('Y-m-d');
            
            //if (strtotime($date) < strtotime($current['last_register_project'])) {
            if(Mobarat::isOpenForProject($current)){
                ?>
                <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/Create/sclid/'.$sch['school_id']) ;?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تسجيل المشاريع
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-user"></i>
            </div>
            <div class="details">
                <div class="number">تسجيل </div>
                <div class="desc">أساتذة مشرفين</div>
            </div>
            
            <?php //if (strtotime($date) < strtotime($current['last_register_teacher_student'])) { 
                 if(Mobarat::isOpenForRegisterTeacherStudent($current)){
                ?>
                <a class="more" href="<?php echo $this->createAbsoluteUrl('Personteacher/regStep1/sclid/'.$sch['school_id']) ?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تسجيل أساتذة مشرفين
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="icon-group"></i>
            </div>
            <div class="details">
                <div class="number">تسجيل </div>
                <div class="desc"> طلاب مشاركين</div>
            </div>
            <?php //if (strtotime($date) < strtotime($current['last_register_teacher_student'])) { 
                     if(Mobarat::isOpenForRegisterTeacherStudent($current)){
                ?>
                <a class="more" href="<?php echo $this->createAbsoluteUrl('Personstudent/regStep1/sclid/'.$sch['school_id']) ?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تسجيل طلاب مشاركين
                </a>
            <?php } ?>
        </div>
    </div>

    <div class="col-lg-2 col-md-1 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="icon-gear"></i>
            </div>
            <div class="details">
                <div class="number">تعديل </div>
                <div class="desc">بيانات المدرسة </div>
            </div>

            <?php //if (strtotime($date) < strtotime($current['last_update'])) { 
                    if(Mobarat::isOpenForUpdate($current)){
                
                ?>
                <a class="more" href="<?php echo $this->createAbsoluteUrl('School/update/' . $sch['school_id']); ?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تعديل البيانات
                </a>
            <?php } ?>
        </div>
    </div>
    
    <div class="col-lg-2 col-md-1 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="icon-gear"></i>
            </div>
            <div class="details">
                <div class="number">تعديل </div>
                <div class="desc">بيانات المسؤول </div>
            </div>

            <?php //if (strtotime($date) < strtotime($current['last_update'])) { 
                    if(Mobarat::isOpenForUpdate($current)){
                ?>
                <a class="more" href="<?php echo $this->createAbsoluteUrl('Person/update/' . $sch['oteacher_personid']); ?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تعديل البيانات
                </a>
            <?php } ?>
        </div>
    </div>
    
    <div class="col-lg-2 col-md-1 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="icon-gear"></i>
            </div>
            <div class="details">
                <div class="number">تعديل </div>
                <div class="desc">بيانات المدير </div>
            </div>
            <?php //if (strtotime($date) < strtotime($current['last_update'])) {
                    if(Mobarat::isOpenForUpdate($current)){
                
                ?>
                <a class="more" href="<?php echo $this->createAbsoluteUrl('Person/update/' . $sch['school_ManagerPersonID']); ?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تعديل البيانات
                </a>
            <?php } ?>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat orange">
            <div class="visual">
                <i class="icon-bar-chart"></i>
            </div>
            <div class="details">
                <div class="number">تقرير بالمشاريع</div>
                <div class="desc">المسجلة</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/listprojectsscl/sclid/'.$sch['school_id']) ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat bordo">
            <div class="visual">
                <i class="icon-edit"></i>
            </div>
            <div class="details">
                <div class="number">تعديل</div>
                <div class="desc">المشاريع</div>
            </div>

            <?php //if (strtotime($date) < strtotime($current['last_update'])) { 
                if(Mobarat::isOpenForUpdate($current)){
                ?>
                <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/listprojectsforupdatescl/sclid/'.$sch['school_id']) ?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تعديل المشاريع
                </a>
            <?php } ?>
        </div>
    </div>

    <!--  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="dashboard-stat yellow">
              <div class="visual">
                  <i class="icon-pencil"></i>
              </div>
              <div class="details">
                  <div class="number">تعديل</div>
                  <div class="desc">البيانات الشخصية</div>
              </div>
              <a class="more" href="<?php //echo $this->createAbsoluteUrl('MbOfficialTeacher/update/' . $oteacher[0]['oteacher_id'])                                                                                     ?>">
                  دخول <i class="m-icon-swapleft m-icon-white"></i>
              </a>
          </div>
      </div> -->


    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class="icon-tasks"></i>
            </div>
            <div class="details">
                <div class="number">تقرير </div>
                <div class="desc">الأساتذة</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Personteacher/listbyscl/'.$sch['school_id']); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class = "col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class = "dashboard-stat orange">
            <div class = "visual">
                <i class = "icon-tasks"></i>
            </div>
            <div class = "details">
                <div class = "number">تقرير</div>
                <div class = "desc">الطلاب </div>
            </div>
            <a class = "more" href = "<?php echo $this->createAbsoluteUrl('Personstudent/listbyscl/'.$sch['school_id']) ?>">
                دخول <i class = "m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>


    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <?php if (Yii::app()->user->hasFlash('success')): ?>
            <div class="info">
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class = "col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class = "dashboard-stat orange">
            <div class = "visual">
                <i class = "icon-tasks"></i>
            </div>
            <div class = "details">
                <div class = "number">تقرير</div>
                <div class = "desc">المشاركات السابقة </div>
            </div>
            <a class = "more" href = "<?php echo $this->createAbsoluteUrl('Project/listprojectssclarch/sclid/'.$sch['school_id']) ?>">
                دخول <i class = "m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> تغيير كلمة المرور
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>

                </div>

            </div>


            <div class="portlet-body form">
                <div class="form-body">


                    <a href="<?php echo Yii::app()->createAbsoluteUrl('User/Update/' . Yii::app()->user->id); ?>">
                        <?php echo CHtml::tag('button', array('class' => 'btn btn green btn-block'), '<i class="icon-remove"></i> إضغط هنا'); ?>

                    </a>
                </div>
                </br>
            </div>




        </div>
    </div>

    <div class="col-md-3 ">
        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> إكتمال التسجيل
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>

                </div>

            </div>

            <?php
            $progress=0;
            $progress= School::getSchoolRegistrationProgress($sch['school_id']);
            $TeacherCount=Personteacher::getCountAllTeacherForSchool($current['mobarat_year'],$sch['school_id']);
            $StudentCount=Personstudent::getCountAllStudentForSchool($current['mobarat_year'],$sch['school_id']);
           /* $n = new Functions();
			$progress=$n->getSchoolRegistrationProgress();
            
            
            
            if (Project::getCountProjectSchool($current['mobarat_year'],$sch['school_id']) > 0)
                $c1 = 34;
            else
                $c1 = 0;

            if ($TeacherCount > 0)
                $c2 = 33;
            else
                $c2 = 0;

            if ($StudentCount > 0)
                $c3 = 33;
            else
                $c3 = 0;
            
            $progress=$c1+$c2+$c3;
		*/	 
            ?>
            <div class="portlet-body form">
                <div class="form-body">
                    </br>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; /*echo $c1 + $c2 + $c3;*/ ?>%">
                            <span class="sr-only">40% Complete (success)</span>
                            <?php echo $progress;/*echo $c1 + $c2 + $c3;*/ ?>%
                        </div>
                    </div>
                </div>

            </div>




        </div>
    </div>

    <div class="col-md-3 ">
        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> عدد المشاريع المتبقية
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>

                </div>

            </div>

            <?php
            //$n = new Functions;
            //$oo = $n->getYear() - 1;
            //echo $n->getYear();
            $current['mobarat_year'];
            //$trophy = MbProject::model()->findAll('project_school=' . $n->getSchoolId() . ' AND prize=1 AND year=' . $oo);

            /*$totalprojectnow = MbProject::model()->findAll('project_school=' . $n->getSchoolId() . ' AND prize=1 AND year=' . $n->getYear());
            $motawaset = MbProject::model()->findAll('project_school=' . $n->getSchoolId() . ' AND year=' . $n->getYear() . ' AND project_stage=1');
            $sanawi = MbProject::model()->findAll('project_school=' . $n->getSchoolId() . ' AND year=' . $n->getYear() . ' AND project_stage=2');
            $school = MbSchool::model()->findAll('school_id=' . $n->getSchoolId());*/
            ?>
            <div class="portlet-body form">
                <div class="form-body">

                    <div class="clearfix">
                        <table class="table table-bordered table-striped">
                            <thead>

                            </thead>
                            <tbody>
                        <?php if($sch['school_level']=='01' || $sch['school_level']=='03'){ ?>
                                <tr>
                                    <td>
                                        <span class="font-blue"> متوسط</span>
                                    </td>

                                    <td>
                                        <span class="badge bg-blue">
                                            <?php
                                            if (1 - $sch['projectCountMota'] < 0)
                                                echo 0;
                                            else
                                                echo 1 - $sch['projectCountMota'];
                                            ?>  </span>
                                    </td>
                                </tr>
                            <?php    } 
                                if($sch['school_level']=='02' || $sch['school_level']=='03'){ ?>
                                <tr>
                                    <td>
                                        <span class="font-blue"> ثانوي</span>
                                    </td>

                                    <td>
                                        <span class="badge bg-blue">

                                            <?php
                                            if (1 - $sch['projectCountThan'] < 0)
                                                echo 0;
                                            else
                                                echo 1 - $sch['projectCountThan'];
                                            ?> </span>
                                    </td>
                                </tr>


                                <?php
                                }
								//if ($trophy != null || $school[0]['extraProject'] == 1) {
                                if ( $sch['extraProject'] == 1) {
                                    ?>
                                        <tr>
                                            <td>
                                                <span class = "font-blue"> إضافي</span>
                                            </td>

                                            <td>
                                                <span class = "badge bg-blue">
                                                   <?php
                                                        if ($sch['projectCountMota']<2 &&  $sch['projectCountThan'] < 2) 
                                                            echo '1';
                                                        else
                                                            echo '0';
                                                   ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php
                                    } ?>
                                       
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>




        </div>
    </div>




</div>
<br><br>
<div class = "row ui-sortable" id = "sortable_portlets">
    <div class = "col-md-4 column sortable">
        <!--BEGIN Portlet PORTLET-->

        <!--END Portlet PORTLET-->
        <!--BEGIN Portlet PORTLET-->
        <div class = " portlet box blue">
            <div class = "portlet-title">
                <div class = "caption"><i class = "icon-reorder"></i>عدد الأساتذة</div>

            </div>
            <div class = "portlet-body">
                <h2 class = "text-center">
                    <?php echo $TeacherCount; ?>

            </div>
        </div>
        <!-- END Portlet PORTLET-->

    </div>


    <!-- BEGIN Portlet PORTLET-->
    <div class="col-md-4 column sortable">
        <div class=" portlet box grey">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>عدد الطلاب</div>

            </div>
            <div class="portlet-body">
                <h2 class="text-center">
                    <?php echo $StudentCount; ?>
                </h2>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>
<?php }?>
