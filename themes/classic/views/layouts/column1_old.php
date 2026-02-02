<?php /* @var $this Controller */ ?>
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<?php $this->beginContent('//layouts/main_old'); ?>
<body class="page-header-fixed">
         <!-- header -->
        <!-- BEGIN HEADER -->
        <div class="header navbar navbar-inverse navbar-fixed-top">
          <!-- BEGIN TOP NAVIGATION BAR -->
          <!--    <div class="header-inner"> -->
                <!-- BEGIN LOGO -->
                <!--<a class="navbar-brand" href="http://www.sciencelb.org/mobarat/moubarat/index.php/site/index">-->
                	<a class="navbar-brand" href=<?php echo Yii::app()->createAbsoluteUrl("/site/login"); ?>>
                    <img src="<?php echo $baseUrl; ?>/assets/img/logo.png" alt="logo" class="img-responsive" />
                </a>
              
                <!-- END LOGO -->


                <!-- END TOP NAVIGATION MENU -->
            <!-- </div> -->
            <!-- END TOP NAVIGATION BAR -->
        </div> 
        <div class="page-container">
<div class="page-content" id="content">
	<?php echo $content; ?>
    </div>
</div><!-- content -->
<?php $this->endContent(); ?>