<?php 
    $baseUrl = Yii::app()->theme->baseUrl; 
   
    echo $clspaginator->summary ();
            $t=time();
?>

<div class="row">
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">تفصيل المشروع</h4>
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

    <div id="modalBody1"></div>
    <div class="col-md-12">
        <div class="portlet box blue">
           
            <div class="portlet-body">
              
                <div class="table-scrollable">
                    <table class="table table-bordered">
                        <thead>
                            <tr  >
                               
                                <th>إكتمال  المعلومات</th>
                                <th>تعديل</th>
                                <th>معلومات إضافية</th>
                                <th>School ID</th>
                                <th>المدرسة</th>
                                <th>Project ID</th>
                                <th>اسم المشروع</th>
                                <th>الفئة</th>
                                <th>المرحلة</th>
                                <th>الطلاب</th>
                                <th>الاستاذ المشرف</th>
                                <th>الاستاذ المسؤول</th>
                                <th>رقم الهاتف</th>
                                <th>البريد الالكتروني</th>
                                <th style="width:50px">المسار</th>
                                <th style="width:50px">الوصف</th>
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
							

                            foreach ($project->data as $p) {
                                
								//$progress=$fun->getProjectRegistrationProgress($p->project_id);
                                $progress=  Project::getProgress($p);
                                $eo++;
                                if ($eo % 2 == 0)
                                    $oddOrEven = "even";
                                else
                                    $oddOrEven = "odd";
                                //$projData = MbProjectDetail::model()->findByAttributes(array('pdetail_project' => $p->project_id));
                                ?>
                                <tr  <?php if ($oddOrEven == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
                                   
                                    <td>
                                        <div class="progress progress-striped active">
                                            <?php
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
                                    <td><a href="<?php echo $this->createAbsoluteUrl('Project/projectUpdate/prjid/' . $p['project_id']); ?>" target="_blank" class="btn green icon-edit"></a> </td>
                                    <td> 
                                        <?php echo CHtml::ajaxLink('<button id="prdt'.$t. $p['project_id'].'" type="button" class="btn yellow"><i class=\'icon-search\'></i></button>'
                                                , array('Project/fulldetails' ), array('update' => '#modalBody',
                                                    'complete' => 'function() {$("#basic").modal();}'
                                                    ,'data' => array('prjid' => $p['project_id'])
                                                    ),array('id' =>'prdt'.$t. $p['project_id'],)); 
                                        ?>
                                    </td> 
                                    <td><?php echo $p['school_id']; ?></td>
                                    <td><?php echo $p['school_name']; ?></td>
                                    <td><?php echo $p['project_id']; ?></td>
                                    <td><?php echo $p['project_name']; ?></td>
                                    <td><?php echo $p['project_type']; ?></td>
                                    <td><?php echo $p['project_stage']; ?></td>
                                    <td><?php echo $p['students']; ?></td>
                                    <td><?php echo $p['teacher']; ?></td>
                                    <td><?php echo $p['oteacher']; ?></td>
                                    <td><?php echo $p['Person_CellPhone']; ?></td>
                                    <td><?php echo $p['Person_email1']; ?></td>
                                    <td style="width:50px"><?php echo $p['project_path']; ?></td>

                                    <td style="width:50px"><?php echo $p['project_description']; ?></td>
                                    <td><?php echo $p['project_goal']; ?></td>
                                    <td><?php echo $p['project_tools']; ?></td>
                                   
                                   
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
<?php 

echo  $clspaginator->createLinks( $links, 'pagination pagination-sm' ); 
?> 

<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
