<?php
/* @var $this MbUserController */
/* @var $model MbUser */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'mb-user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="note note-success">تغيير كلمة المرور</p></div>

	<?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->error($model,'user_password'); ?>
    
    <div class="row">
        <div class="col-md-3 "></div>
        <div class="col-md-6 ">
            <div class="col-md-8 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-reorder"></i> 
                    </div>
                    <div class="tools">
                        <a href="#" class="collapse"></a>

                    </div>


                </div>
                <div class="portlet-body form">

                    <div class="form-body">
                     <div class="form-group">
		<?php echo $form->labelEx($model,'user_password'); ?>
        <div class="input-icon">
        <i class="icon-user"></i>
     <?php echo $form->passwordField($model, 'user_password', array('class' => 'form-control', 'placeholder' => 'كلمة المرور', 'size' => 60, 'maxlength' => 250,)); ?>
</div></br>


                <?php echo CHtml::submitButton($model->isNewRecord ? 'تأكيد' : 'تأكيد', array('class' => 'btn green btn-block')); ?>

        

		
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
	</div>


	<div class="row buttons">
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->