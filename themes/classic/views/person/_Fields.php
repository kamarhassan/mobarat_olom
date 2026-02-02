
<?php
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');

$myScript=Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components').'/attachment.js');
//http://www.yiiframework.com/doc/api/1.1/CAssetManager#publish-detail

$cs->registerScriptFile($myScript, CClientScript::POS_HEAD);


/* 

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */?>



<?php 

    $strIndex='';

    if (isset($modelIndex))

        //if($modelIndex>0)

             $strIndex='['. $modelIndex.']';

         else {

             $modelIndex='';

        }

        

   // $strIndex='';

?>



<script>


    function InitPage()

    {

        var modelIndex=<?php echo json_encode($modelIndex); ?>;

        InitPictureControls('prs_photoName'+ modelIndex,'prs_photoNameBtn' + modelIndex,'prs_photoNamePreview'+modelIndex);

    }

</script>

<div class="portlet box green">



    <div class="portlet-title">

        <div class="caption">

            <i class="icon-reorder"></i> 

            <?php 

            if(isset($title))

                echo $title;

            else 

                echo"...";

            ?>

        </div>



    </div>

    <div class="portlet-body form">



        <div class="form-body">

            <table width="600px">

                <tr>

                    <td width="100px"> <b> الإسم الثلاثي</b> </td>
