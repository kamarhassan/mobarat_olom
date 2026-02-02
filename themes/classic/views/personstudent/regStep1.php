<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mb-student-form',
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
                        <i class="icon-reorder"></i>   يجب أن لا يتعدى عدد طلاب  المشروع: <?php echo $current['StudentNbForProject'];?>
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
                                    <th>  عدد التلاميذ</th>
                                    <th>أسماء التلاميذ  </th>
                                    <th>   </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($project as $p) { ?>
                                        <tr>
                                            <td> <b> <span class="font-blue"><?php echo $p['project_name']; ?></span></b></td>
                                            <td><span class="font-blue"> <?php echo $p['stdcount']; ?></span></td>
                                            <td><span class="font-blue">
                                                 <?php
                                                    
                                                    if ($p['stdcount'] != 0) {
                                                        foreach ($std as $s) {

                                                           
                                                            if($s['project_id']==$p['project_id']){
                                                                //$b=0;
                                                                if ($s['isConfirmed'] == FALSE) 
                                                                    {echo "الطلب من ".$s['Person_fname'] . ' ' . $s['Person_lname'] . " ". "تأكيد تسجيله";}
                                                                else if ($s['Person_fname'] == null)
                                                                    {echo 'الطلب من ' . $s['Person_email1'] . ' إكمال تسجيله ';}
                                                                else
                                                                    echo $s['Person_fname'] . ' ' . $s['Person_lname'];
                                                                
                                                                ?>
                                                    <span id="<?php echo  $s['student_personid'];?>">
                                                    <?php
                                                                    echo CHtml::ajaxLink('إعادة إرسال البريد', array('Personstudent/SendMailToStudent')
                                                                                , array('data' => array('id' => $s['person_id'],'stdid'=> $s['student_personid']
                                                                                                        ,'prjid'=>$p['project_id'],'schid'=>$p['school_id']),'update' => '#'. $s['student_personid'])
                                                                                                                    , array('confirm' => 'هل انت متأكد من إعادة إرسال البريد?'));
                                                                    ?>
                                                    </span>
                                                        <?php
                                                                echo "<br>";
                                                                
                                                            }
                                                                
                                                                
                                                        }
                                                    }
                                                 ?> </span>
                                            </td>
                                            <td>


                                                <?php
                                                if ($p['stdcount'] < $current['StudentNbForProject']) {
                                                    ?>
                                                    <a href="<?php echo $this->createAbsoluteUrl('Personstudent/regStep2/prjid/' . $p['project_id']); ?>" class="btn default btn-xs green">
                                                        <i class="icon-plus"></i> تسجيل تلميذ مشارك سابق </a>
                                                    <a href="<?php echo $this->createAbsoluteUrl('Personstudent/regStep4/prjid/' . $p['project_id']); ?>" class="btn default btn-xs purple">
                                                        <i class="icon-plus"></i> تسجيل تلميذ جديد </a>
                                                <?php } else { ?>

                                                    لا تستطيع  تسجيل تلاميذ

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


