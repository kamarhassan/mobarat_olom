<?php 
    $baseUrl = Yii::app()->theme->baseUrl; 
    if(!isset($showSendMessage))
        $showSendMessage=false;
    if(!isset($isArchive))
        $isArchive=false;
    $t=time();
    $clsPerson=Yii::app()->session['clsPerson'] ;
    $showID=false;
    if ($clsPerson->user_type == '01'){
        $showID=true;
    }
         
?>
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
    <div id="ddd"></div>
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-bar-chart"></i>تقرير بالمشروع</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body">
                <?php if($isArchive==FALSE){?>
                <div class="note note-danger">
                    <p>
                        لا يقبل المشروع الا في حال اكتمال المعلومات

                    </p>
                </div>
                <?php }?>
                <div class="table-scrollable">
                    <table class="table table-bordered">
                        <thead>
                            <tr  >
                                <?php if($showSendMessage){?>
                                <th>إنذار</th>
                                <th>رسالة</th>
                                <?php }?>
                                <?php if($isArchive==FALSE){?>
                                <th>إكتمال  المعلومات</th>
                                <?php }?>
                                <th>معلومات إضافية</th>
                                <?php if($showID) {?>
                                <th>School ID</th>
                                <?php }?>
                                <th>المدرسة</th>
                                <?php if($showID) {?>
                                <th>Project ID</th>
                                <?php }?>
                                <th>اسم المشروع</th>
                                <th>الفئة</th>
                                <th>المرحلة</th>
                               
                                <th>المسار</th>
                                <th>الوصف</th>
                                <th>الهدف</th>
                                <th>الأدوات</th>
                               
                                <th>ملحقات</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $eo = 0;
							$oddOrEven="even";
							/*$fun=new Functions;
							$progress=0;*/
							

                            foreach ($project as $p) {
                                
								//$progress=$fun->getProjectRegistrationProgress($p->project_id);
                               
                                $eo++;
                                if ($eo % 2 == 0)
                                    $oddOrEven = "even";
                                else
                                    $oddOrEven = "odd";
                                //$projData = MbProjectDetail::model()->findByAttributes(array('pdetail_project' => $p->project_id));
                                ?>
                                <tr  <?php if ($oddOrEven == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
                                    <?php if($showSendMessage){?>                        
                                    <td>
                                        <?php
                                        echo CHtml::ajaxlink('<button type="button" class="btn btn-warning"><i class="icon-bullhorn"></i></button>', array('Project/NotifyToCompleteProject'), array(
                                            "type" => "GET",
                                            "data" => array("project_id" => $p['project_id'], "school_id" => $p['school_id']),
                                            "success" => "function(data){alert(\"لقد تم الإرسال إلى \"+data)}",
                                            ));
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo CHtml::ajaxlink('<button type="button" class="btn btn-warning"><i class="icon-envelope"></i></button>', array('MbMessage/projectNotComplete'), array(
                                            "type" => "GET",
                                            "data" => array("id" => $p['project_id']),
                                            "success" => "function(data){ alert(\"لقد تم إرسال الرسالة بنجاح إلى الأستاذ المشرف على المشروع\")}",
                                        ));
                                        ?>
                                    </td>
                                    <?php }?>
                                    <?php if($isArchive==FALSE){?>
                                    <td>
                                        <div class="progress progress-striped active">
                                            <?php
                                             $progress=  Project::getProgress($p);
                                            if ($progress < 100)
                                                $st = "danger";
                                            else
                                                $st = "success"
                                                ?>
                                            <div class="progress-bar progress-bar-<?php echo $st; ?>" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" 
                                                        contenteditable=""accesskey=""style="width: <?php echo $progress; ?>%">
                                                <span class="sr-only">40% Complete (success)</span>
                                                <?php echo $progress; ?>%
                                            </div>
                                        </div>
                                    </td>
                                    <?php }?>
                                    <td>
                                        <?php echo CHtml::ajaxLink('<button type="button" class="btn yellow"><i class=\'icon-search\'></i></button>'
                                                , array('Project/fulldetails' ), array('update' => '#modalBody',
                                                    'complete' => 'function() {$("#basic").modal();}'
                                                    ,'data' => array('prjid' => $p['project_id'])
                                                    ,array('id' =>'prdt'.$t. $p['project_id'],))); 
                                        ?>
                                    </td>
                                    <?php if($showID) {?>
                                        <td><?php echo $p['school_id']; ?></td>
                                    <?php }?> 
                                    
                                    <td><?php echo $p['school_name']; ?></td>
                                    
                                    <?php if($showID) {?>
                                        <td><?php echo $p['project_id']; ?></td>
                                    <?php }?>
                                    
                                    <td class="r">
                                         
                                        <?php echo $p['project_name']; ?>
                                    </td>
                                    <td><?php echo $p['project_type']; ?></td>
                                    <td><?php echo $p['project_stage']; ?></td>

                                    <td><?php echo $p['project_description']; ?></td>
                                    <td><?php echo $p['project_goal']; ?></td>
                                    <td><?php echo $p['project_tools']; ?></td>
                                    <td><?php echo $p['project_path']; ?></td>
                                   
                                     <td><?php /*echo "<a href='".cls_attach::getRelatedFolderURL(enm_Program::PROJECT, $p['project_id'])  . $p['project_attachment'] . "'>" . $p['project_attachment'] . "</a>"; */?>
                                        <?php echo CHtml::link($p['project_attachment'],array('Project/Download','prjid'=>$p['project_id']),array('Target'=>'Blank'));?>
                                    </td>
                                    

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>


                </div>

            </div>
        </div>
    </div>
</div>
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>