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
            <td width="100">
                 <?php echo CHtml::textField('txtSchool','',array('id'=>'txtSchool','class' => 'form-control ')); ?>
            </td>
            
             <td width="75" style="text-align:center">
                 <?php echo CHtml::label('الجناح',FALSE); ?>
            </td>
            <td width="80">
                 <?php echo CHtml::textField('txtSuite','',array('id'=>'txtSuite','class' => 'form-control ')); ?>
            </td>

            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('المشروع',FALSE); ?>
            </td>
            <td width="100" >
                 <?php echo CHtml::textField('txtPname','',array('id'=>'txtPname','class' => 'form-control ')); ?>
            </td>
             <td width="75" style="text-align:center">
                 <?php echo CHtml::label('الفئة',FALSE); ?>
            </td>
            <td width="100" >
                 <?php 
                 echo Chtml::dropDownList('cbPrType', ''
                         , CHtml::listData(Mobarat::getCodeEnable(111), 'code_no', 'code_name')
                         ,array('id'=>'cbPrType','class' => 'form-control ','empty' => 'اختر الفئة', )); ?>
            </td>
             <td width="75" style="text-align:center">
                 <?php echo CHtml::label('المرحلة',FALSE); ?>
            </td>
            <td width="110" >
                 <?php  

                 echo Chtml::dropDownList('cbStage', ''
                         , CHtml::listData(cls_codes::getCodes_ByCodeKind(106), 'code_no', 'code_name')
                         ,array('id'=>'cbStage','class' => 'form-control ','empty' => 'اختر المرحلة', )); ?>
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
                    $param['suite']="js:document.getElementById('txtSuite').value ";
                    $param['prType']="js:document.getElementById('cbPrType').value ";
                    $param['stage']="js:document.getElementById('cbStage').value ";
                    $param['projectThisDay']="js:document.getElementById('chProjectThisDay').checked";
                    $param['Register_JudgeKernel']="js:document.getElementById('chRegister_JudgeKernel').checked";
                    $param['Register_Judge']="js:document.getElementById('chRegister_Judge').checked";
                    $param['JudgeKernel']="js:document.getElementById('chJudgeKernel').checked";
                    $param['Judge']="js:document.getElementById('chJudge').checked";
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
                 <?php echo CHtml::label('إظهار مشاريع اليوم فقط',FALSE); ?>
            </td>
            <td width="25" >
                 <?php echo CHtml::checkBox('chProjectThisDay',false,array('id'=>'chProjectThisDay','class' => 'form-control ')); ?>
            </td>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('حكام نواة مسجلين صفر',FALSE); ?>
            </td>
            <td width="25" >
                 <?php echo CHtml::checkBox('chRegister_JudgeKernel',false,array('id'=>'chRegister_JudgeKernel','class' => 'form-control ')); ?>
            </td>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('حكام فئة مسجلين صفر',FALSE); ?>
            </td>
            <td width="25" >
                 <?php echo CHtml::checkBox('chRegister_Judge',false,array('id'=>'chRegister_Judge','class' => 'form-control ')); ?>
            </td>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('حكام نواة صفر',FALSE); ?>
            </td>
            <td width="25" >
                 <?php echo CHtml::checkBox('chJudgeKernel',false,array('id'=>'chJudgeKernel','class' => 'form-control ')); ?>
            </td>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('حكام فئة صفر',FALSE); ?>
            </td>
            <td width="25" >
                 <?php echo CHtml::checkBox('chJudge',false,array('id'=>'chJudge','class' => 'form-control ')); ?>
            </td>
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
                 <input type="button" id="btd" name="btd" value="EXCEL" onclick="fct()" class="form-control"  width="100" style="background-color:#C0C0C0">
                    
                </input>
                
            </td>
            <td width="100">
                <?php 
                    echo CHtml::link('النتيجة النهائية',array('Project/result'),array('target'=>"_blank",'id'=>'btResult','class' => 'form-control', 'width' => 110,'style'=>"background-color:#02AA0A"));
                ?>
            </td>
                <?php }?>    
        </tr>
    </table>
     </form>
    <?php
        Yii::app()->clientScript->registerScript('scid','$(document).ready(function(){$("#chProjectThisDay").attr("checked",true);$("#chShowAll").attr("checked",true);$("#btsearch").click();});',CClientScript::POS_LOAD);
    ?>
</div>

