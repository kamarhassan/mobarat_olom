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
<div class="row">
        <div class="col-md-3 ">
            <a class='btn btn-warning btn-block' href="<?php   echo $this->createAbsoluteUrl('participant/Index') ?>" style="text-decoration: none;">
                      <i class="icon-arrow-right"></i> رجوع
            </a>
        </div>
       <div class="col-md-3 ">
            <a class='btn btn-danger btn-block' href="<?php   echo $this->createAbsoluteUrl('Site/Logout') ?>" style="text-decoration: none;">
                      <i class="icon-arrow-up"></i> تسجيل خروج
            </a>
        </div>
        </div>
<div class="row">
    
   <!--<div class="portlet box blue"> 
            <div class="portlet-title">
           <div class="caption"><i class="icon-bar-chart"></i>تقرير</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div> -->
   <div class="caption"><i class="icon-bar-chart"></i>عدد المشاريع <?php echo count($prjs); ?></div>
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
                            <th>#</th>
                            
                            <th>المشروع</th>
                            <th>الفئة</th>
                            <th>القاعة</th>
                            <th>الجناح</th>
                            <th>العلامة</th>
                           
                        </tr>
                    </thead>
                    <tbody  >
                        <?php
                        
                        $eo = 0;
                        foreach ($prjs as $p) {

                            $eo++;
                            if ($eo % 2 == 0)
                                $bgcolor = "#ffffff";
                            else
                                $bgcolor = "#f9f9f9";
                            
                            if($p['rated']==1)
                                $bgcolor = "#a5a5a5";
                            ?>

                            <tr bgcolor="<?php echo $bgcolor;?>" >

                               
                                <td> <center><?php echo $eo;?></center> </td>
                                

                                <td><a href="<?php echo $this->createAbsoluteUrl('Personjudge/Judgeprojectrate/id/'.$p['judge_personid'].'/prjjid/' . $p['project_judge_id']); ?>" ><?php echo $p['project_name']; ?></a></td>
                                
                                <td><?php echo $p['ptype']; ?></td>

                                <td><?php echo $p['hall']; ?></td>
                                <td><?php echo $p['suite']; ?></td>
                                <td><?php echo $p['grade']; ?></td>
                                

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
    
<?php $this->endWidget(); ?>