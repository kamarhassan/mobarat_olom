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
                    معلومات المدارس  الغير مكتملة البيانات

                </p>
            </div>
            <div class="table-scrollable">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>رسالة</th>
                            <th >MUN</th>
                            <th>School ID</th>
                            <th>إسم المدرسة</th>

                            <th>بريد إلكتروني</th>
                            <th>مرحلة</th>
                            <th>النوع</th>

                            <th>إسم المدير</th>

                            <th>بريد إلكتروني</th>
                            <th> هاتف المدير</th>
                            <th>الجنس</th>
                            <th>اللقب</th>

                            <th>المحافظة</th>
                            <th>القضاء</th>
                            <th>المدينة</th>
                            <th>الشارع</th>
                            <th>هاتف المدرسة</th>
                            <th>الأستاذ المسؤول</th>
                            <th>رقم هاتف الأستاذ المسؤول</th>
                            <th>البريد الإلكتروني</th>
                            <th>الصفة</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $eo = 0;

                        foreach ($schls as $p) {
                            //$user = MbUser::model()->findByAttributes(array('user_id' => $p->school_user));

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
                                    echo CHtml::ajaxlink('<button type="button" class="btn btn-warning"><i class="icon-envelope"></i></button>', array('MbMessage/schoolNotComplete'), array(
                                        "type" => "GET",
                                        "data" => array("id" => $p['user_id']),
                                        "success" => "function(data){
                                alert(\"لقد تم إرسال الرسالة بنجاح إلى المدرسة المعنية\")

                                    }",
                                    ));
                                    ?>


                                </td>  
                                 <?php $subMUN = substr($p['user_mun'], 2); ?>
                                <td><?php echo $subMUN; ?></td>
                                <td><?php echo $p['school_id']; ?></td>
                                <td><?php echo $p['school_name']; ?></td>

                                <td><?php echo $p['school_email']; ?></td>
                                <td><?php echo $p['school_level']; ?></td>
                                <td><?php echo $p['school_type']; ?></td>

                                
                                <td><?php echo $p['maname'] . " " . $p['malname']; ?></td>
                                <td><?php echo $p['mamail']; ?></td>
                                <td><?php echo $p['maphone']; ?></td>
                                <td><?php echo $p['masex']; ?></td>
                                <td><?php echo $p['masalutation']; ?></td>

                                <td><?php echo $p['moha']; ?></td>
                                <td><?php echo $p['kada']; ?></td>
                               
                                <td><?php echo $p['city'];?></td>
                                <td> <?php echo $p['school_street'];?> </td>

                                <td><?php echo $p['school_phone']; ?></td>
								
                                
                                <td><?php echo $p['ofname'] . " " . $p['oflname']; ?></td>
                                <td><?php echo $p['ofphone']; ?></td>

                                <td><?php echo $p['ofmail']; ?></td>
                                <td><?php echo $p['oteacher_description']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

