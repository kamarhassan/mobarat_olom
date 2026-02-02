<?php /* @var $this Controller */ ?>
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<?php $this->beginContent('//layouts/main'); ?>

<?php
$clsPerson=Yii::app()->session['clsPerson'];
$current=  Mobarat::getOpenMobaratRecord();
//$type = null;//User::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
if ($clsPerson->user_type == null) {
    ?>
    <body class="page-header-fixed">
        <!-- header -->
        <!-- BEGIN HEADER -->
        <div class="header navbar navbar-inverse navbar-fixed-top">
            <!-- BEGIN TOP NAVIGATION BAR -->
            <div class="header-inner">
                <!-- BEGIN LOGO -->
                <!--<a class="navbar-brand" href="http://www.sciencelb.org/mobarat/moubarat/index.php/site/index">-->
                	<a class="navbar-brand" href=<?php echo Yii::app()->createurl("/site/login"); ?>>
                    <img src="<?php echo $baseUrl; ?>/assets/img/logo.png" alt="logo" class="img-responsive" />
                </a>
                <span style="color: white;
                      cursor: pointer;
                      float: left;
                      font-size: 21px;
                      padding: 7px;"><a style="color: white;text-decoration:none;" href="<?php echo Yii::app()->createAbsoluteUrl('site/logout'); ?>"><i class="icon-home" style="line-height: 28px !important;font-size: 31px;"></i></a></span>
                <!-- END LOGO -->


                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END TOP NAVIGATION BAR -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <?php
        } else {
            ?>

            <body class="page-header-fixed">
                <!-- header -->
                <!-- BEGIN HEADER -->
                <div class="header navbar navbar-inverse navbar-fixed-top">
                    <!-- BEGIN TOP NAVIGATION BAR -->
                    <div class="header-inner">
                        <!-- BEGIN LOGO -->
                        <a class="navbar-brand" href="http://mobarat.nasr.org.lb/index.php/site/index">
                            <img src="<?php echo $baseUrl; ?>/assets/img/logo.png" alt="logo" class="img-responsive" />
                        </a>
                        <!-- END LOGO -->
                        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <img src="<?php echo $baseUrl; ?>/assets/img/menu-toggler.png" alt="" />
                        </a>
                        <!-- END RESPONSIVE MENU TOGGLER -->
                        <!-- BEGIN TOP NAVIGATION MENU -->
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <li class="dropdown" id="header_notification_bar">


                                <a href="" onclick="i()" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class='icon-bullhorn'></i>
    <?php echo $this->renderPartial('/mbNotification/notification'); 
    ?>
                                </a>
                            </li>

                            <script>
                                function i() {
    <?php
    NotificationReceived::model()->updateAll(array('flag' => 1), 'user_id=' . Yii::app()->user->id);
    ?>
                                    notibadge.innerHTML = "0";
                                    notidetail.innerHTML = " ";
                                    notiheader.innerHTML = " لا يوجد إشعارات غير مقروءة";
                                }
                            </script>




                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN INBOX DROPDOWN -->
    <?php echo $this->renderPartial('/mbMessage/message'); 
    ?>
                            <!-- END INBOX DROPDOWN -->

                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <li class="dropdown user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
    <?php echo $this->renderPartial('/person/photoNavbar'); 
    ?>
                                </a>
                                <ul class="dropdown-menu">
                                        <?php if ($clsPerson->user_type != '01') { if(!User::isJudgeParticipant($current['mobarat_year'], $clsPerson->user_id)){?>
                                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('MbMessage/create'); ?>"><i class="icon-envelope"></i> إنشاء رسالة <span class="badge badge-success"><i class="icon-plus"></i></span></a>
                                        <?php }} else { ?>
                                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('MbMessage/adminMessage'); ?>"><i class="icon-envelope"></i> إنشاء رسالة <span class="badge badge-success"><i class="icon-plus"></i></span></a>
                                        <?php }if(!User::isJudgeParticipant($current['mobarat_year'], $clsPerson->user_id)){ ?>
                                    </li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('MbMessage/receive'); ?>"><i class="icon-inbox"></i> الرسائل الواردة </a></li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('MbMessage/send'); ?>"><i class="icon-upload-alt"></i> الرسائل المرسلة </a></li>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('MbMessage/trash'); ?>"><i class="icon-remove"></i> الرسائل المحذوفة </a></li>
                                        <?php }?>
                                    <div class="divider"></div>
                                        <?php if ($clsPerson->user_type == '01') { ?>
                                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('Admin/index'); ?>"><i class="icon-home"></i> الصفحة الرئيسية</a>
                                        <?php } else if ($clsPerson->user_type == '02') { ?>
                                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('Participant/index'); ?>"><i class="icon-home"></i> الصفحة الرئيسية </a>
                                        <?php } ?>
                                    </li>
                                    <div class="divider"></div>
                                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout'); ?>"><i class="icon-off"></i> خروج</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                        </ul>
                        <!-- END TOP NAVIGATION MENU -->
                    </div>
                    <!-- END TOP NAVIGATION BAR -->
                </div>
                <!-- END HEADER -->
                
                <?php if ($clsPerson->user_type == '01') { 
                    echo $this->renderPartial('/admin/sidebar'); 
                }else if ($clsPerson->user_type == '02'){
                    if(User::isOfTeacherParticipant($current['mobarat_year'], $clsPerson->user_id)){
                         $schl=  MobaratSchool::model()->find('mobarat_year='.$current['mobarat_year'].' and  oteacher_personid='.$clsPerson->person_id);
                         if($schl!=null)
                             echo $this->renderPartial('/school/sidebar',array("schlid"=>$schl['school_id'])); 
                    }else if(User::isTeacherParticipant($current['mobarat_year'], $clsPerson->user_id)){
                        echo $this->renderPartial('/personteacher/sidebar'); 
                    }else if(User::isStudentParticipant($current['mobarat_year'], $clsPerson->user_id)){
                        echo $this->renderPartial('/personstudent/sidebar'); 
                    }else if(User::isJudgeParticipant($current['mobarat_year'], $clsPerson->user_id)){
                        echo $this->renderPartial('/personjudge/sidebar'); 
                    }
                }
?>
    <?php 
    ?>
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
<?php }// if (Yii::app()->controller->id == 'mbStudent' && Yii::app()->controller->action->id != 'update') {                                ?>

                <div class="page-content">
<?php echo $content; ?>
                </div>
            </div><!-- page -->
            <div class="footer">
                <div class="footer-inner">
                     جميع الحقوق محفوظة - مباراة العلوم  <?php  echo $current['mobarat_year'];
                            ?> &copy;
                </div>

                <div class="footer-tools">
                    <span class="go-top">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>

                <div class="portlet box ihik">
                    <div class="portlet-title">


                    </div>
                    <div class="portlet-body util-btn-margin-bottom-5">

                        <a href="#" data-original-title="dropbox" class="social-icon dropbox"></a>
                        <a href="#" data-original-title="facebook" class="social-icon facebook"></a>
                        <a href="#" data-original-title="Goole Plus" class="social-icon googleplus"></a>
                        <a href="#" data-original-title="twitter" class="social-icon twitter"></a>
                        <a href="#" data-original-title="youtube" class="social-icon youtube"></a>
                        <a href="#" data-original-title="instagram" class="social-icon instagram"></a>
                    </div>
                </div>

            </div>
<?php $this->endContent();
?>