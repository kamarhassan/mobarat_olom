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

    <!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

<div >

<div></div>
<br><br>
        <div class="portlet-body" >
<div class="note note-success">
                <p>
                  الايام المتاحة
                </p>
    </div>
             <div class = "row">  
            <div class="col-md-3">
            <table class="table table-bordered table-striped">
               
                <tbody>
                    <?php
                    foreach ($day_codes as $prj) {

                        ?>

                        <tr>
                            <td>

                                <?php
                                if ($prj['code_name'] != NULL)
                                    echo $prj['code_name'] ;
                                else
                                    echo "...";
                                ?>
                            </td>

                            <td >
                                <?php

                                if ($prj['code_Enable'] == 1) {

                                    $cl = "green";
                                    $clt = "نعم";
                                    $path = "Mobarat/CodeEnable";
                                } else {
                                    $cl = "red";
                                    $clt = "كلا";
                                    $path = "Mobarat/CodeEnable";
                                }
                                ?>


                                <div <?php echo "id=\"sp". $prj['id'] ."\""
                                ?>>
                                <?php echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                , array('update' => '#sp'.$prj['id'], 'data' => array('code_id' => $prj['id'],'code_enable'=>$prj['code_Enable'])
                                                    )); ?>
</div>



                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            </div>

                </div>
        </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->