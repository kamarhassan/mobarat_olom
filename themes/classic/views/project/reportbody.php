
<?php  $baseUrl = Yii::app()->theme->baseUrl;   
echo $clspaginator->summary ();
        $t=time();
?>
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
   <!--<div class="portlet box blue"> 
            <div class="portlet-title">
           <div class="caption"><i class="icon-bar-chart"></i>تقرير</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div> -->
        <div class="col-md-12">
            <div class="portlet box blue">
            <div class="portlet-body">

                <!---->
                <div class="portlet-body">
                   

                    <div class="table-scrollable">
                        <table class="table table-bordered">
                            <thead>
                                <tr  >
                                    <?php if($showtropphy=='true') { ?>
                                        <th>إضاف/إلغاء ميدالية</th>
                                        <th>جوائز</h>
                                        <th>الميدالية</th>
                                        <!-- uncomment for certification-->
                                        <th>شهادة</th>
                                        <!---->
                                    <?php  } ?>
                                       
                                    <th>معلومات إضافية</th>
                                    <th>السنة</th>
                                   
                                    <th>School ID</th>
                                    <th>المدرسة</th>
                                    <th>Project ID</th>
                                     
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


                                foreach ($prjs->data as $p) {

                                   $eo++;
                                    if ($eo % 2 == 0)
                                        $oddOrEven = "even";
                                    else
                                        $oddOrEven = "odd";
                                    //$projData = MbProjectDetail::model()->findByAttributes(array('pdetail_project' => $p->project_id));
                                    ?>
                                    <tr  <?php if ($oddOrEven == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
                                        <?php if($showtropphy=='true') { ?>
                                            <td width="150px">
                                                <?php
                                                    echo CHtml::ajaxLink('<button type="button" class="btn" style="background-color:#FFD700"><i class="icon-trophy"></i></button>'
                                                        , array('Project/AddPrize'), array( "type" => "GET"
                                                            ,'data' => array('id' =>  $p['project_id'], 'f' => '01')
                                                            ,"success" => "function(data){
                                                                $('#td_".$p['project_id']."').html(data);}",)
                                                        ,array('id'=>'go_'.$t.$p['project_id'],'title'=>'ميدلية ذهبية','confirm'=>'سوف يتم إعطاء ميدالية ذهبية للمشروع'));
                                                ?>

                                                <?php
                                                    echo CHtml::ajaxLink('<button type="button" class="btn" style="background-color:#C0C0C0"><i class="icon-trophy"></i></button>'
                                                        , array('Project/AddPrize'), array( "type" => "GET"
                                                            ,'data' => array('id' =>  $p['project_id'], 'f' => '02')
                                                            ,"success" => "function(data){
                                                                $('#td_".$p['project_id']."').html(data);}",)
                                                        ,array('id'=>'si_'.$t.$p['project_id'],'title'=>'ميدلية فضية','confirm'=>'سوف يتم إعطاء ميدالية فضية للمشروع'));
                                                ?>

                                                <?php
                                                   echo CHtml::ajaxLink('<button type="button" class="btn" style="background-color:#CD7F32"><i class="icon-trophy"></i></button>'
                                                        , array('Project/AddPrize'), array( "type" => "GET"
                                                            ,'data' => array('id' =>  $p['project_id'], 'f' => '03')
                                                            ,"success" => "function(data){
                                                                $('#td_".$p['project_id']."').html(data);}",)
                                                        ,array('id'=>'br_'.$t.$p['project_id'],'title'=>'ميدلية برونزية','confirm'=>'سوف يتم إعطاء ميدالية برونزية للمشروع'));
                                                ?>
                                                <?php

                                                    echo CHtml::ajaxLink('<button type="button" class="btn" style="background-color:#FF0000"><i class="icon-remove"></i></button>'
                                                        , array('Project/AddPrize'), array( "type" => "GET"
                                                            ,'data' => array('id' =>  $p['project_id'], 'f' => '04')
                                                            ,"success" => "function(data){
                                                                $('#td_".$p['project_id']."').html(data);}",)
                                                        ,array('id'=>'de_'.$t.$p['project_id'],'title'=>'إلغاء ميدلية','confirm'=>'سوف يتم إلغاء الميدالية'));

                                                ?>
                                            </td>
                                            <td>
                                            <?php
                                                   foreach($prizes as $prize){
                                                     //  echo CHtml::ajaxLink('<button type="button" class="btn" >'.$prize['code_name'].'<i class="icon-trophy"></i></button>'
                                                         echo CHtml::ajaxLink($prize['code_name']
                                                        , array('Project/AddOtherPrize'), array( "type" => "GET"
                                                            ,'data' => array('id' =>  $p['project_id'], 'f' => $prize['code_no'])
                                                            ,"success" => "function(data){
                                                                $('#td_".$p['project_id']."').html(data);}",)
                                                        ,array('id'=>'br_'.$t.$p['project_id']."_".$prize['code_no'],'title'=>$prize['code_name'],'confirm'=>'سوف يتم إعطاء جائزة' .' ' .$prize['code_name'])); 
                                                         echo '<br/>';
                                                   }
                                                    echo CHtml::ajaxLink('إلغاء'
                                                        , array('Project/AddOtherPrize'), array( "type" => "GET"
                                                            ,'data' => array('id' =>  $p['project_id'], 'f' => -1)
                                                            ,"success" => "function(data){
                                                                $('#td_".$p['project_id']."').html(data);}",)
                                                        ,array('id'=>'br_'.$t.$p['project_id']."_-1",'title'=>'إلغاء الجائزة','confirm'=>'سوف يتم إلغاء الجائزة' )); 
                                                ?>
                                            </td>
                                            <td id="<?php echo "td_".$p['project_id']; ?>"><?php echo $p['prizeName'];?></td>
                                           <!-- uncomment for certification-->
                                            <td width="150px">
                                               
                                                <a href="<?php echo $this->createAbsoluteUrl('Project/certification/prjid/'. $p['project_id'] ); ?>" target="_blank"  class="btn green icon-print"></a> 
                                            </td>
                                           <!---->
                                        <?php } ?>
                                        
                                        <td>
                                            <?php echo CHtml::ajaxLink('<button id="prdt'.$t. $p['project_id'].'" type="button" class="btn yellow"><i class=\'icon-search\'></i></button>'
                                                , array('Project/fulldetails' ), array('update' => '#modalBody',
                                                    'complete' => 'function() {$("#basic").modal();}'
                                                    ,'data' => array('prjid' => $p['project_id']))
                                                    ,array('id' =>'prdt'.$t. $p['project_id'],)); 
                                        ?>
                                           </td> 
                                           
                                        <td><?php echo $p['mobarat_year']; ?></td> 
                                        <td><?php echo $p['school_id']; ?></td>
                                        <td><?php echo $p['school_name']; ?></td>

                                        <td> <?php echo $p['project_id']; ?></td>
                                           
                                        <td class="r">
                                            <?php
                                            /*echo CHtml::ajaxLink($p['project_name'], array('Project/ModalProject')
                                                    , array('update' => '#modalBody','complete' => 'function() { $("#basic").modal();}',
                                                            'data' => array('id' => $p['project_id'])));*/
                                            ?>
                                            <?php echo $p['project_name']; ?>
                                           
                                        </td>
                                        <td><?php echo $p['project_type']; ?></td>
                                        <td><?php echo $p['project_stage']; ?></td>

                                        <td><?php echo $p['project_description']; ?></td>
                                        <td><?php echo $p['project_goal']; ?></td>
                                        <td><?php echo $p['project_tools']; ?></td>
                                        <td><?php echo $p['project_path']; ?></td>

                                         <td>
                                            <?php //echo "<a href='".cls_attach::getRelatedFolderURL(enm_Program::PROJECT, $p['project_id'])  . $p['project_attachment'] . "'>" . $p['project_attachment'] . "</a>"; 
                                            ?>
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
</div>

<?php 



//echo $this->renderPartial('__oldstudent',array('stds'=>$stds));

                              

echo  $clspaginator->createLinks( $links, 'pagination pagination-sm' ); 
?> 
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
