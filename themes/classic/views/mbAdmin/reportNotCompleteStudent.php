<div class="col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption"><i class="icon-bar-chart"></i>تقرير</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="note note-success">
                <p>
                    معلومات الطلاب  الغير مكتملة البيانات

                </p>
            </div>
            <div class="table-scrollable">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>رسالة</th>
                            <td>MUN</td>
                            <td>الإسم</td>
                            <th>إسم الأب</th>
                            <th>الشهرة</th>
                            <th>البريد الالكتروني</th>
                            <th>الصف</th>
                            <th>تاريخ الميلاد</th>
                            <th>رقم الهاتف</th>
                            <th> الجنس</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $eo = 0;

                        foreach ($schoolConfirmed as $p) {
                            $user = MbUser::model()->findByAttributes(array('user_id' => $p->student_user));

                            $eo++;
                            if ($eo % 2 == 0)
                                $cl = "even";
                            else
                                $cl = "odd";
                            ?>

                            <tr <?php if ($cl == "even") {
                                ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >
                                <td>
                                    <?php
                                    echo CHtml::ajaxlink('<button type="button" class="btn btn-warning"><i class="icon-envelope"></i></button>', array('MbMessage/studentNotComplete'), array(
                                        "type" => "GET",
                                        "data" => array("id" => $p->student_user),
                                        "success" => "function(data){
                                alert(\"لقد تم إرسال الرسالة بنجاح إلى الطالب المعني\")

                                    }",
                                    ));
                                    ?>


                                </td>                                </td>
                                <?php if ($subMUN = substr($user->user_mun, 2)) { ?>
                                    <td><?php echo $subMUN; ?></td>
                                <?php } else { ?>
                                    <td></td>
                                <?php } ?>
                                <td><?php echo $p->student_fname; ?></td>
                                <td><?php echo $p->student_mname; ?></span</td>
                                <td><?php echo $p->student_lname; ?></span</td>
                                <td><?php echo $p->student_email; ?></td>
                                <td><?php echo $p->student_class; ?></td>
                                <td><?php echo $p->student_birthdate; ?> </td>
                                <td><?php echo $p->student_phone; ?> </td>
                                <td><?php echo $p->student_sex; ?> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


