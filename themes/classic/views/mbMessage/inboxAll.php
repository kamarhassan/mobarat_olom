<?php
$res = MbMessageDetail::model()->findAll(array(
    'condition' => 'mdetail_receiver = ' . Yii::app()->user->id . ' AND message_read_flag = 0',
    'order' => 'mdetail_id DESC'
        ));
?>

<div class="row inbox">
    <div class="col-md-2">
        <ul class="inbox-nav margin-bottom-10">
            <li class="compose-btn">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('MbMessage/create'); ?>" data-title="Compose" class="btn green">
                    <i class="icon-edit"></i> إنشاء رسالة
                </a>
            </li>
            <li class="inbox active">
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
        <div class="row">
            <div class="portlet box green tasks-widget">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-check"></i>الرسائل الغير مقروءة</div>
                </div>
                <div class="portlet-body">
                    <div class="task-content">
                        <div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1">
                            <!-- START TASK LIST -->
                            <ul class="task-list">
                                <?php
                                foreach ($res as $value) {
                                    //$user = MbUser::model()->findByAttributes(array('user_id' => $value->mdetail_sender));
                                    $message = MbMessage::model()->findByAttributes(array('message_id' => $value->mdetail_message));
                                    ?>
                                    <li class="">
                                        <div class="task-title">
                                            <i class="icon-envelope"></i>
                                            <span class="task-title-sp">
                                                تاريخ الرسالة: <?php echo $message->message_date; ?> /
                                                من:
                                                <?php
                                                echo Person::getSalutationAndNameByUserID($value->mdetail_sender);
                                                /*
                                                if ($user->user_type == 4) {
                                                    $teacher = MbTeacher::model()->findByAttributes(array('teacher_user' => $value->mdetail_sender));
                                                    ?>
                                                    الأستاذ
                                                    <?php echo $teacher->teacher_fname . ' ' . $teacher->teacher_lname; ?>

                                                <?php } else { ?>
                                                    <?php
                                                    if ($user->user_type == 2) {
                                                        $school = MbSchool::model()->findByAttributes(array('school_user' => $value->mdetail_sender));
                                                        $teacher = MbOfficialTeacher::model()->findByAttributes(array('oteacher_school' => $school->school_id));
                                                        ?>
                                                        الأستاذ
                                                        <?php
                                                        echo $teacher->oteacher_fname . ' ' . $teacher->oteacher_lname." ";
                                                        echo "(".$school->school_name.")";
                                                    } else
                                                    if ($user->user_type == 3) {
                                                        $student = MbStudent::model()->findByAttributes(array('student_user' => $value->mdetail_sender));
                                                        ?>

                                                        <?php echo $student->student_fname . ' ' . $student->student_lname; ?>

                                                        <?php
                                                    } else {
                                                        echo 'الإدارة العامة';
                                                    }
                                                }*/
                                                ?> /
                                                موضوع الرسالة: <?php echo $message->message_subject; ?>
                                            </span>
                                        </div>
                                        <div class="task-config">
                                            <div class="task-config-btn btn-group">
                                                <a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                    <i class="icon-cog"></i><i class="icon-angle-down"></i></a>
                                                <ul class="dropdown-menu pull-right">
                                                    <!--<li><a href="<?php echo $this->createAbsoluteUrl('MbMessageDetail/delete/' . $message->message_id); ?>"><i class="icon-trash"></i> إلغاء</a></li>-->
                                                    <li><a href="<?php echo $this->createAbsoluteUrl('MbMessage/inbox/' . $value->mdetail_id); ?>"><i class="icon-ok-circle"></i> إقرأ الرسالة</a></li>
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
</div>
