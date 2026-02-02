<?php 
$form = $this->beginWidget('CActiveForm', array(
    //'id' => 'mb-school-form122',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => TRUE,
        ));
?>
<?php  
echo $clspaginator->summary ();
        $t=time();
       
?>
<div class="row">
    
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
       
            <div class="table-scrollable">
            
                <table class="table table-bordered" style="display:block ; height:400px;;overflow:auto">
                    <thead >
                        <tr>
                          <!--  
                            <th>مشروع إضافي</th>
                            <th>إرسال</th>
                          -->
                            <th>تعديل الفئة</th>
                            <th>تعديل</th>
                            <th>تحديد المشاريع</th>
                            <!-- uncomment for certification-->
                            <th colspan="2">شهادة</th>
                            <!---->
                           
                            
                            <th>MUN</th>
                            <th>الاسم</th>
                            <th>الشهرة</th>
                            <th>المرحلة</th>
                            <th>الاختصاص1</th>
                            <th>الاختصاص2</th>
                            <th>بريد إلكتروني</th>
                            <th>الهاتف</th>
                            <th>الفئة</th>
                            <th>نواة الفئة</th>
                            <th>الاوقات المتاحة</th>
                        </tr>
                    </thead>
                    <tbody  >
                        <?php
                        $eo = 0;
                        foreach ($scls->data as $p) {

                            $eo++;
                            if ($eo % 2 == 0)
                                $cl = "even";
                            else
                                $cl = "odd";
                            ?>

                            <tr <?php if ($cl == "even") {
                                ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >
<!--
                                <td align="center">
                                    <?php echo CHtml::ajaxLink('<button type="button"  class="btn yellow"><i class="icon-plus"></i></button>'
                                                                , array('Admin/extraProject')
                                                                , array('data' => array('id' => $p['judge_id'])), array('id'=>'__lk_adpr_'.$t.$p['judge_id'],'name'=>'__lk_adpr_'.$t.$p['judge_id'],'confirm' => 'متأكد من إضافة مشروع؟')); 
                                     ?>
                                </td>

                                <td>
                                    <?php echo CHtml::ajaxLink('<button type="button"  class="btn blue"><i class="icon-envelope"></i></button>'
                                                                    , array('Admin/SendEmail')
                                                                    , array('data' => array('id' => $p['judge_id'])), array('id'=>'__lk_sm_'.$t.$p['judge_id'],'name'=>'__lk_sm_'.$t.$p['judge_id'],'confirm' => 'متأكد من إرسال الرسالة؟')); 
                                    ?>
                                </td>

                               -->
                                <td><a href="<?php echo $this->createAbsoluteUrl('Personjudge/Judgeupdate/' . $p['judge_id']); ?>"  class="btn green icon-edit"></a> </td>
                                <td><a href="<?php echo $this->createAbsoluteUrl('Person/Update/' . $p['Person_id']); ?>" target="_blank" class="btn green icon-edit"></a> </td>
                                <td><a href="<?php echo $this->createAbsoluteUrl('Project/projectsjudge/' . $p['judge_id']); ?>"  class="btn green icon-edit"></a> </td>
                                
                                 <!-- uncomment for certification-->
                                <td width="10%"><center><a href="<?php echo $this->createAbsoluteUrl('Personjudge/PrintAppreJudge/'. $p['judge_id'] ); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' '. $p['cert_apprecitation_print_count']?></b></a>  </center></td>
                                <td width="10%"><center>    <a href="<?php echo $this->createAbsoluteUrl('Personjudge/SendAppreJudge/'. $p['judge_id'] ); ?>"  target="_blank"  class="btn yellow icon-mail-reply"><b><?php echo ' '. $p['cert_apprecitation_send_count']?></b></a></center></td> 
                                <!-- -->
                                <?php $subMUN = substr($p['user_mun'], 2); ?>
                                <td><?php echo $subMUN; ?></td>
                                <td><?php echo $p['Person_fname']; ?></td>
                                
                                <td><?php echo $p['Person_lname']; ?></td>

                                <td><?php echo $p['judge_stage']; ?></td>
                                <td><?php echo $p['judge_speciality1']; ?></td>
                                <td><?php echo $p['judge_speciality2']; ?></td>
                                <td><?php echo $p['Person_email1']; ?></td>
                                <td><?php echo $p['Person_CellPhone']; ?></td>

                                <td><?php echo $p['projectType']; ?></td>
                                <td><?php echo $p['projectTypeKernel']; ?></td>
                               <td><?php echo $p['seletion']; ?></td>
                       
                              
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        
        </div>
  <!--  -->
</div>
<div id="tytyty"></div>
    
    <?php 
    ?>

<?php 



//echo $this->renderPartial('__oldstudent',array('stds'=>$stds));

                              

echo  $clspaginator->createLinks( $links, 'pagination pagination-sm' ); 
?> 


<?php $this->endWidget(); ?>