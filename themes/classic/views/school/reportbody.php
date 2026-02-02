<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mb-school-form122',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => TRUE,
        ));
?>
<?php  echo $clspaginator->summary ();
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
        <div class="portlet-body">
           
            <!---->
       
            <div class="table-scrollable">
            
                <table class="table table-bordered" style="display:block ; height:400px;;overflow:auto">
                    <thead >
                        <tr>
                            

                            <th >MUN</th>
                            <th>School ID</th>
                            <th>السنة</th>
                           
                            <th>إسم المدرسة</th>

                            <th>بريد إلكتروني</th>
                            <th>مرحلة</th>
                            <th>النوع</th>

                            <th>إسم المدير</th>

                            <th>بريد إلكتروني</th>
                            <th> هاتف المدير</th>
                            <th>الجنس</th>
                            <th>اللقب</th>

                            <th>المحافظة</th>
                            <th>القضاء</th>
                            <th>المدينة</th>
                            <th>الشارع</th>
                            <th>هاتف المدرسة</th>
                            <th>الأستاذ المسؤول</th>
                            <th>تعديل</th>
                            <th>رقم هاتف الأستاذ المسؤول</th>
                            <th>البريد الإلكتروني</th>
                            <th>الصفة</th>
                           

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

                                <?php $subMUN = substr($p['user_mun'], 2); ?>
                                <td><?php echo $subMUN; ?></td>
                                <td><?php echo $p['school_id']; ?></td>
                                <td><?php echo $p['mobarat_year']; ?></td>
                                <td><?php echo $p['school_name']; ?></td>

                                <td><?php echo $p['school_email']; ?></td>
                                <td><?php echo $p['school_level']; ?></td>
                                <td><?php echo $p['school_type']; ?></td>

                                
                                <td><?php echo $p['maname'] . " " . $p['malname']; ?></td>
                                <td><?php echo $p['mamail']; ?></td>
                                <td><?php echo $p['maphone']; ?></td>
                                <td><?php echo $p['masex']; ?></td>
                                <td><?php echo $p['masalutation']; ?></td>

                                <td><?php echo $p['moha']; ?></td>
                                <td><?php echo $p['kada']; ?></td>
                               
                                <td><?php echo $p['city'];?></td>
                                <td> <?php echo $p['school_street'];?> </td>

                                <td><?php echo $p['school_phone']; ?></td>
								
                                
                                <td><?php echo $p['ofname'] . " " . $p['oflname']; ?></td>
                                <td><a href="<?php echo $this->createAbsoluteUrl('Person/update/' . $p['ofid']); ?>" target="blank" class="btn green icon-edit"></a></td>
                                <td><?php echo $p['ofphone']; ?></td>

                                <td><?php echo $p['ofmail']; ?></td>
                                <td><?php echo $p['oteacher_description']; ?></td>
                                	
										
										
                       
                              
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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