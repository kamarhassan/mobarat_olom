<?php
$baseUrl = Yii::app()->theme->baseUrl;
if(!isset($enmSchoolType)){
    $enmSchoolType= enm_SchoolType::SCHOOL;
}
  //Yii::app()->clientScript->registerScript('scid','src="'.$baseUrl.'/assets/plugins/chosen.jquery.min.js" type="text/javascript"',CClientScript::POS_LOAD);


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */?>

 <link href="<?php echo $baseUrl; ?>/assets/plugins/chosen.min.css" rel="stylesheet" type="text/css"/>
 <script src="<?php echo $baseUrl; ?>/assets/plugins/chosen.jquery.js" type="text/javascript"></script>

<!--
<script src="<?php /*echo $baseUrl; */?>/assets/plugins/chosen.jquery.min.js" type="text/javascript"></script> -->
                
                <div class="portlet-body form" >

                    <div class="form-body">
                        <table>
                            <tr>
                                <td width="100"><?php $attr='school_country';
                                    echo $form->labelEx($model, $attr); 
                                    $ss='';
                                        if(strlen($model->getError($attr))>0) $ss=' validationError';
                                       
                                    echo $ss;
                                    ?> </td>
                                <td  width="150" class="<?php echo $ss;?>">
                                    <?php                                    
                                        $records = cls_codes::getCodes_ByCodeKind(114);
                                        $list = CHtml::listData($records, 'code_no', 'code_name');
                                        
                                        //$query="SELECT school_id, school_email FROM ssciencelb.school where not school_email is null;";
                                        //$p=Yii::app()->getDB()->createCommand($query)->queryAll();
                                        //$list1 = CHtml::listData($p, 'school_id', 'school_email');
                                        //$qurery
                                        echo $form->dropDownList($model, $attr, $list, array('data-placeholder'=>'إختر','id'=>'cb'.$attr,'empty' => 'إختر','size'=>'250','class' => 'chosen-select' ));
                                        //if($model->isAttributeRequired($attr)) echo '*';
                                    ?> 
                                   
                                </td>
                                <td width="15">
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                               
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <?php $attr='school_name';
                                    echo $form->labelEx($model, $attr);?>
                                    (يرجى كتابة اسم المدرسة الرسمي المرخص من قبل وزارة التربية).
                                    <?php
                                    $ss='';
                                    if(strlen($model->getError($attr))>0) $ss=' validationError';
                                        echo $form->textField($model, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                                    //if($model->isAttributeRequired($attr)) echo '*';
                                        ?> 
                                
                                </td>
                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <?php $attr='school_ename';
                                    echo $form->labelEx($model, $attr);                                    
                                    $ss='';
                                    if(strlen($model->getError($attr))>0) $ss=' validationError';
                                        echo $form->textField($model, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                                    //if($model->isAttributeRequired($attr)) echo '*';
                                        ?> 
                                
                                </td>
                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                            </tr>
                             <tr>
                                <td width="100"><?php $attr='school_type';
                                    echo $form->labelEx($model, $attr); ?> </td>
                                <td >
                                    <?php                                    
                                        $ss='';
                                        if(strlen($model->getError($attr))>0) $ss=' validationError';
                                        $records = cls_codes::getCodes_ByCodeKind(107);
                                        $list = CHtml::listData($records, 'code_no', 'code_name');
                                        echo $form->dropDownList($model, $attr, $list, array('id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control'.$ss));
                                        //if($model->isAttributeRequired($attr)) echo '*';
                                    ?> 
                                
                                </td>
                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                                <td width="100"><?php $attr='school_level';
                                    echo $form->labelEx($model, $attr); ?> </td>
                                <td >
                                    <?php                                    
                                        $ss='';
                                        if(strlen($model->getError($attr))>0) $ss=' validationError';
                                        $records = cls_codes::getCodes_ByCodeKind(106);
                                        $list = CHtml::listData($records, 'code_no', 'code_name');
                                        echo $form->dropDownList($model, $attr, $list, array('id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control'.$ss));
                                        //if($model->isAttributeRequired($attr)) echo '*';
                                    ?> 
                                
                                </td>
                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                             </tr>
                            <tr>
                                <td width="100"><?php $attr='school_place';
                                    echo $form->labelEx($model, $attr);  
                                 $ss='';
                                    if(strlen($model->getError($attr))>0) $ss=' validationError';
                                ?>
                                </td>
                                <td colspan="3" class="<?php echo $ss;?>">
                                    <input value="<?php echo cls_codes::getFullCode_Name(105,$model->school_place,3)?>" id="txtPlacelbl" class="form-control " placeholder="العنوان" size="60" maxlength="100" style=""  type="text" readonly/>
                                    <?php                                    
                                   
                                         echo "<div id='txt".$attr ."lbl'></div>";//CHtml::label( 'dfsdf','txt'.$attr.'lbl', array('id'=>'txt'.$attr.'lbl'));
                                        //echo $form->textField($model, $attr, array('id'=>'txt'.$attr));//,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                                    echo $form->hiddenField($model, $attr,array('id'=>'txt'.$attr));
                                            //if($model->isAttributeRequired($attr)) echo '*';
                                      //echo $form->textField($model, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' )); 
                                        ?> 
                                
                                </td>

                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                    <div id='dialogBoxLaunchIconPosition' style="margin-top: 10px;">

                                    <?php cls_DialogBox::createDialogBox(
                                                                $this
                                                               ,''
                                                               ,'btn green icon-edit'
                                                               ,"Place"
                                                               ,"العنوان"
                                                               ,CController::createAbsoluteUrl('Codes/Place')//"Codes/Place"
                                                               ,'txtPlacelbl'
                                                               ,'txt'.$attr
                                                               ,"icon-reorder"
                                                               ,330,300
                                                            ); 
                                    
                                    
                                    
                                    ?>

                                </td>
                            </tr>
                            <tr>
                                <td width="100"><?php $attr='school_street';
                                    echo $form->labelEx($model, $attr); ?> </td>
                                <td >
                                    <?php                                    
                                    $ss='';
                                    if(strlen($model->getError($attr))>0) $ss=' validationError';
                                        echo $form->textField($model, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                                    //if($model->isAttributeRequired($attr)) echo '*';
                                        ?> 
                                
                                </td>
                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                                 <td width="100"><?php $attr='school_pobox';
                                    echo $form->labelEx($model, $attr); ?> </td>
                                <td >
                                    <?php                                    
                                    $ss='';
                                    if(strlen($model->getError($attr))>0) $ss=' validationError';
                                        echo $form->textField($model, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                                    //if($model->isAttributeRequired($attr)) echo '*';
                                        ?> 
                                
                                </td>
                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                            </tr>
                            
                            <tr>
                                <td width="100"><?php $attr='school_phone';
                                    echo $form->labelEx($model, $attr); ?> </td>
                                <td >
                                    <?php                                    
                                    $ss='';
                                    if(strlen($model->getError($attr))>0) $ss=' validationError';
                                        echo $form->textField($model, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                                    //if($model->isAttributeRequired($attr)) echo '*';
                                        ?> 
                                
                                </td>
                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                                 <td width="100"><?php $attr='school_extraphone';
                                    echo $form->labelEx($model, $attr); ?> </td>
                                <td >
                                    <?php                                    
                                    $ss='';
                                    if(strlen($model->getError($attr))>0) $ss=' validationError';
                                        echo $form->textField($model, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                                    //if($model->isAttributeRequired($attr)) echo '*';
                                        ?> 
                                
                                </td>
                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                            </tr>
                            <tr>
                                <td width="100"><?php $attr='school_email';
                                    echo $form->labelEx($model, $attr); ?> </td>
                                <td >
                                    <?php                                    
                                    $ss='';
                                    if(strlen($model->getError($attr))>0) $ss=' validationError';
                                        echo $form->textField($model, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                                    //if($model->isAttributeRequired($attr)) echo '*';
                                        ?> 
                                
                                </td>
                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                                <td width="100"><?php $attr='school_fax';
                                    echo $form->labelEx($model, $attr); ?> </td>
                                <td >
                                    <?php                                    
                                    $ss='';
                                    if(strlen($model->getError($attr))>0) $ss=' validationError';
                                        echo $form->textField($model, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                                    //if($model->isAttributeRequired($attr)) echo '*';
                                        ?> 
                                
                                </td>
                                <td>
                                    <?php if(School::isRequiredFor($enmSchoolType,$attr)) echo '*';?> 
                                </td>
                            </tr>



                        </table>
                    </div>
                </div>
                    
                    <script> $('.chosen-select').chosen({no_results_text: "لا يوجد نتيجة!"});
                        //document.getElementById()('cbschool_country').chosen();
                    </script>

