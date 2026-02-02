<?php
/*
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mb-school-form122',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => TRUE,
        ));*/
?>
<div id="Result">
    
</div>
<div >
    
<?php  echo $clspaginator->summary ();    ?>
<table class="table table-bordered" > 
                      <thead>
                        <tr>
                           
                            <th>الرقم</th>
                            <th>الاسم</th>
                            <th>الاب</th>
                            <th>الشهرة</th>
                             <th>البريد الالكتروني</th>
                            <th>السنة</th>
                            <th>المدرسة</th>
                           
                        </tr>
                    </thead >
                    <tbody>
                    
                  

    <?php
    $eo = 0;
    $oddOrEven="even";

    foreach ($stds->data as $std) {
        $eo++;
        if ($eo % 2 == 0)
            $oddOrEven = "even";
        else
            $oddOrEven = "odd";
        ?>
        <tr  <?php if ($oddOrEven == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
            
           
            <td >
                <?php
               /* echo CHtml::ajaxLink($std['person_id'], array('Project/ModalProject')
                        , array('update' => '#modalBody','complete' => 'function() { $("#basic").modal();}',
                                'data' => array('id' => $std['person_id'])));*/
                  $t=time();
                echo CHtml::ajaxLink($std['person_id'],array("Personstudent/regSetp3")
                        ,array('update' => '#Result'
                            , 'type' => 'POST'//,'schlid'=>$std['school_id']
                            , 'data' => array("id" => $std['person_id'],"prjid"=>$clspaginator->_params['prjid']))
                        ,array('id'=>'__lk'.$t.$std['person_id'],'name'=>'__lk'.$t.$std['person_id'],'confirm'=>'سوف يتم ارسال بريد الكتروني للطالب' . ' ' . $std['Person_fname'] . ' '.$std['person_lname'] ))
                
                
                ?>
            </td>
            <td><?php echo $std['Person_fname']; ?></td>
            <td><?php echo $std['Person_mname']; ?></td>

            <td><?php echo $std['person_lname']; ?></td>
            <td><?php echo $std['person_email1']; ?></td>
            <td><?php echo $std['mobarat_year']; ?></td>
            <td><?php echo $std['school_name']; ?></td>
            

        </tr>
    <?php } ?>
</tbody>
</table>
    </div>
<div id="tytyty"></div>
    
    <?php 
    ?>

<?php 



//echo $this->renderPartial('__oldstudent',array('stds'=>$stds));

                              

echo  $clspaginator->createLinks( $links, 'pagination pagination-sm' ); 
?> 


<?php //$this->endWidget(); 
?>