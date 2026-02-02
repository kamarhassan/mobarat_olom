<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="row">
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">معلومات عن المشروع</h4>
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
</div>
<div class="row">
    <div class="modal fade" id="basic1" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">معلومات عن المشروع</h4>
                </div>
                <div class="modal-body" id="modalBody1">



                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-bar-chart"></i>معلومات المدرسة</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body">

                <div class="table-scrollable">
                    <table class="table table-bordered">
                        <thead>
                            <tr  >

                                <td>MUN</td>
                                <th>إسم المدرسة</th>
                                <th>إسم المدير</th>
                                <th>المحافظة</th>
                                <th>القضاء</th>
                                <th>المدينة</th>
                                <th>الشارع</th>
                                <th>هاتف المدرسة</th>
                                <th>الأستاذ المسؤول</th>
                                <th>رقم هاتف الأستاذ المسؤول</th>
                                <th>البريد الإلكتروني</th>

                            </tr>
                        </thead>
                        <tbody bgcolor="#f9f9f9">
                            <?php
                            //$isPresent = JudgementSchool::model()->findAll('school_id=' . $school[0]['school_id']);

                            foreach ($school as $p) {
                                ?>



                            <td>
                                <a href="<?php echo $this->createAbsoluteUrl('MbSchool/update/' . $p->school_id) ?>">   <?php
                                    $subMUN = substr(Yii::app()->user->name, 0);

                                    echo $subMUN;
                                    ?>
                                </a>
                            </td>
                            <td><?php echo $p->school_name; ?></span</td>
                            <?php $man = MbSchoolManager::model()->findAll('smanager_school=' . $p->school_id); ?>
                            <td><?php echo $man[0]['smanager_fname'] . " " . $man[0]['smanager_lname']; ?></td>
                            <?php
                            $ka = MbKadaa::model()->findAll('kadaa_id =' . $p->school_kadda);
                            $mu = MbMouhafaza::model()->findAll('mouhafaza_id =' . $ka[0]['kadaa_mouhafaza'])
                            ?>
                            <td><?php echo $mu[0]['mouhafaza_name']; ?></td>
                            <td><?php echo $p->schoolKadda->kadaa_name; ?></td>
                            <td> <?php echo $p->school_street; ?> </td>
                            <td><?php echo $p->school_city; ?> </td>
                            <td><?php echo $p->school_phone; ?></td>
                            <?php $otea = MbOfficialTeacher::model()->findAll('oteacher_school=' . $p->school_id . ' AND (oteacher_flag=3 OR oteacher_flag=1)'); ?>
                            <td><?php echo $otea[0]['oteacher_fname'] . " " . $otea[0]['oteacher_lname']; ?></td>
                            <td><?php echo $otea[0]['oteacher_mobile'] ?></td>

                            <td><?php echo $otea[0]['oteacher_email'] ?></td>
                        <?php } ?>
                        </tbody>
                    </table>


                </div>

            </div>
        </div>
    </div>





    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption"><i class="icon-bar-chart"></i>تقرير بالمشاريع</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="note note-success">
                    <p>
                        لمعلومات إضافية عن المشروع, الضغط على إسم المشروع

                    </p>
                </div>
                <div class="table-scrollable">
                    <table class="table table-bordered">
                        <thead>
                            <tr  >

                                <th>تعديل</th>
                                <th>إكتمال المشروع</th>

                                <th>المدرسة</th>
                                <th>اسم المشروع</th>
                                <th>المرحلة</th>
                                <th>الفئة</th>
                                <th>المسار</th>

                                <th>الهدف</th>
                                <th>الأدوات</th>
                                <th>الطريقة</th>
                                <th>ملحقات</th>
                                <th>الوصف</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $eo = 0;

                            foreach ($project as $p) {
                            	$evenodd="";
                                $c1 = 12;
                                $c2 = 11;
                                $c3 = 11;
                                $c4 = 0;
                                $c5 = 0;
                                $c6 = 0;
                                $c7 = 0;
								$progress=0;
                                $eo++;
                                if ($eo % 2 == 0)
                                    $evenodd = "even";
                                else
                                    $evenodd = "odd";
                                $projData = MbProjectDetail::model()->findByAttributes(array('pdetail_project' => $p->project_id));
                                ?>
                                <tr  <?php if ($evenodd == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >


                                    <td class="j">
                                        <?php
//                                        echo CHtml::ajaxLink('<button type="button"  class="btn yellow">
//          <i class="icon-edit"></i>
//        </button>', array('MbProject/projectUpdate'), array('update' => '#modalBody1',
//                                            'complete' => 'function() {
//          $("#basic1").modal();
//        }','data' => array('id' => $p->project_id)));
                                        ?>
                                        <a href="<?php echo $this->createAbsoluteUrl('MbProject/projectUpdate/' . $p->project_id); ?>" target="_blank">
                                            <button type="button"  class="btn yellow">
                                                <i class="icon-edit"></i>
                                            </button>
                                        </a>                                    </td>

                                    <td>
                                        <?php
                                        if ($projData->pdetail_help != NULL)
                                            $c4 = 11;
                                        if ($projData->pdetail_description != NULL)
                                            $c5 = 11;
                                        if ($projData->pdetail_goal != NULL)
                                            $c5 = 11;
                                        if ($projData->pdetail_tools != NULL)
                                            $c6 = 11;
                                        if ($projData->pdetail_steps != NULL)
                                            $c6 = 11;
                                        if ($projData->pdetail_attachment != NULL)
                                            $c7 = 11;
										$progress=$c1 + $c2 + $c3 + $c4 + $c5 + $c6 + $c7;
                                        ?>
                                        

                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%">
                                                <span class="sr-only">40% Complete (success)</span>
                                                <?php echo $progress; ?>%
                                            </div>
                                        </div>
                                    </td>

                                    <?php $scname = MbSchool::model()->findAll('school_id=' . $p->project_school) ?>
                                    <td><?php echo $scname[0]['school_name']; ?></td>
                                    <td class="r">
                                        <?php
                                        echo CHtml::ajaxLink($p->project_name, array('MbSchool/modal'), array('update' => '#modalBody',
                                            'complete' => 'function() {
          $("#basic").modal();
        }',
                                            'data' => array('id' => $p->project_id)));
                                        ?>
                                    </td>
                                    <td><?php echo $p->projectStage->stage_name; ?></td>
                                    <td><?php echo $p->projectType->ptype_name; ?></td>

                                    <?php if ($projData) { ?>
                                        <td><?php echo $projData->phelp->help_name; ?></td>

                                        <td><?php echo $projData->pdetail_goal; ?></td>
                                        <td><?php echo $projData->pdetail_tools; ?></td>
                                        <td><?php echo $projData->pdetail_steps; ?></td>
                                        <td><?php echo $projData->pdetail_attachment; ?></td>
                                        <td><?php echo $projData->pdetail_description; ?></td>
                                    <?php } else { ?>
                                        <td></td>
                                        <td> </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    <?php } ?>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>


                </div>

            </div>
        </div>
    </div>
</div>

<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo $baseUrl; ?>/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo $baseUrl; ?>/assets/scripts/app.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/tasks.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/portlet-draggable.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/assets/plugins/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/table-advanced.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-nestable/jquery.nestable.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo $baseUrl; ?>/assets/scripts/ui-nestable.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.MetaData.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.MultiFile.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.blockUI.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.form.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/update.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        App.init(); // initlayout and core plugins
        Index.init();
        Index.initJQVMAP(); // init index page's custom scripts
        Index.initCalendar(); // init index page's custom scripts
        Index.initCharts(); // init index page's custom scripts
        Index.initChat();
        Index.initMiniCharts();
        PortletDraggable.init();
        Index.initDashboardDaterange();
        Index.initIntro();
        Tasks.initDashboardWidget();
        TableAdvanced.init();
        UINestable.init();
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
        //    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://')
        +'stats.g.doubleclick.net/dc.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();</script>