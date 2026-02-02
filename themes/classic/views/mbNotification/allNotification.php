<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="row">

    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-bullhorn yellow"></i>  جميع الإشعارات  (<?php echo count($noti); ?>)
                </div>
            </div>
            <div class="portlet-body">
                <?php
                foreach ($noti as $uu) {
                    $not = MbNotification::model()->findAll(array('condition' =>
                        'notification_id=' . $uu->notification_id,
                        'order' => 'notification_id DESC'));

                    foreach ($not as $p) {
                        ?>

                        <i class="icon-bullhorn yellow"></i>   <?php echo "   " . $p->notification_content . "   "; ?>
                        <i class="icon-calendar"></i>
                        <font color="#4B8DF8">  <b> <span class="time">
                                <?php
//                                date_default_timezone_set('Asia/Beirut');
//                                //compare if Current date is greater than notification date
//                                if (date('Y-m-d') > $p->notification_date) {
//
//                                    $time = strtotime($p->notification_date);
//                                    //notification Month
//
//                                    $notDateM = date('m', $time);
//                                    //Now Month
//                                    $nowDateM = date('m');
//                                    //compare if notification create before months
//                                    if ($nowDateM > $notDateM) {
//                                        $dateNow = date('Y-m-d');
//                                        $notDate = $p->notification_date;
//                                        $date1 = new DateTime($dateNow);
//                                        $date2 = new DateTime($notDate);
//                                        $daynow = $date1->format('%d');
//                                        $daynoti = $date2->format('%d');
//
//                                        if ($daynow < $daynoti) {
//                                            $interval = $date1->diff($date2);
//                                            $diff = $interval->format('%d');
//
//                                            echo "منذ " . $diff . " يوم";
//                                        } else {
//                                            $dateNow = date('Y-m-d');
//                                            $notDate = $p->notification_date;
//
//                                            $date1 = new DateTime($dateNow);
//                                            $date2 = new DateTime($notDate);
//                                            $interval = $date1->diff($date2);
//                                            $diff = $interval->format('%m');
//                                            if ($diff >= 3 && $diff <= 10)
//                                                echo "منذ " . $diff + 1 . " أشهر";
//                                            else
//                                                echo "منذ " . $diff + 1 . " شهر";
//                                        }
//                                        //compare if current month is the month of notification
//                                    } else if ($nowDateM == $notDateM) {
//                                        $dateNow = date('Y-m-d');
//                                        $notDate = $p->notification_date;
//
//                                        $date1 = new DateTime($dateNow);
//                                        $date2 = new DateTime($notDate);
//                                        $interval = $date1->diff($date2);
//                                        $diff = $interval->format('%d');
//                                        if ($diff >= 3 && $diff <= 10)
//                                            echo "منذ " . $diff . " أيام";
//                                        else
//                                            echo "منذ " . $diff . " يوم";
//                                    }
//                                }
//                                //compare if the notification created today
//                                else if (date('Y-m-d') == $p->notification_date) {
//                                    $time = strtotime($p->notification_time);
//                                    //notification time
//                                    $notTimeH = date('H', $time);
//                                    $notTimeI = date('i', $time);
//                                    $notTimeS = date('s', $time);
//                                    //Now Time
//                                    $nowTimeH = date('H');
//                                    $nowTimeI = date('i');
//                                    $nowTimeS = date('s');
//                                    if ($nowTimeH > $notTimeH) {
//                                        $diff = $nowTimeH - $notTimeH;
//                                        if ($diff >= 3 && $diff <= 10)
//                                            echo "منذ " . $diff . " ساعات";
//                                        else
//                                            echo "منذ " . $diff . " ساعة";
//                                    } else if ($nowTimeI > $notTimeI) {
//                                        $diff = $nowTimeI - $notTimeI;
//                                        if ($diff >= 3 && $diff <= 10)
//                                            echo "منذ " . $diff . " دقائق";
//                                        else
//                                            echo "منذ " . $diff . " دقيقة";
//                                    } else {
//                                        $diff = $nowTimeS - $notTimeS;
//                                        if ($diff >= 3 && $diff <= 10)
//                                            echo "منذ " . $diff . " ثواني";
//                                        else
//                                            echo "منذ " . $diff . " ثانية";
//                                    }
//                                }
                                echo $p->notification_date . " | " . $p->notification_time;
                                ?>
                            </span></b></font>
                        <br><br>

                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>


</div>
</div>