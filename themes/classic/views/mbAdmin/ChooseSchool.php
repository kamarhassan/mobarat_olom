
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mb-school-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<?php $records = MbSchool::model()->findAll('school_flag=1'); ?>






<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-7 ">



        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> لتأكيد حضور المدرسة الرجاء الضغط على الإسم
                </div>
                <div class="tools">
                    <a href="#" class="collapse"></a>

                </div>

            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">
                            <tbody>
                                <?php foreach ($records as $value) { ?>
                                    <tr>
                                        <td>

                                            <?php //echo CHtml::ajaxLink($value->school_name, array('MbAdmin/ShowSchoolInfo'), array('update' => '#k' ,'data' => array('id' => $value->school_id)));?>

                                            <a href="<?php echo $this->createAbsoluteUrl('MbAdmin/ShowRecords/' . $value->school_id); ?>" target="_blank"><?php echo $value->school_name; ?></a>                                </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table></div></div>



            </div>




        </div>
    </div>




</div>

</div>
<style>
    .col-md-6{
        display:none;
    }
</style>

<?php $this->endWidget(); ?>
