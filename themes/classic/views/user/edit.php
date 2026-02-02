<?php
/* @var $this MbProjectController */
/* @var $model MbProject */
/* @var $form CActiveForm */
?>
<!--
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>
-->
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
    ));
    ?>

   

    <?php
    echo "

<div class='alert alert-danger'>";
    echo $form->error($model, 'user_mun');
    echo $form->error($model, 'user_password');
   


    echo "</div>";
    ?>



<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-6 ">
        <div class="col-md-4 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->

            <a class='btn btn-warning btn-block' href="<?php echo Yii::app()->request->urlReferrer; ?>" style="text-decoration: none;">
                <?php
                //echo CHtml::tag('button', array('class' => 'btn btn-warning btn-block'), '<i class="icon-arrow-right"></i> رجوع');
                ?>
                <i class="icon-arrow-right"></i> رجوع
            </a>


        </div>

        <div class="col-md-4 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Submit', array('class' => 'btn purple btn-block')); ?>
            <br>
        </div>

        <div class="portlet box blue">
            <div class="portlet-body form">

                <div class="form-body">
                    <div class="form-group">

                        <?php echo $form->labelEx($model, 'user_mun'); ?>
                        <?php echo $form->textField($model, 'user_mun', array('class' => 'form-control', 'placeholder' => 'MUN', 'size' => 60, 'maxlength' => 250,'readonly'=>true)); ?>

                    </div>
                    
                    <div class="form-group">

                        <?php echo $form->labelEx($model, 'user_password'); ?>
                        <?php echo $form->textField($model, 'user_password', array('class' => 'form-control', 'placeholder' => 'كلمة المرور', 'size' => 60, 'maxlength' => 250)); ?>

                    </div>
                    <div class="col-md-4 ">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        
                      

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<div class="form-body">
     
<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-6 ">
                <div class="portlet box blue">
            <div class="portlet-body form">
                   <?php
                           $tt= $this->widget('CTreeView',array(
                                'id'=>'pg-tree-view'
                                ,'data'=>array(array('text'=>'الصلاحيات','children'=>$pages))
                                ,'animated'=>'fast'
                                ,'collapsed' => false
                                ,'htmlOptions'=>array('class'=>'treeview-famfamfam')
                                
                            ));
                           //$tt->collapsed=FALSE;
                        ?>
                            </div>
                </div>
        </div>
</div>
</div>
<?php $this->endWidget(); ?>
</div>
<script>
    /*
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}*/
</script>



