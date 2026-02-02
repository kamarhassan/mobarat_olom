<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mb-student-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <div class="note note-success">

        <p>
            يرجى كتابة إيميل الاستاذ المشرف فقط وسوف يصله بريد إلكتروني يطلب منه إدخال معلوماته الشخصية لتسجيله في المشروع.
        </p>
    </div>
    <div class="row">
        <div class="col-md-3 "></div>
        <div class="col-md-7 ">

            <div class="portlet box green">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-reorder"></i> تسجيل أستاذ مشرف جديد
                    </div>
                    <div class="tools">
                        <a href="#" class="collapse"></a>

                    </div>

                </div>
                <div class="portlet-body form">


                    <br>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="icon-envelope"></i></span>
                    <?php echo $form->emailField($model, 'Person_email1', array('class' => 'form-control', 'placeholder' => 'البريد الإلكتروني', 'required' => 'required', 'size' => 50, 'maxlength' => 50)); ?>
                     <?php echo $form->error($model, 'Person_email1'); ?>
                    </div>
                    <br>
<?php echo CHtml::submitButton($model->isNewRecord ? 'حفظ البيانات' : 'Save', array('class' => 'btn h btn-block', 'url' => ('Personstudent/Person_email1'))); ?>


                </div>

            </div>

        </div>



    </div>
</div>

</div>


<?php $this->endWidget(); ?>
</div><!-- form -->