<?php
/* @var $this MbInfoAdminController */
/* @var $model MbInfoAdmin */
/* @var $form CActiveForm */
?>
    <h3 class="page-title">
    صفحة إعدادات التحكيم لسنة <?php
    $clsPerson=Yii::app()->session['clsPerson'] ;
    echo $mobarat['mobarat_year'];
    ?>
    </h3>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mb-info-admin-form',
        'enableAjaxValidation' => true,
    ));
    ?>
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
    <!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

    <div >
        <?php
            $des=array('','','');
            $path = "Mobarat/CodeEnable";
            $index=0;
            foreach ($day_codes as $prj) {
                if($prj['code_kind']==118)
                    $index=0;
                elseif($prj['code_kind']==119) 
                    $index=1;
                else
                    $index=2;
                
                $des[$index] .="<tr><td>";
                if ($prj['code_name'] != NULL)
                    $des[$index] .= $prj['code_name'] ;
                else
                    $des[$index] .= "...";
                $des[$index] .=' </td><td >';
                if ($prj['code_Enable'] == 1) {
                    $cl = "green";
                    $clt = "نعم";           
                } else {
                    $cl = "red";
                    $clt = "كلا";
                }
                $des[$index] .="<div id=\"sp". $prj['id'] ."\">";
                $des[$index] .= CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                    , array('update' => '#sp'.$prj['id'], 'data' => array('code_id' => $prj['id'],'code_enable'=>$prj['code_Enable'])
                                                        )); 
                $des[$index] .="</div></td></tr>";
            }
        ?>
    </div>
    <div></div>
    <br><br>
    <div class="portlet-body" >

        <div class = "row">  
            
            <div class="col-md-3">
                <div class="note note-success">
                <p>
                  الايام المتاحة
                </p>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                       <?php  echo $des[0]; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <table class="table table-bordered table-striped">
                    <div class="note note-success">
                    <p>
                      معايير التحكيم
                        <a class="more" href="<?php echo $this->createAbsoluteUrl('Mobarat/Mobaratfactorupdate/'.$mobarat['mobarat_year']); ?>">
                    تعديل القيم      <i class="m-icon-swapleft m-icon-white"></i>
                        </a>
                    </p>
                    </div>
                    <tbody>
                       <?php  echo $des[1]; ?>
                    </tbody>
                </table>

            </div>
            <div class="col-md-3">
                <div class="note note-success">
                <p>
                  جوائز إضافية
                </p>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                       <?php  echo $des[2]; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <div class="note note-success">
                <p>
                  متفرقات
                </p>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                            <tr>
                                <td width="120" >

                                <?php
                                    $attr='enablejudgeday';
                                    echo $form->checkBox($mobarat, $attr);
                                    echo '  ';
                                    echo $form->label($mobarat, $attr);
                                    
                                ?></td>
                            <td >
                                 <?php 
                                    $attr='enablejudgedaycode_no';
                                    $records = cls_codes::getCodes_ByCodeKindQuery(118,' length(code_no)=2');
                                    $list = CHtml::listData($records, 'code_no', 'code_name');
                                    echo $form->dropDownList($mobarat, $attr, $list, array('data-placeholder'=>'إختر','id'=>'cb'.$attr,'empty' => 'إختر','class' => 'form-control chosen-select' ));
                                 ?>
                            </td>
                            </tr>
                            
                    </tbody>
                </table>
            </div>
                 
        </div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->