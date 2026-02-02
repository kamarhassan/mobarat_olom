<?php $res = MbMessageDetail::model()->findAll('mdetail_receiver = ' . Yii::app()->user->id . ' AND message_read_flag = 0'); ?>
<?php //$user = MbUser::model()->findByAttributes(array('user_id' => $detail->mdetail_sender)); 
?>
<div class="row inbox">
    <div class="col-md-2">
        <ul class="inbox-nav margin-bottom-10">
            <li class="compose-btn">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('MbMessage/create'); ?>" data-title="Compose" class="btn green">
                    <i class="icon-edit"></i> إنشاء رسالة
                </a>
            </li>
            <li class="inbox">
                <a href="<?php echo $this->createAbsoluteUrl('MbMessage/inboxAll'); ?>" class="btn" data-title="Inbox">الرسائل الغير مقروءة
                    (
                    <?php echo count($res); ?>
                    )</a>
                <b></b>
            </li>
            <li class="sent"><a class="btn" href="<?php echo $this->createAbsoluteUrl('MbMessage/send'); ?>"  data-title="Sent">الرسائل المرسلة</a><b></b></li>
            <li class="draft"><a class="btn" href="<?php echo $this->createAbsoluteUrl('MbMessage/receive'); ?>" data-title="Draft">الرسائل المستلمة </a><b></b></li>
            <li class="trash"><a class="btn" href="<?php echo $this->createAbsoluteUrl('MbMessage/trash'); ?>" data-title="Trash">الرسائل المحذوفة</a><b></b></li>
        </ul>
    </div>
    <div class="col-md-10">
                <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                   
                </div>
                <div class="modal-body" id="modalBody">

                </div>
                <!--                              <div class="modal-footer">
                                                 <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                 <button type="button" class="btn blue">Save changes</button>
                                              </div>-->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <?php
                    
                    /*$info = Person::model()->findByAttributes(array("Person_userID" => $detail->mdetail_sender));
                    $name = $info->Person_fname;
                    $last_name = $info->Person_lname;*/
                    echo Person::getSalutationAndNameByUserID($detail->mdetail_sender);
                    
                     $clsPerson=   Yii::app()->session['clsPerson'];
                    //echo Yii::app()->user->id;return; 
                    

                     if ($clsPerson->user_type == '01') {
                        echo CHtml::ajaxLink('<button type="button" class="btn blue"><i class=\'icon-search\'></i></button>'
                                                , array('Person/fulldetails' ), array('update' => '#modalBody',
                                                    'complete' => 'function() {$("#basic").modal();}'
                                                    ,'data' => array('userid' =>$detail->mdetail_sender)
                                                    ,array('id' =>$detail->mdetail_sender,)
                                                   )
                                ); 
                                       
                    }   
                    
                    // echo 'رسالة من '.' '. $name. ' ' .$last_name;

                        
                   
                    ?>
                </div>
            </div>
            <div class="portlet-body">
            <div class="row">
            <div class="col-md-12">
            <div class="col-md-6">
            <span class="label label-sm label-default" style="font-size:17px">
                موضوع الرسالة: 
                </span>&nbsp;
                <div style="font-size:17px">
                <?php echo $message->message_subject; ?>
                </div>
                </div>
                <div class="col-md-6">
                <span class="label label-sm label-default" style="font-size:17px">
                تاريخ الرسالة: 
                </span>&nbsp;
                <div style="font-size:17px">
                <?php echo $message->message_date; ?>
                </div>
                </div>
                </div>
                </div>
                <br><br>
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-6">
                <span class="label label-sm label-default" style="font-size:17px">
                محتوى الرسالة: 
                </span>
                </div>
                </div></div>
                <div class="row">
                <div class="col-md-12">
                <div class="col-md-7"><br>
                <div style="font-size:17px">
                <?php echo $message->message_content; ?>
                </div>
                </div></div></div>
                </div>
            </div>
        </div>
</div>
<div class="row">
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


<?php if($form->error($model, 'to') || $form->error($model, 'message_content') || $form->error($model, 'message_subject')) { ?>
<div class='alert alert-danger'>
    <?php echo $form->error($model, 'to'); ?>
    <?php echo $form->error($model, 'message_content'); ?>
    <?php echo $form->error($model, 'message_subject'); ?>
</div>
<?php } ?>

<form action="#" class="horizontal-form">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <h3 class="form-section"> رسالة الرد</h3>
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
                echo CHtml::submitButton('رد',  array('class' => 'btn blue','confirm'=>'هل أنت متأكد من إرسال الرسالة؟'), '<i class="icon-ok"></i> ');
                echo CHtml::resetButton('مسح',  array('class' => 'btn btn-danger'), '<i class="icon-cut"></i> مسح الكل');
                ?>
            </div>
            </form>
        </div>
    </div>

    <!--    <div class="row">
    <?php // echo $form->labelEx($model,'message_date'); ?>
    <?php // echo $form->textField($model,'message_date');  ?>
    <?php // echo $form->error($model,'message_date');  ?>
            </div>-->

    <div class="row buttons">
        <?php // echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
</div>
</div>

