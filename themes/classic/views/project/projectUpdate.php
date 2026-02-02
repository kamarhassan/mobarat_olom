<?php 
	$baseUrl = Yii::app()->theme->baseUrl;
	
	/*Yii::app()->getClientScript()->registerScript('myFun',"function myFun(e){
							
							alert( 'e' );
							
					}",CClientScript::POST_END);*/
	Yii::app()->getClientScript()->registerScript('myscript','$("#txtAreaDescription").keyup(function(){
							
							//alert($("#txtAreaDescription\").name());
							var x =document.getElementById("txtAreaDescription").value.length;
							var msg_str="الوصف يجب ان يكون بين 250  و 500 حرف والعدد الحالي للحرف هو " + x;
							$("#textAreaFeedBack").html( msg_str );
							//$("#textAreaFeedBack").html( "Assaf" );
							//$("#textAreaFeedBack").value="Assaf";
							
					});'); 
					//var coun=$("#txtAreaDescription\").value.length;
	//$("#textAreaFeedBack").html( coun );
?>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-nestable/jquery.nestable.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo $baseUrl; ?>/assets/scripts/ui-nestable.js"></script>
<div class="row">
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">تفصيل</h4>
                </div>
                <div class="modal-body">

                    ما هو الفارق بين البحث/الدراسة والنموذج/الاختراع؟
                    يمكن أن ننفّذ المشروع العلمي وفقًا لأحد المسارين:</br></br>
                    1-    مسار البحث / الدراسة العلمية: وهو طريقة حل المشاكل من خلال التفكير العلمي، وإجراء الدراسات والتجارب، ويمكن أن ترفق هذه الدراسات بنماذج للتوضيح. والخطوات التي يمكن اتباعها في هذا المسار هي:
                    الملاحظة – المشكل – الفرضية – إثبات الفرضية – تحليل النتائج – الاستنتاج
                    Observation → Problème → Hypothèse → Vérification → Analyse des résultats → Conclusion
                    Observation → Problem → Hypothesis → Verification → Analysis of results → Conclusion
                    </br></br>
                    2-	مسار النموذج/الاختراع: وهو طريقة حل المشاكل من خلال التصميم الهندسي لنموذج Prototype وتنفيذه أو تصنيعه أو برمجته، وهو يمكن أن ينال براءة اختراع، كما ويمكن أن يرفق المشروع بدراسات وبحوث مساعدة.
                    </br></br>
                    جدول المقارنة بين الطريقتين:
                    </br></br>
                    مسار البحث/الدراسة</br>
                    أسأل السؤال / المشكل</br>
                    أقوم ببحث عن خلفية المشكل</br>
                    أضع الفرضية / أبين المتغيرات </br>
                    أصمم التجربة / أنفذ الخطوات</br>
                    أفحص الفرضية بواسطة التجربة / الاستمارات ...</br>
                    أحلّل النتائج وأستنتج</br>
                    ربط النتائج بما سبق</br>

                    </br></br>
                    -----------------------------------
                    </br></br>
                    مسار النموذج/الاختراع (التصميم الهندسي)</br>
                    أحدّد المشكل</br>
                    أقوم ببحث عن خلفية المشكل</br>
                    أحدّد الاحتياجات / الأدوات</br>
                    أجد حلولاً بديلة، أختار الأفضل بينها لأطوّره</br>
                    أصنع نموذجًا Prototype</br>
                    أفحص النموذج وأطور بناءً للحاجة</br>
                    ربط النتائج بما سبق</br>


                </div>
            </div>
        </div>
    </div>
</div>

<?php


