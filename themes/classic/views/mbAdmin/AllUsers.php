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
                    List All Users
                </p>
            </div>
            <div class="table-scrollable">
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <td>MUN</td>
                            <th>كلمة المرور</th>
                            <th>النوع</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $eo = 0;
                        foreach ($model as $p) {

                            $eo++;
                            if ($eo % 2 == 0)
                                $cl = "even";
                            else
                                $cl = "odd";
                            ?>
                            <tr <?php if ($cl == "even") {
                                ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >
                                    <?php $subMUN = substr($p->user_mun, 2); ?>
                                <td><?php echo $subMUN; ?></td>
                                <td><?php echo $p->user_password; ?></td>
                                <?php if ($p->user_type == 1) { ?>
                                    <td><?php echo "إداري"; ?></td>
                                <?php } elseif ($p->user_type == 2) { ?>
                                    <td><?php echo "مدرسة"; ?></td>
                                <?php } elseif ($p->user_type == 3) { ?>
                                    <td><?php echo "طالب"; ?></td>
                                <?php } elseif ($p->user_type == 4) { ?>
                                    <td><?php
                                        echo "أستاذ";
                                    }
                                    ?></td>



                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>