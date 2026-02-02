<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);


?>
<?php $baseUrl = Yii::app()->theme->baseUrl;
//$n=new Functions;
?>

<html lang="en" class="no-js"> <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <!-- Mirrored from www.keenthemes.com/preview/metronic_admin_rtl/login_soft.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 26 Oct 2013 08:41:10 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
    <head>
        <meta charset="utf-8" />
    
        <title>تسجل الدخول - مباراة العلوم <?php $current=  Mobarat::getOpenMobaratRecord(); echo $current['mobarat_year']; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="MobileOptimized" content="320">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo $baseUrl; ?>/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $baseUrl; ?>/assets/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $baseUrl; ?>/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/assets/plugins/select2/select2_metro_rtl.css" />
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo $baseUrl; ?>/assets/css/style-metronic-rtl.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $baseUrl; ?>/assets/css/style-rtl.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $baseUrl; ?>/assets/css/style-responsive-rtl.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $baseUrl; ?>/assets/css/plugins-rtl.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $baseUrl; ?>/assets/css/themes/default-rtl.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="<?php echo $baseUrl; ?>/assets/css/pages/login-soft-rtl.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $baseUrl; ?>/assets/css/custom-rtl.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $baseUrl; ?>/assets/css/loginOverride.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
    </head>

    <body class="login">

        <div class="header navbar navbar-inverse navbar-fixed-top">
            <!-- BEGIN TOP NAVIGATION BAR -->
            <div class="header-inner">
                <!-- BEGIN LOGO -->
                <a class="navbar-brand" href=<?php echo Yii::app()->createurl("site/login");?>>
                    <img src="<?php echo $baseUrl; ?>/assets/img/logo.png" alt="logo" class="img-responsive" />
                </a>
            </div>
        </div>
        <!-- BEGIN LOGO -->

        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->

        <div class="row ">

            <div class="col-md-6 col-sm-6 p2">
                <div class="content">
                    <!-- BEGIN LOGIN FORM -->
                    <h3 class="form-title">تسجيل الدخول</h3>
                    <div class="alert alert-error hide">
                        <button class="close" data-dismiss="alert"></button>
                        <span>Enter any username and password.</span>
                    </div>
                    
                    <div class="form-group">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'login-form',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                        ));
                        ?>
                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                        <label class="control-label visible-ie8 visible-ie9">اسم الدخول</label>
                        <div class="input-icon">
                            <i class="icon-user"></i>
                            <?php echo $form->textField($model, 'username', array('class' => 'form-control placeholder-no-fix', 'placeholder' => "MUN")); ?>
                            <?php echo $form->error($model, 'username'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">كلمة المرور</label>
                        <div class="input-icon">
                            <i class="icon-lock"></i>
                            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control placeholder-no-fix', 'placeholder' => "كلمة المرور")); ?>
                            <?php echo $form->error($model, 'password'); ?>
                        </div>
                    </div>
                    <?php if($model->scenario=='withCaptcha' && CCaptcha::checkRequirements()){?>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">CAPTCHA</label>
                        <div class="input-icon">
                            <?php $this->widget('CCaptcha'); ?>
                            <?php echo $form->textField($model, 'verifyCode', array('class' => 'form-control placeholder-no-fix', 'placeholder' => "CAPTCHA")); ?>
                            <?php echo $form->error($model, 'verifyCode'); ?>
                        </div>
                    </div>
                    <?php }?>
                    <div class="form-actions">

                        <?php // echo $form->label($model,'!تذكرني');  ?>
                        <?php // echo $form->error($model,'rememberMe');  ?>
                        <label class="checkbox">
                            <?php echo $form->checkBox($model, 'rememberMe'); ?>تذكرني!
                        </label>
                        <button type="submit" class="btn grey pull-right">
                            دخول <i class="m-icon-swapleft m-icon"></i>
                        </button>
                    </div>
                    <?php $this->endWidget(); ?>
                    <div class="forget-password">
                        <h4>نسيت كلمة المرور؟</h4>
                        <p>
                            إضغط  <a href="javascript:;"  id="forget-password">هنا</a>
                            لإستعادة كلمة المرور.
                        </p>
                     <!--   <p>
                            إضغط  <a href="<?php echo Yii::app()->createurl('/site/forguet') ; ?>"  id="forget-password">هنا</a>
                            لإستعادة كلمة المرور.
                     </p> -->
                    </div>
                    </form>

                    <!-- END LOGIN FORM -->
                    <!-- BEGIN FORGOT PASSWORD FORM -->

			<script>
				function getVal()
				{
					var value=$("#email").attr('value');
					alert(value);
					return value;
					
				}
			</script>
                    <form id="forgetForm" class="forget-form" action=""  method="post">
                    	 <?php
                        $formForguet = $this->beginWidget('CActiveForm', array(
                            'id' => 'forguet-form',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                        ));
                        ?>
                        <h3 >نسيت كلمة المرور؟</h3>
                        <p>أدخل MUN</p>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="icon-user"></i>
                              <!--  <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="البريد الإلكتروني" name="email" id="email" />-->
                                 
                                <?php echo $formForguet->textField($model, 'username_missing', array('class' => 'form-control placeholder-no-fix', 'placeholder' => "MUN")); ?>
                            <?php echo $formForguet->error($model, 'username_missing'); ?>
                            </div>
                        </div>
                        <div id="destination"></div>
                          <div class="form-actions"> 
                            <button type="button" id="back-btn" class="btn">
                                <i class="m-icon-swapleft"></i> رجوع
                            </button>
                             <button type="submit" class="btn grey pull-right">
                          send <i class="m-icon-swapleft m-icon"></i>
                        </button>
                         <?php $this->endWidget(); ?>
                         <!--   <?php echo CHtml::ajaxLink('<button type="submit" class="btn blue pull-right">
                                إرسال <i class="m-icon-swapleft m-icon-white"></i>
                              </button>', array('site/sendemail','id' => 'js:getVal()'),array('update' => '#destination')); ?>
                              				
                          <a href="<?php echo Yii::app()->createurl('/site/sendemail' ) ; ?>/js:getVal()">
                                                                تسجيل مدرسة مشاركة سابقا
                                                        </a>-->
							<!--
                               
                               <button type="submit" class="btn blue pull-right">
                                إرسال <i class="m-icon-swapleft m-icon-white"></i>
                              </button>
                            
                          		<?php echo CHtml::ajaxLink('<button type="submit" class="btn blue pull-right">
                                إرسال <i class="m-icon-swapleft m-icon-white"></i>
                              </button>', array('../MbAdmin/SendEmail'), array('data' => array('id' => 75))); ?>
                              	
                            <?php	
                             echo CHtml::ajaxLink('<button type="submit" class="btn blue pull-right">
                                إرسال <i class="m-icon-swapleft m-icon-white"></i> </button>'
                                , array('../MbAdmin/SendEmail'),array('data' => array('id' => 75), 'beforeSend' => "function(){
                                	var mydata=15;
									
                                	this.data=mydata;

                                }")); ?>
-->	
                         </div> 
                         

                    </form>
                    <!-- END FORGOT PASSWORD FORM -->
                    <!-- BEGIN REGISTRATION FORM -->
                    <form class="register-form" action="" method="post">
                        <h3 >Sign Up</h3>
                        <p>Enter your personal details below:</p>
                        <div class="form-group">
                            <label class="control-label visible-ie8 visible-ie9">Full Name</label>
                            <div class="input-icon">
                                <i class="icon-font"></i>
                                <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="fullname"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                            <label class="control-label visible-ie8 visible-ie9">Email</label>
                            <div class="input-icon">
                                <i class="icon-envelope"></i>
                                <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"/>
                            </div>
                        </div>
                    </form>
                    <!-- END REGISTRATION FORM -->


                </div>

            </div>


      <div class="col-md-5 col-sm-5 p2">
         
      
                <div class="portlet box yellow">
                    <div class="portlet-title">
                        <div class="caption">

                            <i class="fa fa-calendar"></i>إعلان عن تحديث</div>


                    </div>
                    
                    <div class="portlet-body">
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 130px;">
                            <div class="scroller" style="height: 500px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible="0">
                              
              الأساتذة الكرام، الطلاب الأعزاء،<br>
              يسر الهيئة الوطنية للعلوم والبحوث أن تعلن عن إطلاق النسخة الجديدة من برنامج التسجيل لمباراة العلوم
              الذي خضع لتغييرات جوهرية من أجل خدمتكم بشكل أفضل.<br>
              ونحيطكم علما أننا أتحنا امكانية الترشح للمنح الجامعية مباشرة لطلاب المرحلة الثانوية. ويمكن للطلاب والاساتذة المشاركين سابقا إعادة المشاركة على رقم الـ MUN  الخاص بهم، وسوف يتاح قريبا الاطلاع على أرشيف مشاركاتهم.<br>
              لأي ملاحظات أوإستفسارات، يمكن للأستاذ المسؤول مراسلة الادارة من خلال حسابه في المباراة.
         

                            </div>

                       

                        </div>

                    </div>
                
                  </div>    
                 <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">

                            <i class="fa fa-calendar"></i>التسجيل للمباراة</div>


                    </div>
                    
                    <div class="portlet-body">
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 70px;"><div class="scroller" style="height: 300px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                    <?php
                                    
                                    /*
                                    $dateInfo = Mobarat::model()->findAll('openForRegistration=true');
                                    $d = new DateTime();
                                    $date = $d->format('Y-m-d');
                                    if (strtotime($date) < strtotime($dateInfo[0]['last_register_school'])) {
                                     
                                     */
                                     if ($isClosed==false  && $MaxSchoolNotAttemp==true){
                                        ?>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-check"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"><!--
                                                            <a href="<?php echo Yii::app()->homeUrl; ?>/School/ajax">
                                                                تسجيل مدرسة مشاركة سابقا
                                                            </a>
                                                            -->
                                                            <a href=<?php echo Yii::app()->createurl("/School/RegisterOldSchool"); ?>>
                                                                تسجيل مدرسة مشاركة سابقا
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>

                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-danger">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        <!--<a href="<?php //echo Yii::app()->homeUrl;                     ?>/MbSchool/create"> -->
                                                        <a  data-toggle="modal" href="#small">
                                                           تسجيل مدرسة جديدة للمباراة
                                                             
                                                        </a>

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-check"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            <a href="#">
                                                                 <?php
                                                                if($MaxSchoolNotAttemp==false)
                                                                     echo 'لقد وصل عدد المدارس المسجلين في مباراة العلوم '.$current['mobarat_year'].' إلى حده الأقصى '.$current['maxNoOfSchool'].'،'.'<br>'.' للاستفسار والمراجعة: التواصل مع إدارة المباراة على الرقم: '.$current['phone_trouble'];
                                                                else {
                                                                    echo ' انتهت مهلة تسجيل المدارس';
                                                                }
                                                            ?>
                                                               
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                    <?php } ?>
                                     
                            </div>

                        </div>

                        <div>

                        </div>

                    </div>
                 <div class="copyright" >
                         جميع الحقوق محفوظة - مباراة العلوم  <?php $current=  Mobarat::getOpenMobaratRecord(); echo $current['mobarat_year']; ?> &copy;
                    </div>

                </div>
            
            </div>







        </div>
		
        <!--[if lt IE 9]>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/respond.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/excanvas.min.js"></script>
        <![endif]-->
        <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/assets/plugins/select2/select2.min.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo $baseUrl; ?>/assets/scripts/app.js" type="text/javascript"></script>
        <script src="<?php echo $baseUrl; ?>/assets/scripts/login-soft.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
            jQuery(document).ready(function() {
                App.init();
                Login.init();
            });
        </script>
        <!-- END JAVASCRIPTS -->
        <script type="text/javascript">  var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-37564768-1']);
            _gaq.push(['_setDomainName', 'keenthemes.com']);
            _gaq.push(['_setAllowLinker', true]);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                //                ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();</script></body>


    <div class="row rememberMe">

    </div>

    <div class="row buttons">
        <?php // echo CHtml::submitButton('تسجيل الدخول');     ?>
    </div>

    
</div><!-- form -->


<div class="modal fade bs-modal-sm in" id="small" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">رسالة إدارية</h4>
            </div>
            <div class="modal-body">
                <?php /*$n = new Functions;*/ ?>
                عزيزي الأستاذ، شكراً لاختيارك التسجيل في مباراة العلوم <?php echo $maxYear; ?>، في حال حصول أي خطأ فني أثناء عملية التسجيل الرجاء التواصل معنا من خلال البريد الإلكتروني: registration@nasr.org.lb
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">إغلاق</button>

                <!-- <a class="btn blue" href="<?php echo Yii::app()->homeUrl; ?>/MbSchool/create">دخول</a> -->
                <a class="btn blue" href=<?php echo Yii::app()->createurl("School/create");?>>دخول</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>