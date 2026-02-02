<?php
/* @var $this MbInfoAdminController */
/* @var $model MbInfoAdmin */
/* @var $form CActiveForm */
?>
<h1> تعديل صلاحيات الحكم: <?php echo $name ?></h1>
<div class="form">

    <?php
    $strIndex='';
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mb-info-admin-form',
        'enableAjaxValidation' => true,
    ));
    ?>

    <!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

    
    <div class="row">
        
        <div class="col-md-4 ">
            <a class='btn btn-warning btn-block' href="<?php echo Yii::app()->request->urlReferrer; ?>" style="text-decoration: none;">
                      <i class="icon-arrow-right"></i> رجوع
            </a>
        </div>
        <div class="col-md-4 ">
            <?php echo CHtml::submitButton( 'حفظ', array('class' => 'btn purple btn-block')); ?>
            <br>
        </div>
        </div>
    <!--
<div >
        <table>
 <tr> <td>

                        <b>  <?php //$attr='judge_stage'; echo $jud->getAttributeLabel($attr);
                        ?></b>

                      </td> 

                    <td>

                        <?php

                            //$ss='';

                            //if(strlen($jud->getError($attr))>0) $ss=' validationError';

                           // $records = cls_codes::getCodes_ByCodeKind(104);

                                  //  $records = cls_codes::getCodes_ByCodeKindQuery(106,'length(code_no)=2');

                          //  $list = CHtml::listData($records, 'code_no', 'code_name');

                           // echo $form->dropDownList($jud, $strIndex.$attr, $list, array('id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control'.$ss));//, 'class' => 'list_small'));

                            //echo $form->textField($std, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $oteach->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?> 

                    </td>

                    <td><?php 

                            //if($jud->isAttributeRequired($attr)) echo '*';
                            ?> 

                    </td>

                 </tr>
            
           
        </table>
    


<div></div> -->
<br><br>
        <div class="portlet-body" >
<div class="note note-success">
                <p>
                  الفئات المشارك فيها

                </p>
    </div>
             <div class = "row">  
            <div class="col-md-5">
            <table class="table table-bordered table-striped">
                <thead>
                <th> الفئة</th>
                <th> مشارك</th>
                <th> نواة</th>
                <th> المرحلة</th>
                </thead>
                <tbody>
                    <?php
                    $counter=0;
                    $records = cls_codes::getCodes_ByCodeKind(104);
                    $records = cls_codes::getCodes_ByCodeKindQuery(106,'length(code_no)=2');
                    $list = CHtml::listData($records, 'code_no', 'code_name');
                    foreach ($jts as $jt) {

                        ?>

                        <tr>
                            <td>

                                <?php
                                if ($jt['code_name'] != NULL)
                                    echo $jt['code_name'] ;
                                else
                                    echo "...";
                                ?>
                            </td>

                            <td >
                                <?php
                                if ($jt['type_enable'] == 1) {
                                    $cl = "green";
                                    $clt = "نعم"; 
                                } else {
                                    $cl = "red";
                                    $clt = "كلا";
                                }
                                $path = "Personjudge/TypeEnable";
                                ?>


                                <div <?php echo "id=\"tp". $jt['judetype_id'] ."\""
                                ?>>
                                <?php echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                , array('update' => '#tp'.$jt['judetype_id'], 'data' => array('judetype_id' => $jt['judetype_id'],'code_enable'=>$jt['type_enable'],'tp'=>'1')
                                                    )); ?>
                                </div>
                            </td>
                            
                            <td >
                                <?php
                                if ($jt['type_kernel'] == 1) {
                                    $cl = "green";
                                    $clt = "نعم"; 
                                } else {
                                    $cl = "red";
                                    $clt = "كلا";
                                }
                                $path = "Personjudge/TypeEnable";
                                ?>


                                <div <?php echo "id=\"kr". $jt['judetype_id'] ."\""
                                ?>>
                                <?php echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                , array('update' => '#kr'.$jt['judetype_id'], 'data' => array('judetype_id' => $jt['judetype_id'],'code_enable'=>$jt['type_kernel'],'tp'=>'2')
                                                    )); ?>
                                </div>
                            </td>
                            <td>
                                <?php
                                 //$list = CHtml::listData($records, 'code_no', 'code_name');

                                    echo CHtml::dropDownList('judge_type['.$counter.'][judge_stage]', $jt['judge_stage'], $list, array('id'=>'cb'.$counter,'empty' => 'إختر','class' => 'form-control'));
                                    
                            ?>
                                 <input type = hidden name="<?php echo 'judge_type['.$counter.'][judetype_id]' ?>" id="'.$this->name.'H" value="<?php echo $jt['judetype_id'] ?>">
                            </td>

                        </tr>
                    <?php $counter++;} ?>
                </tbody>
            </table>

            </div>

                </div>
        </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->