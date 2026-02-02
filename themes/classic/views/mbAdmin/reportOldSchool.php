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
                    معلومات المدارس المشاركة سابقاً

                </p>
            </div>
            <?php echo CHtml::beginForm(array('/MbAdmin/reportOldSchool'), 'post'); ?>
            <?php echo CHtml::submitButton('مسح', array('class' => 'btn btn-danger')); ?>
            <div class="table-scrollable">
                <table class="table table-bordered" style="display:block ; height:400px;;overflow:auto">
                    <thead>
                        <tr>
                            <th></th>
                            <td>MUN</td>
                            <td>School ID</td>
                            <th>إسم المدرسة</th>
                            <th>إسم المدير</th>
                            <th>المحافظة</th>
                            <th>القضاء</th>
                            <th>المدينة</th>
                            <th>الشارع</th>
                            <th>هاتف المدرسة</th>
                            <th>الأستاذ المسؤول</th>
                            <th>رقم هاتف الأستاذ المسؤول</th>
                            <th>البريد الإلكتروني</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $eo = 0;

                        foreach ($schoolConfirmed as $p) {
                            $user = MbUser::model()->findByAttributes(array('user_id' => $p->school_user));

                            $eo++;
                            if ($eo % 2 == 0)
                                $cl = "even";
                            else
                                $cl = "odd";
                            ?>

                            <tr <?php if ($cl == "even") {
                                ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >
                                <td>
                                    <?php echo CHtml::checkbox('reset[]', '', array('value' => $p->school_id)); ?>
                                </td>
                                <?php if ($subMUN = substr($user->user_mun, 2)) { ?>
                                    <td><?php echo $subMUN; ?></td>
                                <?php } else { ?>
                                    <td></td>
                                <?php } ?>
                                <td><?php echo $p->school_id; ?></td>
                                <td><?php echo $p->school_name; ?></span</td>
                                <?php $man = MbSchoolManager::model()->findAll('smanager_school=' . $p->school_id); ?>
                                <td><?php echo $man[0]['smanager_fname'] . " " . $man[0]['smanager_lname']; ?></td>
                                <?php
                                $ka = MbKadaa::model()->findAll('kadaa_id =' . $p->school_kadda);
                                $mu = MbMouhafaza::model()->findAll('mouhafaza_id =' . $ka[0]['kadaa_mouhafaza'])
                                ?>
                                <td><?php echo $mu[0]['mouhafaza_name']; ?></td>
                                <td><?php echo $p->schoolKadda->kadaa_name; ?></td>
                                <td><?php echo $p->school_city; ?> </td>
                                <td> <?php echo $p->school_street; ?> </td>

                                <td><?php echo $p->school_phone; ?></td>
                                <?php if ($otea = MbOfficialTeacher::model()->findAll('oteacher_school=' . $p->school_id . ' AND oteacher_flag=2')) { ?>
                                    <td><?php echo $otea[0]['oteacher_fname'] . " " . $otea[0]['oteacher_lname']; ?></td>
                                    <td><?php echo $otea[0]['oteacher_mobile'] ?></td>

                                    <td><?php echo $otea[0]['oteacher_email'] ?></td>

                                <?php } else { ?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
</div>