<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'techer-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>
    <div class="row">
        <div class="col-md-3 "></div>
        <div class="col-md-12 ">

            <div class="portlet box blue">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-reorder"></i>  يجب أن لا يتعدى عدد الاستاذ المشرف أكثر من : <?php echo $current['TeacherNbForProject'];?>
                    </div>


                    <div class="caption">

                    </div>

                    <div class="tools">
                        <a href="#" class="collapse"></a>

                    </div>

                </div>
                <div class="portlet-body form">

                    <br>
                    <div class = "clearfix">
                        <table  class="table table-striped table-bordered table-advance table-hover" >
                            <thead>
                                <tr>
                                    <th> إسم المشروع</th>
                                    <th>  عدد الأساتذة</th>
                                    <th>الأستاذ المشرف  </th>
                                    <th>   </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($project as $p) { ?>
                                        <tr>
                                            <td> <b> <span class="font-blue"><?php echo $p['project_name']; ?></span></b></td>
                                            <td><span class="font-blue"> <?php echo $p['teachcount']; ?></span></td>
                                            <td><span class="font-blue">
                                                 <?php
                                                    if ($p['teachcount'] != 0) {
                                                        foreach ($teah as $t) {

                                                           
                                                            if($t['project_id']==$p['project_id'])
                                                                if ($t['isConfirmed'] == FALSE) 
                                                                    echo "الطلب من ".$t['Person_fname'] . ' ' . $t['Person_lname'] . " ". "تأكيد تسجيله". "<br>";
                                                                else if ($t['Person_fname'] == null)
                                                                        echo 'الطلب من ' . $t['Person_email1'] . ' إكمال تسجيله <br>';
                                                                    else
                                                                        echo $t['Person_fname'] . ' ' . $t['Person_lname'] . "<br>";
                                                                
                                                        }
                                                    }
                                                 ?> </span>
                                            </td>
                                            <td>


                                                <?php
                                                if ($p['teachcount'] < $current['TeacherNbForProject']) {
                                                    ?>
                                                    <a href="<?php echo $this->createAbsoluteUrl('Personteacher/regStep2/prjid/' . $p['project_id']); ?>" class="btn default btn-xs green">
                                                        <i class="icon-plus"></i> تسجيل أستاذ مشارك سابق </a>
                                                    <a href="<?php echo $this->createAbsoluteUrl('Personteacher/regStep4/prjid/' . $p['project_id']); ?>" class="btn default btn-xs purple">
                                                        <i class="icon-plus"></i> تسجيل أستاذ جديد </a>
                                                <?php } else { ?>

                                                    لا تستطيع  تسجيل أساتذة مشرفين

                                                    <?php
                                                }
                                                ?>

                                            </td>

                                        </tr>
                                        <?php
                                    }
                               
                                ?>
                            </tbody>
                        </table>
                        <br>
                    </div>





                </div>



            </div>
        </div>

    </div>

    <div class="row">

        <div id='k'></div>
    </div>
    <?php $this->endWidget(); ?>
</div>


