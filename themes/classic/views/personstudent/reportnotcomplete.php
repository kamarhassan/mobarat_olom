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

                        foreach ($stds as $p) {
                           

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
                                        "data" => array("id" => $p['user_id']),
                                        "success" => "function(data){
                                alert(\"لقد تم إرسال الرسالة بنجاح إلى الطالب المعني\")

                                    }",
                                    ));
                                    ?>


                                </td>                                </td>
                                <?php if ($subMUN = substr($p['user_mun'], 2)) { ?>
                                    <td><?php echo $subMUN; ?></td>
                                <?php } else { ?>
                                    <td></td>
                                <?php } ?>
                                <td><?php echo $p['Person_fname']; ?></td>
                                <td><?php echo $p['Person_mname']; ?></span</td>
                                <td><?php echo $p['Person_lname']; ?></span</td>
                                <td><?php echo $p['Person_email1']; ?></td>
                                <td><?php echo $p['student_class']; ?></td>
                                <td><?php echo $p['Person_birthdate']; ?> </td>
                                <td><?php echo $p['Person_Phone']; ?> </td>
                                <td><?php echo $p['Person_sex']; ?> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


