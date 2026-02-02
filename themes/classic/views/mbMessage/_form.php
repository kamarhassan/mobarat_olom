<?php
/* @var $this MbMessageController */
/* @var $model MbMessage */
/* @var $form CActiveForm */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mb-message-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="note">جميع الخانات التي بجانبها <span class="required">*</span> ضرورية لإكمال عملية الإرسال.</p>

<?php if($form->error($model, 'to') || $form->error($model, 'message_content') || $form->error($model, 'message_subject')) { ?>
<div class='alert alert-danger'>
    <?php echo $form->error($model, 'to'); ?>
    <?php echo $form->error($model, 'message_content'); ?>
    <?php echo $form->error($model, 'message_subject'); ?>
</div>
<?php } ?>

<form action="#" class="horizontal-form">
    <div class="row">
        <div class="col-md-6">
            <h3 class="form-section">إنشاء رسالة</h3>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'to', array('class' => "control-label")); ?>
                <?php echo $form->dropDownList($model, 'to', $list, array('empty' => 'اختر وجهة الرسالة', 'class' => 'form-control'));
                ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'message_subject', array('class' => "control-label")); ?>
                <?php echo $form->textField($model, 'message_subject', array('size' => 60, 'maxlength' => 100, 'class' => "form-control col-md-12")); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'message_content', array('class' => "control-label")); ?>
                <?php echo $form->textArea($model, 'message_content', array('rows' => 6, 'cols' => 50, 'class' => "form-control col-md-12")); ?>
            </div>
            <div class="margin-top-10">
                <?php
                echo CHtml::submitButton('إرسال',  array('class' => 'btn blue','confirm'=>'هل أنت متأكد من إرسال الرسالة؟'), '<i class="icon-ok"></i> ');
                echo CHtml::resetButton('مسح',  array('class' => 'btn btn-danger'), '<i class="icon-cut"></i> مسح الكل');
                ?>
            </div>
            </form>
        </div>
    </div>

    <!--	<div class="row">
    <?php // echo $form->labelEx($model,'message_date'); ?>
    <?php // echo $form->textField($model,'message_date');  ?>
    <?php // echo $form->error($model,'message_date');  ?>
            </div>-->

    <div class="row buttons">
        <?php // echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->