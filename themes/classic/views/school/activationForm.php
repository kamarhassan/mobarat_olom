<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mb-school-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));

 $icon = "icon-ok";
?>


<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-6 ">

        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> إنهاء التسجيل
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>

                </div>

            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <?php
                    if($st=="has-error"){
                        echo "كود التأكيد المدخل غير صحيح! ";
                        $icon = "icon-remove";
                    }
                    
                    else
                       if($st != " ") {
                        echo "كود التأكيد صحيح";
                        $icon = "icon-ok";
                        $d="disabled";
                    }
                        ?>
                            <div class="input-icon right input-large margin-top-10 <?php echo $st; ?>">
                                <i class="<?php echo $icon; ?>"></i>
                                <?php echo CHtml::textField('confCode', '', array('class' => 'form-control', 'placeholder' => 'أدخل كود التأكيد', 'size' => 60, 'maxlength' => 100)); ?>

                    </div>
                </div>
                <div class="form-actions">
                <?php echo CHtml::submitButton( 'تأكيد' , array('class' => 'btn red btn-block')); ?>

            </div>
            </div>


            

        </div>
    </div>


    <?php $this->endWidget(); ?>