<?php /*ECHO $_SERVER['HTTP_REFERER'];*/ ?>


                    <td width="150px">

                        <?php $attr='Person_fname';$ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($model, $strIndex.$attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?>

                    </td>

                    <td width="15px">

                        <?php if(Person::isRequiredFor($enmPersonType,$attr)) echo '*';?> 

                    </td>

                    <td width="150px">

                         <?php $attr='Person_mname';$ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($model, $strIndex.$attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?>



                    </td>

                    <td  width="15px"><?php 

                            if(Person::isRequiredFor($enmPersonType,$attr)) echo '*';?> 

                    </td>

                    <td width="150px">

                        <?php $attr='Person_lname';$ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($model, $strIndex.$attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?>

                    </td>

                     <td  width="15px"><?php 

                            if(Person::isRequiredFor($enmPersonType,$attr)) echo '*';?> 

                    </td>

                </tr>

                <tr>

                    <td width="100px"> <b> الإسم بالأنكليزي</b> </td>

                    <td>

                        <?php $attr='person_efname';$ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($model, $strIndex.$attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?>

                    </td>

                    <td><?php 

                            if(Person::isRequiredFor($enmPersonType,$attr)) echo '*';

                            ?> 

                    </td>

                    <td>

                         <?php $attr='person_emname';$ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($model, $strIndex.$attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?>



                    </td>

                    <td><?php 

                            if(Person::isRequiredFor($enmPersonType,$attr)) echo '*';?> 

                    </td>

                    <td>

                        <?php $attr='person_elname';$ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($model, $strIndex.$attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?>

                    </td>

                     <td><?php 

                            if(Person::isRequiredFor($enmPersonType,$attr)) echo '*';?> 

                    </td>



                </tr>

                <tr>

                    <td>

                        <?php $attr='Person_Salutation';

                         echo $form->labelEx($model, $attr);?></td> 

                    </td>

                    <td>

                        <?php

                            $ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            $records = cls_codes::getCodes_ByCodeKind(102);

                            $list = CHtml::listData($records, 'code_no', 'code_name');

                            echo $form->dropDownList($model, $strIndex.$attr, $list, array('id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control'.$ss));//, 'class' => 'list_small'));

                        ?> 

                    </td>

                    <td><?php 

                            if(Person::isRequiredFor($enmPersonType,$attr)) echo '*';?> 

                    </td>

                        <?php

                            $attr='Person_sex';

                            $ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';?>

                    <td colspan="2"<?php if (strlen($ss)>0) echo 'class="'.$ss.'"'?>>

                        <div class="">

                            

                    <?php echo CHtml::activeRadioButton($model, $strIndex.$attr, array('value' => '01', 'uncheckValue' => null, 'style' => 'float: none;margin-right: 0px;','class' => $ss)); echo"\t\t";

                    ?>ذكر

                    <?php echo CHtml::activeRadioButton($model, $strIndex.$attr, array('value' => '02', 'uncheckValue' => null, 'style' => 'float: none;margin-right: 0px;','class' => $ss)); echo"\t\t";

                    ?>أنثى



                </div> 

                    </td>

                    <td colspan="2" rowspan="4">

                        <div>

                 <?php

                               //$cls1=new cls_attach();

                               $bolExists=true;

                               $PicUrl= cls_attach::getPictureURL(enm_Program::PERSON,$model->Person_id,$model['Person_pic'],$bolExists);

                            ?>

                            <input id="<?php echo 'prs_photoName'.$modelIndex ?>" name="<?php echo 'prs_photoName'.$modelIndex?>" type="file" accept="image/*"/>

                            <img id="<?php echo 'prs_photoNamePreview'.$modelIndex ?>" class="sa-picture" name=""<?php echo 'prs_photoNamePreview'.$modelIndex?>"  

                               src=<?php echo "'".$PicUrl."' "; if($bolExists) echo "?cache=".  date("y/m/d h:i:sa")."'";?>/>

                            <input type="button" class="sa-btn sa-fill" id="<?php echo 'prs_photoNameBtn'.$modelIndex?>" value=<?php if ($bolExists) {

                                echo "'تعديل الصورة'";

                            } else

                                echo "'إضافة صورة'";

                            ?> />

                            <div>

                                <?php

                                

                                    echo $model->getError('Person_pic');

                                ?>

                            </div>



            </div>

                    </td>

                </tr>

                <tr>

                    <td>

                        <?php $attr='Person_email1';

                         echo $form->labelEx($model, $attr);?></td> 

                    </td>

                    <td colspan="3">

                        <?php

                            $ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($model, $strIndex.$attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?> 

                    </td>

                    <td><?php 

                            if(Person::isRequiredFor($enmPersonType,$attr)) echo '*';?> 

                    </td>
</tr>

    
                    <?php

                        if(isset($jud)){

                            ?>
<tr>
      <td>

                        <?php $attr='Person_email2';

                         echo $form->labelEx($model, $attr);?></td> 

                    </td>
                             <td colspan="3">

                        <?php

                         

                            $ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($model, $strIndex.$attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?> 

                    </td>

                    <td><?php 

                            if(Person::isRequiredFor($enmPersonType,$attr)) echo '*';?> 

                    </td>
</tr>

                    <?php

                        }

                    ?>


                <tr>

                    <td>

                        <?php $attr='Person_CellPhone';

                         echo $form->labelEx($model, $attr);?></td> 

                    </td>

                    <td>

                        <?php

                            $ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($model, $strIndex.$attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?> 

                    </td>

                    <td><?php 

                            if(Person::isRequiredFor($enmPersonType,$attr)) echo '*';?> 

                    </td>

                </tr>

                <?php if(isset($oteach)) 

                {  

                ?>

                 <tr> <td>

                        <b>  <?php $attr='oteacher_description'; echo $oteach->getAttributeLabel($attr);?></b>

                      </td> 

                      <td colspan="3">

                        <?php

                            $ss='';

                            if(strlen($oteach->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($oteach, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $oteach->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?> 

                    </td>

                    <td><?php 

                            if($oteach->isAttributeRequired($attr)) echo '*';?> 

                    </td>

                </tr>

                <?php } 

                    else if(isset($teach)) 

                {  

                ?>

                 <tr> <td>

                        <b>  <?php $attr='teacher_levelStudy'; echo $teach->getAttributeLabel($attr);?></b>

                      </td> 

                    <td>

                        <?php

                            $ss='';

                            if(strlen($teach->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($teach, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $teach->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?> 

                    </td>

                    <td><?php 

                            if($teach->isAttributeRequired($attr)) echo '*';?> 

                    </td>

                </tr>

                <?php } 

                    else if(isset($std)) 

                {  

                ?>

                 <tr> <td>

                        <b>  <?php $attr='student_class'; echo $std->getAttributeLabel($attr);?></b>

                      </td> 

                    <td>

                        <?php

                            $ss='';

                            if(strlen($std->getError($attr))>0) $ss=' validationError';

                           // $records = cls_codes::getCodes_ByCodeKind(104);

                                    $records = cls_codes::getCodes_ByCodeKindQuery(104,'length(code_no)=2');

                            $list = CHtml::listData($records, 'code_no', 'code_name');

                            echo $form->dropDownList($std, $strIndex.$attr, $list, array('id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control'.$ss));//, 'class' => 'list_small'));

                            //echo $form->textField($std, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $oteach->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?> 

                    </td>

                    <td><?php 

                            if($std->isAttributeRequired($attr)) echo '*';?> 

                    </td>

                </tr>

                <?php }
                    elseif(isset($jud)){
                ?>
                <tr>
                    <td><b>  <?php $attr='Person_Phone'; echo $model->getAttributeLabel($attr);?></b></td> 
                    <td>
                        <?php
                            $ss='';
                            if(strlen($model->getError($attr))>0) $ss=' validationError';
                            echo $form->textField($model, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                        ?> 
                    </td>
                    <td><?php if($jud->isAttributeRequired($attr)) echo '*';?> </td>
                </tr>
                <tr> 
                    <td><b>  <?php $attr='judge_speciality1'; echo $jud->getAttributeLabel($attr);?></b></td> 
                    <td>
                        <?php
                            $ss='';
                            if(strlen($jud->getError($attr))>0) $ss=' validationError';
                            $records = cls_codes::getCodes_ByCodeKindQuery(115,'length(code_no)=2');
                            $list = CHtml::listData($records, 'code_no', 'code_name');
                            echo $form->dropDownList($jud, $strIndex.$attr, $list, array('id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control'.$ss));//, 'class' => 'list_small'));
                        ?> 
                    </td>
                    <td><?php if($jud->isAttributeRequired($attr)) echo '*';?> </td>
                    <td><b>  <?php $attr='judge_degree1'; echo $jud->getAttributeLabel($attr);?></b></td> 
                    <td colspan="2">
                        <?php
                            $ss='';
                            if(strlen($jud->getError($attr))>0) $ss=' validationError';
                            $records = cls_codes::getCodes_ByCodeKindQuery(116,'length(code_no)=2');
                            $list = CHtml::listData($records, 'code_no', 'code_name');
                            echo $form->dropDownList($jud, $strIndex.$attr, $list, array('id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control'.$ss));//, 'class' => 'list_small'));
                        ?> 
                    </td>
                    <td><?php if($jud->isAttributeRequired($attr)) echo '*';?> </td>
                </tr>
                <tr>
                    <td> <b>  <?php $attr='judge_speciality2'; echo $jud->getAttributeLabel($attr);?></b></td> 
                    <td>
                        <?php
                            $ss='';
                            if(strlen($jud->getError($attr))>0) $ss=' validationError';
                            $records = cls_codes::getCodes_ByCodeKindQuery(115,'length(code_no)=2');
                            $list = CHtml::listData($records, 'code_no', 'code_name');
                            echo $form->dropDownList($jud, $strIndex.$attr, $list, array('id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control'.$ss));//, 'class' => 'list_small'));
                        ?> 
                    </td>

                    <td><?php if($jud->isAttributeRequired($attr)) echo '*';?> </td>
                    <td><b>  <?php $attr='judge_degree2'; echo $jud->getAttributeLabel($attr);?></b></td> 
                    <td colspan="2">
                        <?php
                            $ss='';
                            if(strlen($jud->getError($attr))>0) $ss=' validationError';
                            $records = cls_codes::getCodes_ByCodeKindQuery(116,'length(code_no)=2');
                            $list = CHtml::listData($records, 'code_no', 'code_name');
                            echo $form->dropDownList($jud, $strIndex.$attr, $list, array('id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control'.$ss));//, 'class' => 'list_small'));
                        ?> 
                    </td>
                    <td><?php if($jud->isAttributeRequired($attr)) echo '*';?>  </td>
                </tr>

                <tr>
                    <td><b>  <?php $attr='judge_institute'; echo $jud->getAttributeLabel($attr);?></b></td> 
                    <td>
                        <?php
                            $ss='';
                            if(strlen($jud->getError($attr))>0) $ss=' validationError';
                            echo $form->textField($jud, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $jud->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                        ?> 
                    </td>
                    <td><?php if($jud->isAttributeRequired($attr)) echo '*';?> </td>
                    <td><b>  <?php $attr='judge_job'; echo $jud->getAttributeLabel($attr);?></b></td> 
                    <td colspan="2">
                        <?php
                            $ss='';
                            if(strlen($jud->getError($attr))>0) $ss=' validationError';
                            echo $form->textField($jud, $attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $jud->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 
                        ?> 
                    </td>
                    <td><?php if($jud->isAttributeRequired($attr)) echo '*';?> </td>
                </tr>
<!--
                 <tr> 
                    <td> <b>  <?php $attr='judge_stage'; echo $jud->getAttributeLabel($attr);?></b> </td> 
                    <td> 
                        <?php
                            $ss='';
                            if(strlen($jud->getError($attr))>0) $ss=' validationError';
                            $records = cls_codes::getCodes_ByCodeKindQuery(106,'length(code_no)=2');
                            $list = CHtml::listData($records, 'code_no', 'code_name');
                            echo $form->dropDownList($jud, $strIndex.$attr, $list, array('id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control'.$ss));//, 'class' => 'list_small'));
                        ?> 
                    </td>
                    <td>
                        <?php if($jud->isAttributeRequired($attr)) echo '*';?> 
                    </td>
                 </tr>
-->
                <?php

                }

                ?>
  <tr>

                    <td>

                        <?php $attr='person_description';

                         echo $form->labelEx($model, $attr);?></td> 

                    </td>

                    <td colspan="5">

                        <?php

                            $ss='';//echo $form->error($model, 'Person_fname');

                            if(strlen($model->getError($attr))>0) $ss=' validationError';

                            echo $form->textField($model, $strIndex.$attr, array('id'=>'txt'.$attr,'class' => 'form-control ' . $ss, 'placeholder' => $model->getAttributeLabel($attr), 'size' => 60, 'maxlength' => 100,'style'=> $ss)); 

                        ?> 

                    </td>

                </tr>


            </table>
        </div>
    </div>
    
    <!-- Commented 18/08/2020 Sirine Taleb
    <?php if(isset($judselect)){ ?>
    
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> 
                    تحديد الاوقات
                </div>
            </div>

            <div class="portlet-body form">
                <div class="form-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <th> التوقيت</th>
                    <th> مشارك</th>
                    </thead>
                    <tbody>
                        <?php foreach ($judselect as $jt) {?>
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
                                    if ($jt['select_enable'] == 1) {
                                        $cl = "green";
                                        $clt = "نعم"; 
                                    } else {
                                        $cl = "red";
                                        $clt = "كلا";
                                    }
                                    $path = "Personjudge/SelectEnable";
                                    ?>


                                    <div <?php echo "id=\"tp". $jt['judgeselecting_id'] ."\""
                                    ?>>
                                    <?php echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                    , array('update' => '#tp'.$jt['judgeselecting_id'], 'data' => array('judgeselecting_id' => $jt['judgeselecting_id'],'person_id'=>$jt['person_id'],'code_enable'=>$jt['select_enable'])
                                                        )); ?>
                                    </div>
                                </td>

                            </tr>
                        <?php } ?>
                            <tr><td>الحفل الختامي</td>
                                <td>
                                     <div  id="tpEvening">
                                         <?php
                                    if ($jud['eveningparticipat'] == 1) {
                                        $cl = "green";
                                        $clt = "نعم"; 
                                    } else {
                                        $cl = "red";
                                        $clt = "كلا";
                                    }
                                    $path = "Personjudge/SetEvening";
                                    ?>
                                     <?php echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                    , array('update' => '#tpEvening', 'data' => array('judge_id' => $jud['judge_id'],'person_id'=>$jud['judge_personid'],'eveningparticipat'=>$jud['eveningparticipat'])
                                                        )); ?>
                                        </div>
                                </td></tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    <?php } ?>
    -->
</div>



<script>

    

   

    InitPage();



</script>



