<?php
    $clsPerson=Yii::app()->session['clsPerson'] ;
   
?>
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu">

            <li>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler hidden-phone"></div>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <form class="sidebar-search" action="" method="POST">
                    <div class="form-container">

                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="start active ">
                <a href="<?php echo $this->createAbsoluteUrl('Participant/index') ?>">
                    <i class="icon-home"></i>
                    <span class="title">الرئيسية</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="">
                <a href="javascript:;">
                    <i class="icon-tasks"></i>
                    <span class="title">المشاريع</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li >
                        <a href="<?php echo $this->createAbsoluteUrl('Project/listprojectsforupdatescl/sclid/'.$schlid); ?>">
                            تعديل المشروع</a>
                    </li>
                    <li >
                        <a href="<?php  echo $this->createAbsoluteUrl('Project/listprojectsscl/sclid/'.$schlid); ?>">
                            تقرير بالمشروع</a>
                    </li>
                </ul>
            </li>
             <li class="last ">
                    <a href="<?php echo $this->createAbsoluteUrl('Personteacher/regStep1/sclid/'.$schlid) ?>">
                        <i class="icon-user"></i>
                        <span class="title">تسجيل أساتذة مشرفين</span>
                    </a>
                </li>

                <li class="last ">
                    <a href="<?php echo $this->createAbsoluteUrl('Personstudent/regStep1/sclid/'.$schlid) ?>">
                        <i class="icon-group"></i>
                        <span class="title">تسجيل طلاب مشاركين</span>
                    </a>
                </li>
            <!--            <li class="">
                            <a href="<?php // echo $this->createAbsoluteUrl('MbTeacher/update/' . $teacher->teacher_id);   ?>">
                                <i class="icon-edit"></i>
                                <span class="title">تعديل البيانات الشخصية</span>
                            </a>
                        </li>-->
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>

