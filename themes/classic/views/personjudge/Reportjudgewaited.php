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

        $t=time();
       
?>
<h1>الحكام المنتظرين</h1>
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
                           
                            <th>تعديل</th>
                            
                            <th>MUN</th>
                            <th>الاسم</th>
                            <th>الشهرة</th>
                            <th>بريد إلكتروني</th>
                            <th>الهاتف</th>
                          

                        </tr>
                    </thead>
                    <tbody  >
                        <?php
                        $eo = 0;
                        foreach ($judges as $p) {

                            $eo++;
                            if ($eo % 2 == 0)
                                $cl = "even";
                            else
                                $cl = "odd";
                            ?>

                            <tr <?php if ($cl == "even") {
                                ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >

                             
                                 <td><a href="<?php echo $this->createAbsoluteUrl('Person/Update/' . $p['Person_id']); ?>" target="_blank" class="btn green icon-edit"></a> </td>
                                
                                <?php $subMUN = substr($p['user_mun'], 2); ?>
                                <td><?php echo $subMUN; ?></td>
                                <td><?php echo $p['Person_fname']; ?></td>
                                
                                <td><?php echo $p['Person_lname']; ?></td>

                                <td><?php echo $p['Person_email1']; ?></td>
                                <td><?php echo $p['Person_CellPhone']; ?></td>

 
                              
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



<?php $this->endWidget(); ?>