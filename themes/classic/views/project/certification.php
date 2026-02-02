<?php 
	$baseUrl = Yii::app()->theme->baseUrl;?>
        <script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-nestable/jquery.nestable.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/scripts/ui-nestable.js"></script>
<div class="row">

            <div class="note note-success">
                <p>
                    طباعة أو إرسال شهادة مشاركة أو تقدير  للمدرسة، الاستاذ المشرف والطلاب

                </p>
            </div>

        </div>
<div class="row">
<div class="col-md-3 "></div>
<div class="col-md-6 ">
    <div class="portlet-body form">

                        <div class="form-body">
                            <div class="form-group">
                                <?php if(count($school)>0) {?> 
                                <center><H2> <?php echo $school[0]['school_name'] ?></h2></center>
                                <?php }?>
                            </div>
                        </div>
    </div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-reorder"></i> المشروع
                        </div>
                        <div class="tools">
                            <a href="#" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body form">

                        <div class="form-body">
                            <div class="form-group">
                    <?php 
                    $trophy=false;
                    if(count($project)>0) {
                        if($project[0]['project_prize']=='01' || $project[0]['project_prize']=='02' || $project[0]['project_prize']=='03'){
                            $trophy=true;
                        }
                    }
                    if($trophy==false){
                         $typ='part';  
                        $label='شهادة مشاركة';
                    }  
                    else {
                        $typ='trophy';
                        $label='شهادة ميدالية';
                    }
                        
                                
                    foreach ($project as $p) {?>
                    <table width="100%">
                        <tr>
                            <td colspan="3"><div ><H3><center><?php echo $p['project_name']; ?></center></h3></div></td>
                            <td colspan="2"><h4><center> <?php echo $label;?></center> </h4></td>
                            
                        </tr>
                        <tr>
                            
                            <td width="20%"> <div ><H4><?php echo $p['project_stage']; ?> </H4></div></td>
                           
                            <td width="40%"> <div ><H4> <?php echo $p['project_type']; ?></H4></div></td>
                            <td width="20%"> <div ><H4><?php if($trophy==true){
                                if($project[0]['project_prize']=='01')
                                    echo 'ذهبية';
                                else if($project[0]['project_prize']=='02')
                                    echo 'فضية';
                                else 
                                    echo'برونزية';
                        }
                            ?> </H4></div></td>
                        <!--    
                            <?php if($trophy==false){?>
                            <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintPartSchool/'. $p['project_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' ar '. $p['cert_participate_print_count']?></b></a>  </center></td>
                            <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendPartSchool/'. $p['project_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' '. $p['cert_participate_send_count']?></b></a></center></td>
                             <?php }else{?>
                           <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintTrophySchool/'. $p['project_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' ع ' .$p['cert_trophy_print_count']?></b></a>  </center></td>
                           <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendTrophySchool/'. $p['project_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' '. $p['cert_trophy_send_count']?></b></a></center></td> 
                            <?php }?>
                        -->
                        <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintSchool/typ/'.$typ.'/lan/ar/id/'. $p['project_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' ar '?></b></a>  </center></td>
                        <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendSchool/typ/'.$typ.'/lan/ar/id/'. $p['project_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' ar '?></b></a></center></td>
                        </tr>
                                              
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                           
                            
                            <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintSchool/typ/'.$typ.'/lan/en/id/'. $p['project_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' en '?></b></a>  </center></td>
                            <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendSchool/typ/'.$typ.'/lan/en/id/'. $p['project_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' en '?></b></a></center></td>
                        </tr>
                    </table>
                    <?php }?>
                            </div></div></div>
                </div>
    
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-reorder"></i> الاستاذ المشرف
                        </div>
                        <div class="tools">
                            <a href="#" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body form">

                        <div class="form-body">
                            <div class="form-group">
                    <?php if(count($teacher)>0) {?> 
                    <table width="100%">
                         <tr>
                            <td ></td>
                          
                            <td colspan="4"><h4><center> <?php echo $label;?></center> </h4></td>
                           
                           
                        </tr> 
                        <tr>
                            <td width="60%"><H4><?php echo $teacher[0]['Person_fname'] . " " . $teacher[0]['Person_lname']; ?></H4></td>
                            <!--
                            <?php if($trophy==false){?>
                            <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintPartTeacher/'. $teacher[0]['project_teacher_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' '. $teacher[0]['cert_participate_print_count']?></b></a>  </center></td>
                            <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendPartTeacher/'. $teacher[0]['project_teacher_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' '. $teacher[0]['cert_participate_send_count']?></b></a></center></td>
                             <?php }else{?>
                           <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintTrophyTeacher/'. $teacher[0]['project_teacher_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' '. $teacher[0]['cert_trophy_print_count']?></b></a>  </center></td>
                           <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendTrophyTeacher/'. $teacher[0]['project_teacher_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' '. $teacher[0]['cert_trophy_send_count']?></b></a></center></td> 
                            <?php }?>
                            -->
                            <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintTeacher/typ/'.$typ.'/lan/ar/id/'. $teacher[0]['project_teacher_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' ar '?></b></a>  </center></td>
                            <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintTeacher/typ/'.$typ.'/lan/en/id/'. $teacher[0]['project_teacher_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' en '?></b></a>  </center></td>
                            <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendTeacher/typ/'.$typ.'/lan/ar/id/'. $teacher[0]['project_teacher_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' ar '?></b></a></center></td>
                            <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendTeacher/typ/'.$typ.'/lan/en/id/'. $teacher[0]['project_teacher_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' en '?></b></a></center></td>
                        </tr>

                    </table>
                    <?php }?>
                                 </div></div></div>
                </div>
    
    
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-reorder"></i> الطلاب
                        </div>
                        <div class="tools">
                            <a href="#" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body form">

                        <div class="form-body">
                            <div class="form-group">
                     <table width="100%">
                         <tr>
                            <td ></td>
                            <td colspan="4"><h4><center><?php echo $label;?></center> </h4></td>
                        </tr>            
                    <?php foreach ($stds as $std) {?> 
                   
                        <tr>
                            <td width="60%"><H4><?php echo $std['Person_fname'] . " " . $std['Person_lname']; ?></H4></td>
                            <!--
                             <?php if($trophy==false){?>
                            <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintPartStd/'. $std['project_student_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' '. $std['cert_participate_print_count']?></b></a>  </center></td>
                            <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendPartStd/'. $std['project_student_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' '. $std['cert_participate_send_count']?></b></a></center></td>
                             <?php }else{?>
                           <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintTrophyStd/'. $std['project_student_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' '. $std['cert_trophy_print_count']?></b></a>  </center></td>
                           <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendTrophyStd/'. $std['project_student_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' '. $std['cert_trophy_send_count']?></b></a></center></td> 
                            <?php }?>
                            -->
                            <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintStd/typ/'.$typ.'/lan/ar/id/'. $std['project_student_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' ar '?></b></a>  </center></td>
                            <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Project/PrintStd/typ/'.$typ.'/lan/en/id/'. $std['project_student_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' en '?></b></a>  </center></td>
                            <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendStd/typ/'.$typ.'/lan/ar/id/'. $std['project_student_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' ar '?></b></a></center></td>
                            <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Project/SendStd/typ/'.$typ.'/lan/en/id/'. $std['project_student_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' en '?></b></a></center></td>
                        </tr>
                        
                    
                    <?php }?></table>
                                 </div></div></div>
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

