<?php ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>


<script >
     function validate(form)
    {
       
        var error = 0;
        var msg='';

      
/*
        if(form.prs_photoName.files && form.prs_photoName.files[0]){
            form.prs_photoNamePreview.style.border = '1px solid  #FF0000';
            error++;
        }
        */
       //alert(form.prs_photoNamePreview.src);
       return true;
        if(form.prs_photoNamePreview.src==
            <?php $cls1=new cls_attach(); echo "'". $cls1->getEmptyPictureURL(enm_Program::PERSON) ."'";?>)
                    {
                        error++;
                        msg=msg+'يجب تحديد صورة' + '<br>';
                        form.prs_photoNamePreview.style.border = '2px solid  #FF0000';
                    }
                    //alert(form.txtFname.value);
                    //alert($('#txtFname').value);
        if(form.txtFname.value.trim() == "")
        {form.txtFname.style.border = '2px solid  #FF0000';error++;msg=msg+'يجب تحديد الاسم' + '<br>';}
        else
            form.txtFname.style.border =null;
        
        if(form.txtLname.value.trim() == "")
        {form.txtLname.style.border = '2px solid  #FF0000';error++;msg=msg+'يجب تحديد الشهرة' + '<br>';}
        else
            form.txtLname.style.border =null;
        
         if(form.txtEFname.value.trim() == "")
        {form.txtEFname.style.border = '2px solid  #FF0000';error++;msg=msg+'يجب تحديد الاسم بالانكليزية' + '<br>';}
        else
            form.txtEFname.style.border =null;
        if(form.txtELname.value.trim() == "")
        {form.txtELname.style.border = '2px solid  #FF0000';error++;msg=msg+'يجب تحديد الشهرة بالانكليزية'  + '<br>';}
        else
            form.txtELname.style.border =null;
         
         
        if (error > 0)
        {
            
            if (document.getElementById)
            {
                errorMessage = document.getElementById('errorHint');
                if (errorMessage)
                {
                    errorMessage.innerHTML = msg;
                }
            }
            return false;
        }

        return true;
    }
    
    function InitPage()
    {
        InitPictureControls('prs_photoName','prs_photoNameBtn','prs_photoNamePreview');
    }
</script>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'person-officialTeacher',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
       //'htmlOptions' => array('enctype' => 'multipart/form-data','onSubmit'=>'return validate(this);')
    ));
    ?>


    <?php
    /*
    echo "<div id='errorHint' class='alert alert-danger'>";
    echo $form->error($model, 'Person_Salutation');
    echo $form->error($model, 'Person_fname');
    echo $form->error($model, 'Person_lname');
    echo $form->error($model, 'Person_efname');
    echo $form->error($model, 'Person_elname');
    echo $form->error($model, 'Person_email1');
    echo $form->error($model, 'Person_CellPhone');
    echo $form->error($oteach, 'oteacher_description');
   
    echo "</div>";
    */
    ?>
    <div class="row">
        <div class="col-md-3 "></div>
        <div class="col-md-6 ">


            <div class="col-md-4 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <?php echo CHtml::submitButton($model->isNewRecord ? 'حفظ البيانات' : 'Save', array('class' => 'btn green btn-block', 'url' => ('School/completeReg'))); ?>
                <br>
            </div>

            <p class="note">جميع الخانات التي بجانبها <span class="required">*</span> ضرورية لإكمال عملية التسجيل.</p>



            <?php $this->renderPartial('/person/_Fields',array('form'=>$form,'title'=>'معلومات الاستاذ المسؤول '
	,'model'=>$model,'enmPersonType'=>$enmPersonType,'oteach'=>$oteach
)); ?>
        </div>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    
   
    InitPage();

</script>
