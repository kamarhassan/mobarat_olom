<?php
$form = $this->beginWidget('CActiveForm', array(
    //'id' => 'mb-school-form122',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => TRUE,
));
?>
<script>
    function calculatetotal() {
        <?php
        $strCode = '';
        $strValue = '';
        foreach ($factors as $p) {
            if (strlen($strCode) > 0) {
                $strCode .= ',';
                $strValue .= ',';
            }
            $strCode .= '"' . $p['factor_type'] . '"';
            $strValue .= $p['factor_value'];
        }
        $strCode = 'var factorCode=[' . $strCode . '];';
        $strValue = 'var factorValue=[' . $strValue . '];';
        $strCount = 'var intCount=' . count($grades) . ';';
        echo $strCode;
        echo $strValue;
        echo $strCount;
        ?>
        var total = 0; 
        var sum_of_initial_fields = 0;
        for (i = 0; i < intCount; i++) {
            var f = document.getElementById("project_judge_grade[" + i + "][grade_value]");
            var t = document.getElementById("project_judge_grade[" + i + "][grade_type]");
            for (j = 0; j < factorCode.length; j++) {


                if (t.value == factorCode[j]) {
                    sum_of_initial_fields +=  factorValue[j] ;
                    total += parseFloat(f.value);
                    // console.log(' factor value  ' + factorValue[j] + ' f.value ' + f.value + ' f.value ' + f.value + 'total ' + total);
                }
                console.log('total  ' + total+ '\n sum_of_fields ' + sum_of_initial_fields );
            }
            // alert(f.value);
        }
        var f = document.getElementById("Total");
        f.innerHTML = "<b>" + (total/sum_of_initial_fields)*10 + "</b>";
        //alert(total);
    }
</script>
<h3>
    <b>المشروع: </b><?php echo $details['project_name']; ?>
</h3>
<h4>
    <b>المدرسة: </b><?php echo $details['school_name']; ?><br>
    <b>المرحلة: </b><?php echo $details['project_stage']; ?>
</h4>
<h4>
    <b>وصف المشروع: </b><?php echo $details['project_description']; ?>
</h4>

<div class="row">
    <div class="col-md-3 ">
        <a class='btn btn-warning btn-block' href="<?php echo $this->createAbsoluteUrl('Personjudge/Judgeproject/' . $judgepersonId) ?>" style="text-decoration: none;">
            <i class="icon-arrow-right"></i> رجوع
        </a>
    </div>
    <div class="col-md-3 ">
        <?php echo CHtml::submitButton('حفظ', array('class' => 'btn purple btn-block')); ?>
        <br>
    </div>
</div>
<div class="row">

    <!--<div class="portlet box blue"> 
            <div class="portlet-title">
           <div class="caption"><i class="icon-bar-chart"></i>تقرير</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div> -->

    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-body">

                <!---->
                <?php if (strlen($msg) > 0) { ?>

                    <p style="color: red"> <b><?php echo $msg ?></b> </p>
                <?php } ?>
                <div class="table-scrollable">

                    <table class="table table-bordered" style="display:block ; height:350px;;overflow:auto">
                        <thead>
                            <tr>
                                <!--  
                            <th>مشروع إضافي</th>
                            <th>إرسال</th>
                          -->
                                <th>#</th>

                                <th>المعيار</th>
                                <th>العلامة</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $eo = 0;
                            foreach ($grades as $p) {

                                $eo++;
                                if ($eo % 2 == 0)
                                    $bgcolor = "#ffffff";
                                else
                                    $bgcolor = "#f9f9f9";


                            ?>

                                <tr bgcolor="<?php echo $bgcolor; ?>">


                                    <td>
                                        <center><?php echo $eo; ?></center>
                                    </td>




                                    <td><b><?php echo $p['code_name']; ?></b></td>

                                    <td width="150"><?php
                                                    echo CHtml::textField('project_judge_grade[' . ($eo - 1) . '][grade_value]', $p['grade_value'], array('id' => 'project_judge_grade[' . ($eo - 1) . '][grade_value]', 'class' => 'form-control', 'onchange' => 'calculatetotal()'));

                                                    ?> <input type=hidden name="<?php echo 'project_judge_grade[' . ($eo - 1) . '][project_judge__Grade_id]' ?>" id="<?php echo 'project_judge_grade[' . ($eo - 1) . '][project_judge__Grade_id]' ?>" value="<?php echo $p['project_judge__Grade_id'] ?>">
                                        <input type=hidden name="<?php echo 'project_judge_grade[' . ($eo - 1) . '][grade_type]' ?>" id="<?php echo 'project_judge_grade[' . ($eo - 1) . '][grade_type]' ?>" value="<?php echo $p['grade_type'] ?>">
                                    </td>


                                </tr>
                            <?php } ?>
                            <tr>
                                <td></td>
                                <td><b>المعدل</b></td>
                                <td>
                                    <div id="Total"><b><?php echo $score ?></b></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h4>المعدل على 20 بناء على التثقيل لكل معيار</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 ">
        <a class='btn btn-warning btn-block' href="<?php echo $this->createAbsoluteUrl('Personjudge/Judgeproject/' . $judgepersonId) ?>" style="text-decoration: none;">
            <i class="icon-arrow-right"></i> رجوع
        </a>
    </div>
    <div class="col-md-3 ">
        <?php echo CHtml::submitButton('حفظ', array('class' => 'btn purple btn-block')); ?>
        <br>
    </div>
</div>
<div>
    <h4>المعيار 1 المنهجية العلمية: مفيد للعلم، الانسان، حل مشكلة، تحديث العلوم، فهم جديد لمسائل معروفة
        <br>المعيار 2 المحتوى العلمي ودقتهه: ما مدى دقة المعلومات او النظريات العلمية المستخدمة، هل يواكب الحداثة في العلوم uptodate 150
        <br>المعيار 3 العرض الشفهي: دقة المعلومات/النظريات، جودة الانتاج/الصيغة النهائية، الثبات والمتانة عند العرض، منهجية التفكير العلمي المعتمد، مهارة ذاتية بدون تدخل ...
        <br>المعيار 4 البوستر والعرض: مهارة العرض، مهارة المنافسة والاقناع، اللغة، اللياقة والترتيب، التقيد بحجم البوستر ...
        <br>المعيار 5 الابتكار والابداع والهدف: الفكرة جديدة او قديمة، إمكان نيلها براءة اختراع، استنتاج ذاتي، هل حقق المشروع الهدف

    </h4>

</div>
<div id="tytyty"></div>

<?php $this->endWidget(); ?>