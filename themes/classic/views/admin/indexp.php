<?php

$baseUrl = Yii::app()->theme->baseUrl;



?>



<h3 class="page-title">

    صفحة إدارة لسنة <?php

    $clsPerson=Yii::app()->session['clsPerson'] ;

    echo $mobarat['mobarat_year'];



    ?>

</h3>

    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                    <!--<h4 class="modal-title">إحصائيات المشاريع</h4>-->

                </div>

                <div class="modal-body" id="modalBody">



                </div>

                <!--                              <div class="modal-footer">

                                                 <button type="button" class="btn default" data-dismiss="modal">Close</button>

                                                 <button type="button" class="btn blue">Save changes</button>

                                              </div>-->

            </div>

            <!-- /.modal-content -->

        </div>

        <!-- /.modal-dialog -->

    </div>

<?php 

    $counter=0;

    $row='';



//    echo $clsPerson->person_id;

    echo cls_Designer::getPagesLink($this, $pgs,$mobarat,$clsPerson, 4,0,'',$counter,$row);

?>



<br><br>

<div class = "row ui-sortable" id = "sortable_portlets">

    <div class = "col-md-5 column sortable">

        <!--BEGIN Portlet PORTLET-->



        <!--END Portlet PORTLET-->

        <!--BEGIN Portlet PORTLET-->

        <div class = " portlet box blue">

            <div class = "portlet-title">

                <div class = "caption"><i class = "icon-reorder"></i>إحصائيات عامة </div>



            </div>

            <div class = "portlet-body">





                <ul class="list-group">



                    <li class="list-group-item">

                        عدد المشاريع المتاحة

                        <span class="badge badge-success">

                            <?php echo $mobarat['MaxNoOfProject']; ?>

                        </span>





                    </li>



                    <li class="list-group-item">

                        عدد المدارس الغير مؤكدة

                        <span class="badge badge-success">

                            <?php echo MobaratSchool::getCoutingPendingSchool($mobarat['mobarat_year']); ?>

                        </span>





                    </li>

                    <li class="list-group-item">

                          <?php

                         //echo time();

                            echo CHtml::ajaxLink('عدد المدارس المؤكدة', array('Statistics/SchoolStat'), array('update' => '#modalBody',

                                            'complete' => 'function() {$("#basic").modal();}'));

                        ?>

                        

                        <span class="badge badge-info">

                            <?php echo MobaratSchool::getCoutingConfirmedSchool($mobarat['mobarat_year']); 

                                    

                            ?>

                        </span>

                    </li>

                    <!--

                    <li class="list-group-item">

                        

                        عدد المدارس المؤكدة  رسمي

                        <span class="badge badge-info">

                            <?php //echo $n->getCoutingConfirmedPublicSchool(); 

                            ?>

                        </span>

                    </li>

                    <li class="list-group-item">

                         عدد المدارس المؤكدة   خاص

                        <span class="badge badge-info">

                            <?php //echo $n->getCoutingConfirmedPrivateSchool(); 

                            ?>

                        </span>

                    </li>

                    <li class="list-group-item">

                         عدد المدارس المؤكدة  الجديدة

                        <span class="badge badge-info">

                            <?php //echo $n->getCoutingConfirmedSchoolNew(); 

                            ?>

                        </span>

                    </li>

                     <li class="list-group-item">

                         عدد المدارس المؤكدة   شاركت السنة الماضية

                        <span class="badge badge-info">

                            <?php //echo $n->getCoutingConfirmedSchoolPrecedentYear(); 

                            ?>

                        </span>

                    </li>

                    -->

                    <li class="list-group-item">

                       

                         <?php

                         

                            echo CHtml::ajaxLink('عدد المشاريع', array('Statistics/ProjectTypeStat'), array('update' => '#modalBody',

                                            'complete' => 'function() {

          $("#basic").modal();

        }'));

                        ?>

                        <span class="badge badge-warning">

                            

                            

                            <?php

                             

                            echo Project::getCountAllProject($mobarat['mobarat_year']);

                            ?>

                        </span>

                    </li>

                    <li class="list-group-item">

                        عدد الأساتذة المشرفين

                        <span class="badge badge-danger">

                            <?php echo Personteacher::getCountAllTeacher($mobarat['mobarat_year']);

                            ?>

                        </span>

                    </li>

                    <li class="list-group-item">

                        عدد الطلاب

                        <span class="badge badge-info">

                            <?php echo Personstudent::getCountAllStudent($mobarat['mobarat_year']); 

                            ?>

                        </span>

                    </li>

                </ul>

            </div>

        </div>

    </div>

    <!--END Portlet PORTLET-->

    <div class="col-md-7">

        <div class="portlet box blue">

            <div class="portlet-title">

                <div class = "caption">

                    <i class = "icon-reorder"></i> إرسال رسالة </div>

            </div>

            <div class="portlet-body">

                <?php

                $form = $this->beginWidget('CActiveForm', array(

                    'id' => 'mb-message-form',

                    'enableAjaxValidation' => false,

                ));

                ?>

                <?php if ($form->error($model, 'to') || $form->error($model, 'message_content') || $form->error($model, 'message_subject')) { ?>

                    <div class='alert alert-danger'>

                        <?php echo $form->error($model, 'to'); ?>

                        <?php echo $form->error($model, 'message_content'); ?>

                        <?php echo $form->error($model, 'message_subject'); ?>

                    </div>

                <?php } ?>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'to', array('class' => "control-label")); ?>

                            <?php echo $form->dropDownList($model, 'to', $list, array('empty' => 'اختر وجهة الرسالة', 'class' => 'form-control'));

                            ?>

                        </div>

                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'message_subject', array('class' => "control-label")); ?>

                            <?php echo $form->textField($model, 'message_subject', array('size' => 60, 'maxlength' => 100, 'class' => "form-control")); ?>

                        </div>

                        <div class="form-group">

                            <?php echo $form->labelEx($model, 'message_content', array('class' => "control-label")); ?>

                            <?php echo $form->textArea($model, 'message_content', array('rows' => 6, 'cols' => 50, 'class' => "form-control")); ?>

                        </div>

                        <div class="margin-top-10">

                            <?php

                            echo CHtml::submitButton('إرسال', array('class' => 'btn blue', 'confirm' => 'هل أنت متأكد من إرسال الرسالة؟'), '<i class="icon-ok"></i> ');

                            echo CHtml::resetButton('مسح', array('class' => 'btn btn-danger'), '<i class="icon-cut"></i> مسح الكل');

                            ?>

                        </div>

                        </form>

                    </div>

                </div>

                <?php $this->endWidget(); ?>

            </div>

        </div>

    </div>



</div>









