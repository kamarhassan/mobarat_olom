<?php
$baseUrl = Yii::app()->theme->baseUrl;

?>

<h3 class="page-title">
    صفحة التحكيم لسنة <?php
    $clsPerson=Yii::app()->session['clsPerson'] ;
    echo $mobarat['mobarat_year'];
    //$n = new Functions;
   // echo $n->getYear();
    ?>
</h3>

<div class = "row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-bookmark"></i>
            </div>
            <div class="details">
                <div class="number">
                  إعدادات
                </div>
                <div class="desc">
                   التحكيم
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Mobarat/Mobaratjudgeupdate/'.$mobarat['mobarat_year']);
                                        //echo $this->createAbsoluteUrl('Admin/PendingSchool');
            
            ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="icon-user"></i>
            </div>
            <div class="details">
                <div class="number">
                  دعوة حكم
                </div>
                <div class="desc">
                   
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Admin/invitejudge');
                                        //echo $this->createAbsoluteUrl('Admin/PendingSchool');
            
            ?>">
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
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/listprojectsrate'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
</div>

<div class = "row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class="icon-user"></i>
            </div>
            <div class="details">
                <div class="number">
                 الحكام المنتظرين
                </div>
                <div class="desc">
                  تقرير
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Personjudge/Reportjudgewaited');
                                        //echo $this->createAbsoluteUrl('Admin/PendingSchool');
            
            ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-user"></i>
            </div>
            <div class="details">
                <div class="number">
                  الحكام الموافقين
                </div>
                <div class="desc">
                  تقرير
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Personjudge/Reportjudgeaccept');
                                        //echo $this->createAbsoluteUrl('Admin/PendingSchool');
            
            ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red">
            <div class="visual">
                <i class="icon-user"></i>
            </div>
            <div class="details">
                <div class="number">
                 الحكام المعتذرين
                </div>
                <div class="desc">
                  تقرير
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Personjudge/Reportjudgerejected');
                                        //echo $this->createAbsoluteUrl('Admin/PendingSchool');
            
            ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    

</div>
<div class = "row">
     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class=" icon-bullseye"></i>
            </div>
            <div class="details">
                <div class="number">
                    ربط  المدارس
                </div>
                <div class="desc">
                     بالقاعة
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Admin/Schoolhalls'); ?>">
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
                        عدد الحكام الذين تمت دعوتهم
                        <span class="badge badge-info">
                            <?php   echo Personjudge::model()->getCountAllInviteJudge($mobarat['mobarat_year']); ?>
                        </span>


                    </li>
                    <li class="list-group-item">
                        عدد الحكام المنتظرين
                        <span class="badge badge-warning">
                            <?php   echo Personjudge::model()->getCountWaitedJudge($mobarat['mobarat_year']); ?>
                        </span>


                    </li>

                    <li class="list-group-item">
                        عدد الحكام الموافقين
                        <span class="badge badge-success">
                           <?php   echo Personjudge::model()->getCountAcceptedJudge($mobarat['mobarat_year']); ?>
                        </span>


                    </li>
                 
                  
                    <li class="list-group-item">
                        عدد الحكام المعتذرين
                        <span class="badge badge-danger">
                             <?php   echo Personjudge::model()->getCountRejectedJudge($mobarat['mobarat_year']); ?>
                           
                        </span>
                    </li>
                   
                </ul>
            </div>
        </div>
    </div>
    <!--END Portlet PORTLET-->

</div>


