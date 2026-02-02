<?php
$baseUrl = Yii::app()->theme->baseUrl;

?>

<h3 class="page-title">
    إختيار سنة أخرى 
</h3>
<h2 class="page-title">
    السنة الحالية <?php
   
    echo $mobarat['mobarat_year'];
    //$n = new Functions;
   // echo $n->getYear();
    ?>
</h2>
<h2 class="page-title" color="red">
يرجى الالتفات أنه عند تعديل السنة سوف يتم تحويل كل طلبات التسجيل الجديدة للمدارس والمشاريع الى هذه السنة
</h2>

<div class="portlet box blue">
    <div class="portlet-title">
        <div class = "caption">
            <i class = "icon-reorder"></i> اختر السنة </div>
    </div>
    <div class="portlet-body">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'mb-message-form',
            'enableAjaxValidation' => false,
        ));
        ?>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    
                    <?php echo CHTML::dropDownList('mobaratyear',null, $list, array('empty' => 'اختر السنة', 'class' => 'form-control'));
                    ?>
                </div>
                
                <div class="margin-top-10">
                    <?php
                    echo CHtml::submitButton('موافق', array('class' => 'btn blue', 'confirm' => 'هل أنت متأكد من تغير السنة'), '<i class="icon-ok"></i> ');
                   
                    ?>
                </div>
               
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
    