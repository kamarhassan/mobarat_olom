<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="row">

    <div class="col-md-12">
        <div class="portlet box blue">

            <div class="portlet-body">
                <table class="table table-bordered">
                       
                    <tr><td><b>المشروع</b></td><td><?php echo $prj['project_name'];?></td>
                    <td><b>عدد الحكام</b></td><td><?php echo $prj['total_judge'];?></td>
                    <td><b>عدد حكام النواة</b></td><td><?php echo $prj['total_judgekernel'];?></td>
                    <td><b>المعدل النهائي</b></td><td><?php echo round($prj['total_grade'],2);?></td>
                    <td><b>المعدل المثقل</b></td><td><?php echo round($prj['total_grade_coef'],2);?></td>
                    </tr>
                </table>
                <div class="table-scrollable">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <?php
                                    if(count($judges)>0){
                                        foreach ($judges[0] as $key => $value) {
                                            echo " <th>".$key."</th>";
                                        }
                                    }else echo "<h2>لم يحكم بعد</h2>"
                               ?>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $eo = 0;
                            foreach ($judges as $p) {

                                $eo++;
                                if ($eo % 2 == 0)
                                    $cl = "even";
                                else
                                    $cl = "odd";


                                ?>
                                <tr  <?php if ($cl == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >

                                    <?php
                                     foreach ($p as $key => $value) {
                                            echo " <td>".$value."</td>";
                                        }
                                    ?>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php if(count($judgesNotRated)>0){?>
                <div><center><h2>الحكام المسجلين</h2></center></div>
                <div class="table-scrollable">
                    <table class="table table-bordered">
                       
                        <tbody>
                            <?php
                            $eo = 0;
                            foreach ($judgesNotRated as $p) {

                                $eo++;
                                if ($eo % 2 == 0)
                                    $cl = "even";
                                else
                                    $cl = "odd";


                                ?>
                                <tr  <?php if ($cl == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >
                                    <td width="100 px"><?php echo $p['judge_name'] ?></td>
                                  
                                    

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php }?>
            </div>
        </div>
    </div>