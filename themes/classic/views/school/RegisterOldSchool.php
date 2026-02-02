
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

<?php //$records = MbSchool::model()->findAll('school_flag=2 AND school_name!="" AND school_user!=""');
       // $records = School::model()->findAll('1=1');
?>

<div class="note note-success">
    <p>
        إذا كنت مدرسة مشاركة سابقاً، ولم تجد مدرستك هنا، الرجاء التواصل معنا عبر: <?php echo $phone ?>
    </p>
</div>

<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-7 ">

        <div class="portlet box green">

            <div class="portlet-title">
                <div class="caption">

                    <i class="icon-reorder"></i>
                    المعلومات
                </div>
                <div class="tools" id="tools-info" >
                    <a href="javascript:;" class="reload" data-original-title="" title="" style="display: none">
                    </a>
                    <a href="#" class="collapse"></a>

                </div>

            </div>
            <div class="portlet-body" style="min-height: 100px;" id="portlet-info">

                <div id='k'></div>

            </div>
        </div>

        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i> الرجاء إختيار المدرسة أو البحث
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
                                <?php foreach ($schls as $value) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo CHtml::ajaxLink($value['school_name'], array('School/AjaxRegisterOldSchool'), array(
                                                'update' => '#k',
                                                'data' => array('id' => $value['school_id']),
                                                'beforeSend' => 'js:function(e){$(".reload").click();}',
                                                'complete' => 'js:function(e){var el = $("#portlet-info");App.unblockUI(el);}'
                                            ));
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table></div></div>

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