if (isset($role) && $role==false) 
{
    ?>
    <div class = "well well-large">
        <h3 class = "text-center">

            لا يمكنك التعديل على مشروعك, الرجاء التواصل مع الأستاذ المشرف ليسمح لك التعديل على مشروعك</h3><br>
        <p class="text-center">
            للاستفسار والمراسلة: info@nasr.org.lb | www.facebook.com/sciencelb
        </p>
    </div>
    <?php
} else 
{
    ?>

    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'mb-project-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
        ?>

        <?php
        echo $form->errorSummary($model);

        echo "

<div class='alert alert-danger'>";
        echo $form->error($model, 'project_name');
        echo $form->error($model, 'project_name_en');
        echo $form->error($model, 'project_type');
        echo $form->error($model, 'project_stage');
        //echo $form->error($detail, 'pdetail_description');


        echo "</div>";
        ?>
        <div class="row">

            <div class="note note-success">
                <p>
                    يمكنك حفظ المعلومات المطلوبة للمشروع وإكمالها في أي وقت آخر وذلك بالدخول إلى صفحة تعديل المشاريع.

                </p>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3 "></div>
            <div class="col-md-6 ">
                <div class="col-md-4 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->

 				<a class='btn btn-warning btn-block' href="<?php echo Yii::app()->request->urlReferrer; ?>" style="text-decoration: none;">
                      <i class="icon-arrow-right"></i> رجوع
            	</a>

                    <?php
                    //echo CHtml::tag('button', array('class' => 'btn btn-warning btn-block'), '<i class="icon-arrow-left"></i> رجوع');
                    ?>

                </div>

                <div class="col-md-4 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <?php
                   		// echo CHtml::tag('button', array('class' => 'btn btn-danger btn-block'), '<i class="icon-cut"></i> مسح الكل');
                   		echo CHtml::resetButton('مسح الكل', array('class' => 'btn btn-danger btn-block'), '<i class="icon-cut"></i> مسح الكل');
                    ?>
                </div>

                <div class="col-md-4 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Submit', array('class' => 'btn purple btn-block')); ?>
                    <br>
                </div>

                <p class="note">جميع الخانات التي بجانبها <span class="required">*</span> ضرورية لإكمال عملية التسجيل.</p>
                <div class="portlet box blue">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-reorder"></i> تعديل
                        </div>
                        <div class="tools">
                            <a href="#" class="collapse"></a>

                        </div>


                    </div>
                    <div class="portlet-body form">

                        <div class="form-body">
                            <div class="form-group">

                                <?php echo $form->labelEx($model, 'project_name'); ?>
                                <?php echo $form->textField($model, 'project_name', array('class' => 'form-control', 'placeholder' => 'إسم المشروع بالعربي', 'size' => 60, 'maxlength' => 250)); ?>

                            </div>
                             <div class="form-group">

                                <?php echo $form->labelEx($model, 'project_name_en'); ?>
                                <?php echo $form->textField($model, 'project_name_en', array('class' => 'form-control', 'placeholder' => 'إسم المشروع بالأجنبي', 'size' => 60, 'maxlength' => 250)); ?>

                            </div>

                            <div class="form-group">
                                <?php
                                    $records = Mobarat::getCodeEnable(111);// cls_codes::getCodes_ByCodeKind(111);
                                    $list = CHtml::listData($records, 'code_no', 'code_name');
                                    echo $form->labelEx($model, 'project_type');
                                    echo $form->dropDownList($model, 'project_type', $list, array('empty' => 'اختر الفئة', 'class' => 'form-control'));
                                ?>
                            </div>


                           
                            
                            <?php
                            
			                   /* $n = new Functions();
			                    $school = MbSchool::model()->findAll('school_id=' . $n->getSchoolId());
								$filter='';
								if (count($school)>0){
									if ($school[0]['level'] == 'متوسط') {
										$filter='stage_id=1';
									}else if ($school[0]['level'] == 'ثانوي') {
										$filter='stage_id=2';
									}else{
										$filter='1=1';
									}
									$list=MbStage::model()->findAll($filter);	
								}*/
                                    if ($slevel == '03') 
                                        $filter="(code_no='01' or code_no='02')";
                                    else
                                        $filter="code_no='".$slevel."'";
                                    $records=cls_codes::getCodes_ByCodeKindQuery(106,$filter);
                                    $list = CHtml::listData($records, 'code_no', 'code_name');
								
                            ?>
							 <div class="form-group" >
                                <?php
                                echo $form->labelEx($model, 'project_stage');
                                echo $form->dropDownList($model, 'project_stage', $list, array('empty' => 'اختر المرحلة', 'class' => 'form-control'));
                                ?>
                            </div>	

							
                            <div class="form-group">

                                <?php echo $form->labelEx($model, 'project_description'); ?>
                                
                                <?php echo $form->textArea($model, 'project_description', array('class' => 'form-control', 'size' => 60
                                		, 'placeholder' => 'وصف المشروع: أكتب وصف عام للمشروع على ألا يقل عدد الأحرف عن ٢٥٠ و لا يزيد عن ٥٠٠', 'maxlength' => 500
										, 'id' => 'txtAreaDescription'
										)); ?>
										
								<div id="textAreaFeedBack"></div>

                            </div>






                            <div class="form-group" >
                                
                                <?php echo $form->labelEx($model, 'project_path'); ?>
                                <button style="cursor: pointer;" data-toggle="modal" href="#basic" type="button" class="btn blue"><i class="icon-question"></i></button>
                                <?php 
                                    $records = cls_codes::getCodes_ByCodeKind(110);
                                    $list = CHtml::listData($records, 'code_no', 'code_name');
                                    echo $form->dropDownList($model, 'project_path', $list, array('empty' => 'اختر مسار', 'class' => 'form-control'));
                                ?>
                            </div>



                            <div class="form-group">

                                <?php echo $form->labelEx($model, 'project_goal'); ?>
                                <?php echo $form->textArea($model, 'project_goal', array('class' => 'form-control', 'size' => 60, 'maxlength' => 250)); ?>

                            </div>

                            <div class="form-group">

                                <?php echo $form->labelEx($model, 'project_tools'); ?>
                                <?php echo $form->textArea($model, 'project_tools', array('class' => 'form-control', 'size' => 60, 'maxlength' => 250)); ?>

                            </div>

                            <div class="form-group">

                                <?php echo $form->labelEx($model, 'project_steps'); ?>
                                <?php echo $form->textArea($model, 'project_steps', array('class' => 'form-control', 'size' => 60, 'maxlength' => 250)); ?>

                            </div>

                            <div class="form-group">

                                <?php echo $form->labelEx($model, 'project_attachment'); 
                                ?>

                               يجب تحميل البوستر واي مستندات إضافية من خلال المرفقات</br>
                                لضغط الملف: جمع جميع الملفات في ملف واحد</br>
                                right click - send to - compressed zipped file   </br>

                                <input type='file' name='file'  accept = '.pdf,.zip,.rar' maxlength = "1" id = 'upload_student' onchange='handleFiles(this.files)'/>
                                <?php //echo $form->textField($detail, 'pdetail_attachment', array('class' => 'form-control', 'placeholder' => 'إسم المشروع', 'size' => 60, 'maxlength' => 250));     
                                ?>
                                
                            </div>

                            <div class="col-md-4 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>







    <div id="regstd" class="row">


    </div>

    <?php $this->endWidget(); ?>

    </div><!-- form -->

    <?php
}
?>
<script>
var inputElement = document.getElementById("upload_student");
inputElement.addEventListener("change", handleFiles, false);

