<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" lang="en">
    <?php $baseUrl = Yii::app()->theme->baseUrl; ?>
    <head>
        <meta charset="utf-8" />
        <title>مباراة العلوم  | قسم التسجيل </title>
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
                <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
                
                <link href="<?php echo $baseUrl; ?>/assets/plugins/gritter/css/jquery.gritter-rtl.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
                <link href="<?php echo $baseUrl; ?>/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
                <!-- END PAGE LEVEL PLUGIN STYLES -->
                <!-- BEGIN THEME STYLES -->
                <link href="<?php echo $baseUrl; ?>/assets/css/style-metronic-rtl.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/css/style-rtl.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/css/style-responsive-rtl.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/css/plugins-rtl.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/css/pages/tasks-rtl.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/css/themes/default-rtl.css" rel="stylesheet" type="text/css" id="style_color"/>
                <link href="<?php echo $baseUrl; ?>/assets/css/custom-rtl.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/css/sa-style.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/css/dashboardcolors.css" rel="stylesheet" type="text/css"/>
                <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/plugins/data-tables/DT_bootstrap_rtl.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/assets/plugins/jquery-nestable/jquery.nestable.css" />
                <link href="<?php echo $baseUrl; ?>/assets/css/regNewSchool.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/css/select2.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo $baseUrl; ?>/assets/css/pages/inbox-rtl.css" rel="stylesheet" type="text/css" />
                <link href="<?php echo $baseUrl; ?>/assets/css/update.css" rel="stylesheet" type="text/css"/>

                <!-- END THEME STYLES -->
               
                <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css">
                <link rel="shortcut icon" href="favicon.ico" />
            </meta>
             
                </head>

                <?php echo $content; ?>
                <!-- Bug with checkbox -->
                
                
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script> 
                <!--jquery-1.10.2.min.js
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-3.2.1.min.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/chosen.jquery.min.js" type="text/javascript"></script>-->
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
                <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
                <!--jquery-ui.min.js
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
                -->
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-ui.min.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
                
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
                <!-- END CORE PLUGINS -->
                <!-- BEGIN PAGE LEVEL PLUGINS -->
                <script src="<?php echo $baseUrl; ?>/assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
                <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
                <script src="<?php echo $baseUrl; ?>/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
                <!-- END PAGE LEVEL PLUGINS -->
                <!-- BEGIN PAGE LEVEL SCRIPTS -->
               <!-- ERROR on check box-->
               <!--  <script src="<?php echo $baseUrl; ?>/assets/scripts/app.js" type="text/javascript"></script> -->
                <script src="<?php echo $baseUrl; ?>/assets/scripts/index.js" type="text/javascript"></script>
                <script src="<?php echo $baseUrl; ?>/assets/scripts/tasks.js" type="text/javascript"></script>
                


                <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-nestable/jquery.nestable.js"></script>
                <!-- END PAGE LEVEL SCRIPTS -->
                <script src="<?php echo $baseUrl; ?>/assets/scripts/ui-nestable.js"></script>
                <script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.MetaData.js"></script>
                <script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.MultiFile.js"></script>
                <script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.blockUI.js"></script>
                <script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.form.js"></script>
                <script type="text/javascript" src="<?php echo $baseUrl; ?>/assets/scripts/select2.js"></script>
                <script type="text/javascript" src="<?php echo $baseUrl; ?>/assets/plugins/data-tables/jquery.dataTables.min.js"></script>
                <script type="text/javascript" src="<?php echo $baseUrl; ?>/assets/plugins/data-tables/DT_bootstrap.js"></script>
                <script src="<?php echo $baseUrl; ?>/assets/scripts/table-advanced.js" type="text/javascript"></script>

                <script src="<?php echo $baseUrl; ?>/assets/scripts/update.js"></script>
                
                
                <!-- END PAGE LEVEL SCRIPTS -->
                <!-- bug with check box -->
                <!--
                <script>
                    jQuery(document).ready(function() {
                        App.init(); // initlayout and core plugins
                        Index.init();
//                        Index.initJQVMAP(); // init index page's custom scripts
//                        Index.initCalendar(); // init index page's custom scripts
//                        Index.initCharts(); // init index page's custom scripts
                        //Index.initChat();
                        //Index.initMiniCharts();
                        PortletDraggable.init();
                        Index.initDashboardDaterange();
                        Index.initIntro();
                        Tasks.initDashboardWidget();
                        TableAdvanced.init();
                        //UINestable.init();
                    });
                </script>
                -->
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
                        +'stats.g.doubleclick.net/dc.js';
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(ga, s);
                    })();</script>

                <script>
                    jQuery(document).ready(function() {
                        // initiate layout and plugins


                        // button state demo
                        $('.demo-loading-btn')
                                .click(function() {
                                    var btn = $(this)
                                    btn.button('loading')
                                    setTimeout(function() {
                                        btn.button('reset')
                                    }, 3000)
                                });
                    });
                </script>
</body>
                <!-- END BODY -->
                </body>
                </html>
