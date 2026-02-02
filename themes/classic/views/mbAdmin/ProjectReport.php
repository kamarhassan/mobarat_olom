<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="row">
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">معلومات عن المشروع</h4>
                </div>
                <div class="modal-body" id="modalBody" style="display: block; height: 400px;overflow: auto">

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


    <div class="note note-success">
        <p>
            لمعلومات إضافية عن المشروع, الضغط على إسم المشروع

        </p>
    </div>

    <table class="table table-bordered" style="display:block ; height:400px;;overflow:auto">
        <thead>
            <tr  >
                <th></th>
                <th>إكتمال المشروع</th>
                <th>Project ID</th>
                <th>المدرسة</th>
                <th>School ID</th>
                <th>اسم المشروع</th>
                <th>المرحلة</th>
                <th>الفئة</th>
                <th>المسار</th>

                <th>الهدف</th>
                <th>الأدوات</th>
                <th>الطريقة</th>
                <th>ملحقات</th>
                <th>الوصف</th>
                <!--
                <th>فيديو</th>
                -->


            </tr>
        </thead>
        <tbody>

            <?php
            $eo = 0;
			$fun=new Functions;
			$progress=0;

            foreach ($project as $p) {
            	$oddeven="even";
               
				$progress=$fun->getProjectRegistrationProgress($p->project_id);
                $eo++;
                if ($eo % 2 == 0)
                    $oddeven = "even";
                else
                    $oddeven = "odd";
                $projData = MbProjectDetail::model()->findByAttributes(array('pdetail_project' => $p->project_id));
                ?>
                <tr  <?php if ($oddeven == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
                    <td>
                        <a href="<?php echo $this->createAbsoluteUrl('MbProject/delete/' . $p->project_id); ?>" class="btn red btn-block" style="padding: 10px;">حذف</a>
                    </td>
                    <td>
                       

                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%">
                                <span class="sr-only">40% Complete (success)</span>
                                <?php echo $progress; ?>%
                            </div>
                        </div>
                    </td>
                    <td><?php echo $p->project_id; ?></td>
                    <?php $scname = MbSchool::model()->findAll('school_id=' . $p->project_school) ?>
                    <td><?php echo $scname[0]['school_name']; ?></td>
                    <td><?php echo $scname[0]['school_id']; ?></td>

                    <td class="r">
                        <?php
                        //echo CHtml::Link($p->project_name, array('MbAdmin/modalPro','id' => $p->project_id));
                        echo CHtml::ajaxLink($p->project_name, array('MbSchool/ModalProject'), array('update' => '#modalBody',
                            'complete' => 'function() {
          $("#basic").modal();
        }',
                            'data' => array('id' => $p->project_id)));
                        /*
                        echo CHtml::ajaxLink($p->project_name, array('MbAdmin/modalPro'), array('update' => '#modalBody',
                            'complete' => 'function() {
          $("#basic").modal();
        }',
                            'data' => array('id' => $p->project_id)));*/
                        ?>
                    </td>
                    <td><?php echo $p->projectStage->stage_name; ?></td>
                    <td><?php echo $p->projectType->ptype_name; ?></td>

                    <?php if ($projData) { ?>
                        <td><?php echo $projData->phelp->help_name; ?></td>

                        <td><?php echo $projData->pdetail_goal; ?></td>
                        <td><?php echo $projData->pdetail_tools; ?></td>
                        <td><?php echo $projData->pdetail_steps; ?></td>
                        <!--
                        <td><?php echo $projData->pdetail_attachment; ?></td>
                        -->
                        
                        <td><?php echo "<a href='" . $baseUrl . "/assets/attachments/file/" . $p->project_id . "/" . $projData->pdetail_attachment . "'>" . $projData->pdetail_attachment . "</a>"; ?></td>
                        <!--
                        	<td><?php echo "<a href='http://sciencelb.org/mobarat/moubarat/themes/classic/assets/attachments/file/" . $p->project_id . "/" . $projData->pdetail_attachment . "'>" . $projData->pdetail_attachment . "</a>"; ?></td>
                        	<td><a href="<?php echo Yii::app()->createUrl('Site/Download', array('projectID'=> $p->project_id,'fileName' =>$projData->pdetail_attachment));?>"> <?php echo $projData->pdetail_attachment; ?></td>
                        	-->
                        <td><?php echo $projData->pdetail_description; ?></td>
                        <!--
                        	<td>
                        	<?php
                            echo CHtml::checkBox('vta', $projData->video, array(
                                'onclick' => 'js: $.ajax({
                                    type: "GET",
                                       url: "' . CController::createUrl('MbProjectDetail/video/') . '",
                                       data: {id:' . $p->project_id . '}
                                });'
                            ));
                            ?>
                            </td>
                           -->
                            
                    <?php } else { ?>
                        <td></td>
                        <td> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                        <!--
                        	<td>
                        	<?php
                            echo CHtml::checkBox('vta', $projData->video, array(
                                'onclick' => 'js: $.ajax({
                                    type: "GET",
                                       url: "' . CController::createUrl('MbProjectDetail/video/') . '",
                                       data: {id:' . $p->project_id . '}
                                });'
                            ));
                            ?>
                             </td>
                            -->
                           
                    <?php } ?>
                    

                </tr>
            <?php } ?>
        </tbody>
    </table>


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