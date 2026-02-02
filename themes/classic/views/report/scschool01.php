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
                 <?php echo CHtml::label('المدرسة',FALSE); ?>
            </td>
            <td width="150">
                 <?php echo CHtml::textField('txtSchool','',array('id'=>'txtSchool','class' => 'form-control ')); ?>
            </td>
             <td width="75" style="text-align:center">
                 <?php echo CHtml::label('الاستاذ المسؤول',FALSE); ?>
            </td>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('الإسم',FALSE); ?>
            </td>
            <td width="150" >
                 <?php echo CHtml::textField('txtFname','',array('id'=>'txtFname','class' => 'form-control ')); ?>
            </td>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('الشهرة',FALSE); ?>
            </td>
            <td width="150" >
                 <?php echo CHtml::textField('txtLname','',array('id'=>'txtLname','class' => 'form-control ')); ?>
            </td>



            <td width="20"></td>
            <td width="35">
                <?php 
                    if(isset($bodyreportparams))
                        $param=$bodyreportparams;
                    else 
                        $param=array();
                    $param['fname']="js:document.getElementById('txtFname').value ";
                    $param['lname']="js:document.getElementById('txtLname').value ";
                    $param['school']="js:document.getElementById('txtSchool').value ";
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
                <?php }?>    
        </tr>
    </table>
     </form>
    <?php
        Yii::app()->clientScript->registerScript('scid','$(document).ready(function(){$("#btsearch").click();});',CClientScript::POS_LOAD);
    ?>
</div>

