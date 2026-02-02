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
<?php 
    $current= Mobarat::getOpenMobaratRecord();
    $records = School::model()->findAll('school_id in (select school_id from mobarat_school where mobarat_year='.$current['mobarat_year'].')'); 
    ?>
<div class="row">
    <div class="col-md-7">
        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i>الرجاء إختيار المدرسة أو البحث*
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">
                            <tbody>
                                <?php foreach ($records as $value) { ?>
                                    <tr>
                                        <td>
                                            <?php echo CHtml::ajaxLink($value->school_name, array('MbMessage/adminList'), array('update' => '#list', 'data' => array('id' => $value->school_id))); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table></div></div>
            </div>
        </div></div>
    <!--</div>
    <div class="row">-->
    <div class="col-md-5">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> إختيار وجهة الرسالة
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'to', array('class' => "control-label")); ?>
                    <?php echo $form->dropDownList($model, 'to', array(), array('empty' => 'اختر وجهة الرسالة', 'class' => 'form-control', 'id' => 'list'));
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
                    echo CHtml::resetButton('مسح', array('class' => 'btn btn-danger'), '<i class="icon-cut"></i> مسح الكل');
                    ?>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--</div>-->
    <?php $this->endWidget(); ?>
    <style>
        .col-md-6{
            display:none;
        }
    </style>
