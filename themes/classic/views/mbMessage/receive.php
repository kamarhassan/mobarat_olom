<?php $ress = MbMessageDetail::model()->findAll('mdetail_receiver = ' . Yii::app()->user->id . ' AND message_read_flag = 0'); ?>

<div class="row inbox">
    <div class="col-md-2">
        <ul class="inbox-nav margin-bottom-10">
            <li class="compose-btn">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('MbMessage/create'); ?>" data-title="Compose" class="btn green">
                    <i class="icon-edit"></i> إنشاء رسالة
                </a>
            </li>
            <li>
                <a href="<?php echo $this->createAbsoluteUrl('MbMessage/inboxAll'); ?>" class="btn" data-title="Inbox">الرسائل الغير مقروءة
                    (
                    <?php echo count($ress); ?>
                    )</a>
                <b></b>
            </li>
            <li class="sent"><a class="btn" href="<?php echo $this->createAbsoluteUrl('MbMessage/send'); ?>"  data-title="Sent">الرسائل المرسلة</a><b></b></li>
            <li class="inbox active"><a class="btn" href="<?php echo $this->createAbsoluteUrl('MbMessage/receive'); ?>" data-title="Draft">الرسائل المستلمة </a><b></b></li>
            <li class="trash"><a class="btn" href="<?php echo $this->createAbsoluteUrl('MbMessage/trash'); ?>" data-title="Trash">الرسائل المحذوفة</a><b></b></li>
        </ul>
    </div>
    <?php
    $res = MbMessageDetail::model()->findAll(
            array(
                'condition' => 'mdetail_receiver = ' . Yii::app()->user->id . ' AND message_read_flag = 1',
                'order' => 'mdetail_id DESC'
    ));
    ?>

    <div class="col-md-10">
        <div class="row">
            <div class="portlet box green tasks-widget">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-check"></i>الرسائل المستلمة</div>
                </div>
                <div class="portlet-body">
                    <div class="task-content">
                        <div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1">
                            <!-- START TASK LIST -->
                            <ul class="task-list">
                                <?php
                                foreach ($res as $value) {
                                    $user = User::model()->findByAttributes(array('user_id' => $value->mdetail_sender));
                                    $message = MbMessage::model()->findByAttributes(array('message_id' => $value->mdetail_message));
                                    $info = Person::model()->findByAttributes(array("Person_userID" => $value->mdetail_sender));
                                    $name = $info->Person_fname;
                                    $last_name = $info->Person_lname;
                                    ?>
                                    <li class="">
                                        <div class="task-title">
                                            <i class="icon-envelope"></i>
                                            <span class="task-title-sp">
                                                تاريخ الرسالة: <?php echo $message->message_date; ?> /
                                                من:
                                                <?php
                                                echo $name. ' ' .$last_name;
                                                
                                                ?> /
                                                موضوع الرسالة: <?php echo $message->message_subject; ?>
                                            </span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                    <i class="icon-cog"></i><i class="icon-angle-down"></i></a>
                                                <ul class="dropdown-menu pull-right">
                                                    <?php if ($value->message_read_flag == 0) { ?>
                                                        
                                                    <?php } ?>     <li><a href="<?php echo $this->createAbsoluteUrl('MbMessage/info/' . $message->message_id); ?>"><i class="icon-ok-circle"></i> إقرأ الرسالة</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </li>
<?php } ?>
                            </ul>
                            <!-- END START TASK LIST -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



