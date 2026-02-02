<script>
function fct(){
   /*alert('sdfsd');
   alert(document.getElementById('csv').value);*/
   //document.getElementById('csv').value="newData";
   document.getElementById('downloadForm').submit();
}
                 
</script>
<div id='searchcontrol'>
     <form method="POST" action="<?php if(isset($toexcelurl)) echo Yii::app()->createUrl($toexcelurl);?>" target="_blank" id="downloadForm">
    <table>
        <tr>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('السنة',FALSE); ?>
            </td>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::textField('txtYear','',array('id'=>'txtYear','class' => 'form-control ')); ?>
            </td>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('المدرسة',FALSE); ?>
            </td>
            <td width="150">
                 <?php echo CHtml::textField('txtSchool','',array('id'=>'txtSchool','class' => 'form-control ')); ?>
            </td>

            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('المشروع',FALSE); ?>
            </td>
            <td width="150" >
                 <?php echo CHtml::textField('txtPname','',array('id'=>'txtPname','class' => 'form-control ')); ?>
            </td>


            <td width="20"></td>
             <td width="35">
                <?php
                    
                    if(isset($bodyreportparams))
                        $param=$bodyreportparams;
                    else 
                        $param=array();
                    $param['pname']="js:document.getElementById('txtPname').value ";
                    $param['school']="js:document.getElementById('txtSchool').value ";
                    $param['myear']="js:document.getElementById('txtYear').value ";
                    $param['showall']="js:document.getElementById('chShowAll').checked";
                    echo CHtml::button('search', array('id'=>'btsearch','name'=>'btsearch','class' => 'form-control', 'width' => 110,'Empty'=>'',
                        'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createAbsoluteUrl($bodyreport),
                        'data'=>$param,
                        'cache'=>FALSE,
                        //'update' => '#level2',
                        'success'=>'function(data) {$("#fill_table").html(data);}',
                        ))); 
                    
                ?>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('إظهار الكل',FALSE); ?>
            </td>
            <td width="25" >
                 <?php echo CHtml::checkBox('chShowAll',false,array('id'=>'chShowAll','class' => 'form-control ')); ?>
            </td>
            <td width="20"></td>
            <?php 
                if(isset($showcsv)&&$showcsv=='true'){
                    ?>
              
             <td width="100">
                 <input type="button" id="btd" name="btd" value="CSV-excel" onclick="fct()" class="form-control"  width="100" style="background-color:#C0C0C0">
                    
                </input>
            </td>
                <?php } if($bodyreportparams['showtropphy']=='true'){?>
            <td>طباعة شهادة مشاركة لجمبع:  </td>  
            <td><a href="<?php echo $this->createAbsoluteUrl('Project/PrintPartAllSchool/lan/ar'); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' ar '. ' المدارس'?></b></a></td>
            <td><a href="<?php echo $this->createAbsoluteUrl('Project/PrintPartAllSchool/lan/en'); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' en '. ' المدارس'?></b></a></td>
            <td><a href="<?php echo $this->createAbsoluteUrl('Project/PrintPartAllTeacher/lan/ar'); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' ar '. ' الاساتذة'?></b></a></td>
            <td><a href="<?php echo $this->createAbsoluteUrl('Project/PrintPartAllTeacher/lan/en'); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' en '. ' الاساتذة'?></b></a></td>
            <td><a href="<?php echo $this->createAbsoluteUrl('Project/PrintPartAllStudent/lan/ar'); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' ar '. ' الطلاب'?></b></a></td>
            <td><a href="<?php echo $this->createAbsoluteUrl('Project/PrintPartAllStudent/lan/en'); ?>" target="_blank"  class="btn green icon-print"><b><?php echo ' en '. ' الطلاب'?></b></a></td>
                <?php } ?>
        </tr>
    </table>
     </form>
    <?php
        Yii::app()->clientScript->registerScript('scid','$(document).ready(function(){$("#btsearch").click();});',CClientScript::POS_LOAD);
    ?>
</div>

