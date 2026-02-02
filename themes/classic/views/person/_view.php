<?php
/* @var $this PersonController */
/* @var $data Person */
?>

<div class="portlet box green">

    <div class="portlet-title">
        <div class="caption">
            <i class="icon-reorder"></i> معلومات الأستاذ المسؤول
        </div>

    </div>
    <div class="portlet-body form">

        <div class="form-body">
            <table>
                <tr>
                    <td  class="dd-handle" style="background-color:#5B98F3;color: white;" width="100px"> <b> الإسم الثلاثي</b> </td>

                    <td colspan="3">
                        <?php echo $model['Person_fname']; ?>
                        <?php echo ' '.$model['Person_mname']; ?>
                         <?php echo ' '.$model['Person_lname']; ?>
                    </td>
                    <td  rowspan="3">
                        
                 <?php
                               //$cls1=new cls_attach();
                               $bolExists=true;
                               $PicUrl= cls_attach::getPictureURL(enm_Program::PERSON,$model['Person_id'],$model['Person_pic'],$bolExists);
                            ?>
                           
                            <img  class="sa-picture" 
                               src=<?php echo "'".$PicUrl."' "; if($bolExists) echo "?cache=".  date("y/m/d h:i:sa")."'";?>/>
                           

            
                    </td>
                </tr>
                <tr >
                    <td class="dd-handle" style="background-color:#5B98F3;color: white;" width="100px" width="100px"> <b> الإسم بالأنكليزي</b> </td>
                    <td colspan="3">
                        <?php echo $model['person_efname']; ?>
                        <?php echo ' '.$model['person_emname']; ?>
                        <?php echo ' '.$model['person_elname']; ?>
                    </td>
                    
                </tr>
                <tr>
                    <td class="dd-handle" style="background-color:#5B98F3;color: white;"><b>المخاطبة</b></td> 
                    
                    <td width="100px">
                        <?php $sal=Codes::model()->find("code_kind=102 and code_no='".$model['Person_Salutation']."'") ?>
                        <?php echo $sal['code_name']; ?>
                    </td>
                    <td class="dd-handle" style="background-color:#5B98F3;color: white;" width="75px"> <b>  الجنس</b></td> 
                       
                    <td  width="75px">
                        
                          <?php 
                            if ($model['Person_sex']=='01') echo 'ذكر';
                            elseif ($model['Person_sex']=='02') echo 'أنثى';
                          ?>  
                    </td>
                   
                </tr>
                <tr>
                    <td class="dd-handle" style="background-color:#5B98F3;color: white;"><b>البريد الالكتروني </b></td> 
                    <td colspan="2"> <?php echo $model['Person_email1']; ?> </td>
                </tr>
                <tr>
                    <td class="dd-handle" style="background-color:#5B98F3;color: white;"> <b> المحمول</b></td> 
                    <td> <?php echo $model['Person_Phone']; ?></td>
                </tr>
                <?php if(isset($oteach)) 
                {  
                ?>
                 <tr>
                    <td class="dd-handle" style="background-color:#5B98F3;color: white;"> <b> الوصف </b> </td> 
                    <td> <?php echo $oteach['oteacher_description']; ?> </td>
                </tr>
                <?php }?>
            </table>



                    

        </div>

    </div>
</div>