<?php 
    $clsPerson=Yii::app()->session['clsPerson'] ;
    $showID=false;
    if ($clsPerson->user_type == '01'){
        $showID=true;
    }
         
?>
<div class="col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption"><i class="icon-bar-chart"></i>تقرير</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="note note-success">
                <p>
                   لائحة الطلاب
                </p>
            </div>
            <div id="ddd"></div>
            <div class="table-scrollable">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>حذف</th>
                            
                            <td>MUN</td>
                             <?php if($showID) {?>
                                <th>Student ID</th>
                                <th>School ID</th>
                             <?php }?>
                           
                            <th>الإسم</th>
                            <th>الجنس</th>
                            <td>البريد الإلكتروني</td>
                            <th> الصف</th>
                            <th>الهاتف</th>
                            <th>تاريخ الولادة</th>

                        </tr>
                    </thead>
                    <tbody>
                    	
                        <?php
                        $eo = 0;
                        foreach ($std as $p) 
                        {
//$p=$model[count($model)-1];
                            $eo++;
							
							$subMUN="";
							
                            if ($eo % 2 == 0)
                                $cl = "even";
                            else
                                $cl = "odd";
                            ?>
                            <tr id="<?php echo 'tr'.$p['Student_id'];?>" <?php if ($cl == "even") {
                                ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >
                                   
                                    <?php 
                                    	
                                        $subMUN=substr($p['user_mun'],2);
											
                                    ?>

                                <td>
                                    <?php echo CHtml::ajaxLink('<button type="button"  class="btn red">
          <i class="icon-remove"></i>
        </button>', array('Personstudent/Delete'), array('complete' => 'function() {$("#tr'.$p['Student_id'].'").hide();}'
                    , 'type' => 'POST','data' => array('id' => $p['Student_id'])), array('confirm' => 'متأكد من حذف الطالب؟')); ?>



                                </td>
                                <td><?php echo $subMUN; 
                                	?>
                                	
                                </td>
                                <?php if($showID) {?>
                                    <td><?php echo $p['person_id']; ?></td>
                                    <td><?php echo $p['school_id'];?></td>
                                <?php }?>
                                
                                
                                <td>  <?php echo $p['Person_fname'] . " " . $p['Person_lname']; 
                                	?> </td>
                                <td><?php echo $p['Person_sex']; ?></td>
                                <td><?php echo $p['Person_email1']; ?></td>
                                <td><?php echo $p['student_class']; ?></td>
                                <td><?php echo $p['Person_CellPhone']; ?></td>
                                <td><?php echo $p['Person_birthdate']; ?></td>




                            </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>