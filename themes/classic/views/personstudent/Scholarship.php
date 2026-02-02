<?php
/* @var $this MbProjectController */
/* @var $model MbProject */
/* @var $form CActiveForm */
?>
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<!--
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-nestable/jquery.nestable.js"></script>

<script src="<?php echo $baseUrl; ?>/assets/scripts/ui-nestable.js"></script>
!-->
<script>

    function chgiveup_onchange(ch){
       // alert('2323');
      // ch=document.getElementById('chgiveup')
       //ch=$('#chgiveup');
        if(ch.checked){
            $('#div_other').fadeOut('slow');
            $('#div_giveup_why').fadeIn('slow');
            
        }
        else{
            $('#div_giveup_why').fadeOut('slow');
            $('#div_other').fadeIn('slow');
        }
    }
    
    function chgiveup_ready(){
       // alert('2323');
       ch=document.getElementById('chgiveup')
       //ch=$('#chgiveup');
        if(ch.checked){
            $('#div_giveup_why').show();
            $('#div_other').hide();
        }
        else{
            $('#div_giveup_why').hide();
            $('#div_other').show();
        }
    }
</script>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'scholarship-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    ));
    ?>

   

    <?php
    echo "

<div class='alert alert-danger'>";
    /*echo $form->error($model, 'project_name');
    echo $form->error($model, 'project_type');
    echo $form->error($model, 'project_stage');*/


    echo "</div>";
    ?>

</div>

<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-6 ">
        <div class="col-md-4 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->

            <a class='btn btn-warning btn-block' href="<?php echo Yii::app()->request->urlReferrer; ?>" style="text-decoration: none;">
                <?php
                //echo CHtml::tag('button', array('class' => 'btn btn-warning btn-block'), '<i class="icon-arrow-right"></i> رجوع');
                ?>
                <i class="icon-arrow-right"></i> رجوع
            </a>


        </div>

      <div class="col-md-4 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            
            <br>
        </div>

        <div class="col-md-4 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <?php echo CHtml::submitButton( 'Submit', array('class' => 'btn purple btn-block')); ?>
            <br>
        </div>

        <p class="note">جميع الخانات التي بجانبها <span class="required">*</span> ضرورية .</p>
        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> منحة جامعية
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>

                </div>


            </div>
            <div class="portlet-body form">

                <div class="form-body">
                    <div class="form-group">
                        
                        <?php echo $form->checkBox($model, 'giveup', array('id'=>'chgiveup','value'=>1,'uncheckvalue'=>0, 'size' => 1, 'maxlength' => 1,'onchange'=>'chgiveup_onchange(this)')); 
                        //echo CHtml::checkBox( 'chgiveup',$model['giveup'], array('id'=>'chgiveup')); 
                        ?>
                       <!--<input type='checkbox' name='chgiveup' id='chgiveup' class = 'form-control'/>-->
                        <?php echo $form->labelEx($model, 'giveup'); ?>
                    </div>
                    
                    <div class="form-group" id='div_giveup_why'>
                        <?php echo $form->labelEx($model, 'giveup_why'); ?>
                        <?php echo $form->textArea($model, 'giveup_why', array('class' => 'form-control', 'size' => 60, 'maxlength' => 500, 'id' => 'txtAreaDescription' )); ?>
                    </div>
                    <div id='div_other'>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'phone_house'); ?>
                            <?php echo $form->textField($model, 'phone_house', array('class' => 'form-control',  'maxlength' => 45)); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'phone_guardian'); ?>
                            <?php echo $form->textField($model, 'phone_guardian', array('class' => 'form-control',  'maxlength' => 45)); ?>
                        </div>
                         <?php 
                            if ($std['student_class'] != null){
                                $cls= substr($std['student_class'], 0,2);

                             if($cls=='07'){       
                        ?>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'nomination_number'); ?>
                            <?php echo $form->textField($model, 'nomination_number', array('class' => 'form-control',  'maxlength' => 45)); ?>
                        </div>

                        <?php } if($cls== '05' || $cls=='06' || $cls=='07'){ 
                                    if($cls== '05'){
                                        $records =  cls_codes::getCodes_ByCodeKindQuery(104,"code_no like '" . $cls ."%'");
                                    }else if( $cls=='06' || $cls=='07'){
                                        $records =  cls_codes::getCodes_ByCodeKindQuery(104,"length(code_no)>2 and code_no like '" . $cls ."%'");
                                    }
                                 ?>
                        <div class="form-group">
                            <?php
                            echo $form->labelEx($model, 'student_class');

                            $list = CHtml::listData($records, 'code_no', 'code_name');
                            echo $form->dropDownList($model, 'student_class', $list, array('empty' => 'اختر الصف', 'class' => 'form-control'));
                           ?>
                        </div>

                        <?php 
                            }


                        }
                        ?>


                        <div class="form-group">
                            <?php
                            echo $form->labelEx($model, 'university');
                            $records = cls_codes::getCodes_ByCodeKind(113);
                            $list = CHtml::listData($records, 'code_no', 'code_name');
                            echo $form->dropDownList($model, 'university', $list, array('empty' => 'اختر الجامعة', 'class' => 'form-control'));
                            ?>
                        </div>

                        <div class="form-group">

                            <?php echo $form->checkbox($model, 'agree_lot', array('id'=>'chagree_lot','value'=>1,'uncheckvalue'=>0, 'size' => 1, 'maxlength' => 1)); 
                            ?>
                            <?php echo $form->labelEx($model, 'agree_lot'); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'Major'); ?>
                            <?php echo $form->textField($model, 'Major', array('class' => 'form-control',  'maxlength' => 45)); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'notes'); ?>
                            <?php echo $form->textArea($model, 'notes', array('class' => 'form-control', 'size' => 60, 'maxlength' => 500, 'id' => 'txtAreaDescription' )); ?>
                        </div>
                         <div class="form-group">

                            <?php echo $form->checkbox($model, 'assue_information', array(''=>'ch_assue','value'=>1,'uncheckvalue'=>0, 'size' => 1, 'maxlength' => 1)); 
                            ?>
                            <?php echo $form->labelEx($model, 'assue_information'); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'id_attachment');?>
                            <input type='file' name='file'  accept = '.pdf,.zip,.rar' maxlength = "1" id = 'upload_id' onchange='handleFiles(this.files)'/>
                            <?php echo $model->id_attachment;?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'Grade_attachment');?>
                            <input type='file' name='file_grade'  accept = '.pdf,.zip,.rar' maxlength = "1" id = 'upload_grade' onchange='handleFiles(this.files)'/>
                            <?php echo $model->Grade_attachment;?>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <!-- BEGIN SAMPLE FORM PORTLET-->

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<?php $this->endWidget(); ?>
<script>
   
var inputElement = document.getElementById("upload_id");
inputElement.addEventListener("change", handleFiles, false);

var inputElement1 = document.getElementById("upload_grade");
inputElement1.addEventListener("upload_grade", handleFiles, false);

function handleFiles() {
  var str =this.files[0].name ;
   //alert(str);
   var ext = str.substr(str.lastIndexOf(".") + 1);
   //alert(ext);
  if (!(ext=="pdf" || ext== "rar" || ext=="zip"))
  {
      this.files=null;
       alert("Only pdf, rar and zip accepted" ); /* now you can work with the file list */
  }
    //else
      
}
</script>
<?php
        Yii::app()->clientScript->registerScript('scid','$(document).ready(function(){chgiveup_ready();});',CClientScript::POS_LOAD);

    ?>