function handleFiles() {
  var str =this.files[0].name ;
   //alert(str);
   var ext = str.substr(str.lastIndexOf(".") + 1);
   //alert(ext);
  if (!(ext=="pdf" || ext== "rar" || ext=="zip"))
  {
      this.files=null;
       alert("Only pdf, rar and zip accepted" ); /* now you can work with the file list */
  }
    //else
      
}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#textAreaFeedBack').html('');
		
	});
</script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo $baseUrl; ?>/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo $baseUrl; ?>/assets/scripts/app.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/tasks.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/portlet-draggable.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/assets/plugins/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/table-advanced.js" type="text/javascript"></script>
<script src="<?php echo $baseUrl; ?>/assets/plugins/jquery-nestable/jquery.nestable.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo $baseUrl; ?>/assets/scripts/ui-nestable.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.MetaData.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.MultiFile.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.blockUI.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/jquery.form.js"></script>
<script src="<?php echo $baseUrl; ?>/assets/scripts/update.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        App.init(); // initlayout and core plugins
        Index.init();
        Index.initJQVMAP(); // init index page's custom scripts
        Index.initCalendar(); // init index page's custom scripts
        Index.initCharts(); // init index page's custom scripts
        Index.initChat();
        Index.initMiniCharts();
        PortletDraggable.init();
        Index.initDashboardDaterange();
        Index.initIntro();
        Tasks.initDashboardWidget();
        TableAdvanced.init();
        UINestable.init();
    });
</script>
<!-- END JAVASCRIPTS -->
<script type="text/javascript">  var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-37564768-1']);
    _gaq.push(['_setDomainName', 'keenthemes.com']);
    _gaq.push(['_setAllowLinker', true]);
    _gaq.push(['_trackPageview']);
    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        //    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://')
        +'stats.g.doubleclick.net/dc.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();</script>