<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<?php
if (!Yii::app()->user->id) {
    $count = NULL;
    ?>

    <?php
} else {
    $noti = NotificationReceived::model()->findAll(array('condition' =>
        'user_id=' . Yii::app()->user->getId() . ' AND flag=0',
        'order' => 'notification_id DESC'));
    $count =count($noti);
    if ($count != 0) {
        ?>
        <span class="badge" id="notibadge">
            <?php
            echo $count;
        }
        ?>
    </span>
<?php } ?>
</a>
<?php 
//if (count($count) > 0) { 
     //if (count($count) > 0) { 
     if ($count> 0) { 
    ?>
    <ul class = "dropdown-menu extended notification" id="notiheader">
        <li>
            <?php if ($count != 0) {
                ?>
                <p> لديك  <?php echo $count; ?>  إشعارات غير مقروءة</p>
            <?php } else { ?>
                <p> لا يوجد إشعارات غير مقروءة</p>
            <?php } ?>
        </li>
        <li>
            <div id="notidetail" class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 350px;"><ul class="dropdown-menu-list scroller" style="height: 350px; overflow: hidden; width: auto;">
                    <?php
                    foreach ($noti as $uu) {
                        $not = MbNotification::model()->findAll(array('condition' =>
                            'notification_id=' . $uu->notification_id,
                            'order' => 'notification_id DESC'));

                        foreach ($not as $p) {
                            ?>
                            <li>
                                <a href="#">

                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <!--                                                        <span class='label label-icon label-success'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class='icon-chevron-left'></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </span>-->
                                    <?php
                                    //echo CHtml::ajaxLink($p->notification_content, array('MbAdmin/ReadNotification'), array('data' => array('id' => Yii::app()->user->getId())));
                                    echo $p->notification_content;
                                    ?>

                                    <br>
                                    <span class="time">
                                        <?php
//                                        date_default_timezone_set('Asia/Beirut');
//                                        //compare if Current date is greater than notification date
//                                        if (date('Y-m-d') > $p->notification_date) {
//
//                                            $time = strtotime($p->notification_date);
//                                            //notification Month
//
//                                            $notDateM = date('m', $time);
//                                            //Now Month
//                                            $nowDateM = date('m');
//                                            //compare if notification create before months
//                                            if ($nowDateM > $notDateM) {
//                                                $dateNow = date('Y-m-d');
//                                                $notDate = $p->notification_date;
//                                                $date1 = new DateTime($dateNow);
//                                                $date2 = new DateTime($notDate);
//                                                $daynow = $date1->format('%d');
//                                                $daynoti = $date2->format('%d');
//
//                                                if ($daynow < $daynoti) {
//                                                    $interval = $date1->diff($date2);
//                                                    $diff = $interval->format('%d');
//
//                                                    echo "منذ " . $diff . " يوم";
//                                                } else {
//                                                    $dateNow = date('Y-m-d');
//                                                    $notDate = $p->notification_date;
//
//                                                    $date1 = new DateTime($dateNow);
//                                                    $date2 = new DateTime($notDate);
//                                                    $interval = $date1->diff($date2);
//                                                    $diff = $interval->format('%m');
//                                                    if ($diff >= 3 && $diff <= 10)
//                                                        echo "منذ " . $diff + 1 . " أشهر";
//                                                    else
//                                                        echo "منذ " . $diff + 1 . " شهر";
//                                                }
//                                                //compare if current month is the month of notification
//                                            } else if ($nowDateM == $notDateM) {
//                                                $dateNow = date('Y-m-d');
//                                                $notDate = $p->notification_date;
//
//                                                $date1 = new DateTime($dateNow);
//                                                $date2 = new DateTime($notDate);
//                                                $interval = $date1->diff($date2);
//                                                $diff = $interval->format('%d');
//                                                if ($diff >= 3 && $diff <= 10)
//                                                    echo "منذ " . $diff . " أيام";
//                                                else
//                                                    echo "منذ " . $diff . " يوم";
//                                            }
//                                        }
//                                        //compare if the notification created today
//                                        else if (date('Y-m-d') == $p->notification_date) {
//                                            $time = strtotime($p->notification_time);
//                                            //notification time
//                                            $notTimeH = date('H', $time);
//                                            $notTimeI = date('i', $time);
//                                            $notTimeS = date('s', $time);
//                                            //Now Time
//                                            $nowTimeH = date('H');
//                                            $nowTimeI = date('i');
//                                            $nowTimeS = date('s');
//                                            if ($nowTimeH > $notTimeH) {
//                                                $diff = $nowTimeH - $notTimeH;
//                                                if ($diff >= 3 && $diff <= 10)
//                                                    echo "منذ " . $diff . " ساعات";
//                                                else
//                                                    echo "منذ " . $diff . " ساعة";
//                                            } else if ($nowTimeI > $notTimeI) {
//                                                $diff = $nowTimeI - $notTimeI;
//                                                if ($diff >= 3 && $diff <= 10)
//                                                    echo "منذ " . $diff . " دقائق";
//                                                else
//                                                    echo "منذ " . $diff . " دقيقة";
//                                            } else {
//                                                $diff = $nowTimeS - $notTimeS;
//                                                if ($diff >= 3 && $diff <= 10)
//                                                    echo "منذ " . $diff . " ثواني";
//                                                else
//                                                    echo "منذ " . $diff . " ثانية";
//                                            }
//                                        }
                                        echo $p->notification_date . " | " . $p->notification_time;
                                        ?>
                                    </span>
                                </a>



                                <?php
                            }
                        }
                    }
                    ?>
            </ul><div class="slimScrollBar" style="background-color: rgb(161, 178, 189); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; left: 1px; height: 160.25641025641028px; background-position: initial initial; background-repeat: initial initial;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; background-color: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px; background-position: initial initial; background-repeat: initial initial;"></div></div>
    </li>
    <li class="external">
        <a href="<?php echo $this->createAbsoluteUrl('MbNotification/allNotification/' . Yii::app()->user->getId()) ?>">     مشاهدة جميع الإشعارات
            <i class="m-icon-swapleft"></i></i></a>
    </li>
</ul>

<?php 
    //if (count($count) > 3) { 
     if ($count> 3) { 
    ?>
    <li class="external">
        <a href="#">اقرأ جميع الرسائل <i class="m-icon-swapleft"></i></a>
    </li>
<?php } ?>


</li>

