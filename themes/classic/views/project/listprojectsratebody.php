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
                    <table class="table-bordered" style="table-layout: fixed; width:100%; word-break: break-word;">
                        <thead>
                            <tr  >
                                <th style="width: 50px;">تفصيل</th>
                                <!--<th>School ID</th>-->
                                <th >المدرسة</th>
                                <th style="width: 40px;">الجناح</th>
                                <!--<th>Project ID</th>-->
                                <th >اسم المشروع</th>
                                <th style="width: 125px;">الفئة</th>
                                <th style="width: 50px;" align="center" >المرحلة</th>
                                <th style="width: 50px;" align="center">عدد الحكام المسجلين</th>
                              
                                <!-- Disable الحكام النواة -->
                                <!-- <th style="width: 50px;" align="center">عدد الحكام النواة المسجلين</th> --> 
                                <th style="width: 50px;" align="center">عدد الحكام المحكمين</th>
                                
                                  <!-- Disable الحكام النواة -->
                                <!-- <th style="width: 50px;" align="center">عدد الحكام النواة المحكمين</th> -->
                               
                                <th style="width: 50px;">العلامة النهائية</th>
                                <th style="width: 50px;">العلامة المثقلة</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $eo = 0;
							$oddOrEven="even";
							/*$fun=new Functions;
							$progress=0;*/
							

                            foreach ($project->data as $p) {
                                
				
                                $eo++;
                                if ($eo % 2 == 0)
                                    $oddOrEven = "even";
                                else
                                    $oddOrEven = "odd";
                                //$projData = MbProjectDetail::model()->findByAttributes(array('pdetail_project' => $p->project_id));
                                ?>
                                <tr  <?php if ($oddOrEven == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
                                   <!--
                                   
                                    <td><a href="<?php echo $this->createAbsoluteUrl('Project/projectUpdate/prjid/' . $p['project_id']); ?>" target="_blank" class="btn green icon-edit"></a> </td>
                                     -->
                                     <td align="center"> 
                                        <?php echo CHtml::ajaxLink('<button type="button" class="btn yellow"><i class=\'icon-search\'></i></button>'
                                                , array('Project/fulldetails' ), array('update' => '#modalBody',
                                                    'complete' => 'function() {$("#basic").modal();}'
                                                    ,'data' => array('prjid' => $p['project_id'])
                                                    ,array('id' =>'prdt'.$t. $p['project_id'],))); 
                                        ?>
                                    </td> 
                                  
                                    <!--<td><?php echo $p['school_id']; ?></td>-->
                                    <td><?php echo $p['school_name']; ?></td>
                                    <td><?php echo $p['suite']; ?></td>
                                    <!--<td><?php echo $p['project_id']; ?></td>-->
                                    <td ><a href="<?php echo $this->createAbsoluteUrl('Project/projectrate/id/' . $p['project_id']); ?>" target="_blank" ><?php echo $p['project_name']; ?></a></td>
                                    <td><?php echo $p['project_type_name']; ?></td>
                                    <td align="center"><?php echo $p['project_stage_name']; ?></td>
                                    <td align="center"><?php echo $p['register_judge']; ?></td>

                                     <!-- Disable الحكام النواة -->
                                    <!-- <td align="center"><?php echo $p['register_judgeKernel']; ?></td> -->
                                    <td align="center"><?php echo $p['total_judge']; ?></td>
                                    
                                     <!-- Disable الحكام النواة -->
                                    <!-- <td align="center"><?php echo $p['total_judgekernel']; ?></td> -->
                                    <td align="center"><?php echo round($p['total_grade'],2); ?></td>
                                    <td align="center"><?php echo round($p['total_grade_coef'],2); ?></td>

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
