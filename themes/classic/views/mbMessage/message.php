<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<?php
if (!Yii::app()->user->id){
$res = NULL;
?>
<li class="dropdown" id="header_inbox_bar">
    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
       data-close-others="true">
        <i class="icon-envelope"></i></a></li>
<?php
}
else if(
    count($res = MbMessageDetail::model()->findAll("mdetail_receiver = " . Yii::app()->user->id . " AND message_read_flag = 0")) != 0){
        $res = MbMessageDetail::model()->findAll(array(
                    'condition' => "mdetail_receiver = " . Yii::app()->user->id . " AND message_read_flag = 0",
                    'order' => 'mdetail_id DESC')
        );
?>
<li class="dropdown" id="header_inbox_bar">
    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
       data-close-others="true">
        <i class="icon-envelope"></i>
        <?php if (count($res) > 0) { ?>
            <span class="badge"><?php echo count($res); ?></span>
        <?php } ?>
    </a>
    <?php if (count($res) > 0) { ?>
        <ul class="dropdown-menu extended inbox">
            <li>
                <p>
                    لديك
                    <?php echo count($res); ?>
                    رسائل
                </p>
            </li>
            <li>
                <ul class="dropdown-menu-list scroller" style="height: 250px;">
                    <?php
                    foreach ($res as $i) {
                        $type = User::model()->findByAttributes(array("user_id" => $i->mdetail_sender));
                        $message = MbMessage::model()->findByAttributes(array("message_id" => $i->mdetail_message));
                        $info = Person::model()->findByAttributes(array("Person_userID" => $i->mdetail_sender));
                        /*$name = $info->Person_fname;
                        $last_name = $info->Person_lname;*/
                        $pict=cls_attach::getPictureURL(enm_Program::PERSON,$info->Person_id,$info->Person_pic,$bolExists);
                        /*
                        if ($type->user_type == 3) {
                            $info = MbStudent::model()->findByAttributes(array("student_user" => $i->mdetail_sender));
                            $name = $info->Person_fname;
                            $last_name = $info->Person_lname;
                        } else {
                            if ($type->user_type == 4) {
                                $info = MbTeacher::model()->findByAttributes(array("teacher_user" => $i->mdetail_sender));
                                $name = "الأستاذ " . $info->teacher_fname;
                                $last_name = $info->teacher_lname;
                            }
                            if ($type->user_type == 2) {
                                if ($info = MbOfficialTeacher::model()->findByAttributes(array("oteacher_user" => $i->mdetail_sender))) {
                                    $name = "الأستاذ " . $info->oteacher_fname;
                                    $last_name = $info->oteacher_lname;
                                }
                            }
                            if ($type->user_type == 1) {
                                    $name = 'الإدارة ';
                                    $last_name = "العامة";
                                }
                        }*/
                        ?>
                        <li>
                            <a href="<?php echo Yii::app()->createAbsoluteUrl("MbMessage/inbox/" . $i->mdetail_id); ?>">
                                <span class="photo"><img src="<?php echo $pict; ?>" alt=""/></span>
                                <span class="subject">
                                    <span class="from">
                                        <?php  echo Person::getSalutationAndNameByUserID($i->mdetail_sender);  ?>
                                    </span>
                                    <span class="time">
                                        <?php echo $message->message_date; ?>
                                    </span>
                                </span>
                                <span class="message">
                                    <?php echo $message->message_subject; ?>
                                </span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if (count($res) > 3) { ?>
            <li class="external">
                <a href="<?php echo Yii::app()->createAbsoluteUrl("MbMessage/inboxAll"); ?>">اقرأ جميع الرسائل <i class="m-icon-swapleft"></i></a>
            </li>
        <?php } ?>
    </ul>

</li>
<?php } else { ?>
<li class="dropdown" id="header_inbox_bar">
    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
       data-close-others="true">
        <i class="icon-envelope"></i></a></li>
<?php } ?>
