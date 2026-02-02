<?php //Yii::app()->clientScript->registerCoreScript('jquery'); 
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'place-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    <table width='100%'>
      
        <tr>
            <td width='30%'>المحافظة</td>
            <td width='100%'>
                <?php
                        $records = cls_codes::getChildCodes_ByCodeKind($codekind,'',3);
                        $list = CHtml::listData($records, 'code_no', 'code_name');
                        $list=CMap::mergeArray(array(0=>''),$list);
                        echo $form->dropDownList($model,'mohafaza',$list, array('class' => 'form-control', 'width' => 110,'Empty'=>'',
                                                'ajax' => array(
                                                    'type' => 'POST',
                                                    'url' => CController::createAbsoluteUrl('Codes/ChildCode'),
                                                    'data'=>array('codekind'=>$codekind,'father'=>'js:this.value','codelen'=>'6'),
                                                    //'update' => '#level2',
                                                    'success'=>'function(data) {

                                        $("#level2").html(data);$("#level3").html("");
                                    }',
                                    )));
                ?>
            </td>
        </tr>
        <tr>
            <td>القضاء</td>
            <td>
                <?php
                    echo $form->dropDownList($model,'kadaa',array(), array('id'=>'level2','class' => 'form-control', 'width' => 110,'Empty'=>'',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createAbsoluteUrl('Codes/ChildCode'),
                                    'data'=>array('codekind'=>$codekind,'father'=>'js:this.value','codelen'=>'9'),
                                    'update' => '#level3'
                                )));
                ?>
            </td>
        </tr>
        <tr>
            <td>المحلة</td>
            <td>
                <?php
                     echo $form->dropDownList($model,'place',array(), array('id'=>'level3','class' => 'form-control', 'width' => 110,'Empty'=>'',
                                /*'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('MbKadaa/kadaaByMohafaza'),
                                    'update' => '#kadaa'
                                )*/
                        ));
                ?>
            </td>
        </tr>
        
    </table>
    <br>
    
         <table width='100%'>
             <tr >
                 <td width='30%'></td>
                 <td width='40%'>
                     <?php echo CHtml::submitButton('موافق', array('class' => 'btn purple btn-block')); ?>
                 </td>
                 <td width='30%'></td>
             </tr>
         </table>
                <!-- BEGIN SAMPLE FORM PORTLET-->
                

               
                   
     

<?php $this->endWidget(); ?>
</div><!-- form -->

