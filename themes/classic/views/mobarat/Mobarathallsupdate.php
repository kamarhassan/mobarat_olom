<?php
/* @var $this MbInfoAdminController */
/* @var $model MbInfoAdmin */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mb-info-admin-form',
        'enableAjaxValidation' => true,
    ));
    ?>


 <div class="note note-success">
                <p>
تحديد عدد الاجنحة في القاعات
                </p>
            </div>   
    <div class="row">
        <div class="col-md-4 ">
            <a class='btn btn-warning btn-block' href="<?php echo Yii::app()->request->urlReferrer; ?>" style="text-decoration: none;">
                      <i class="icon-arrow-right"></i> رجوع
            </a>
        </div>
        <div class="col-md-4 ">
            <?php echo CHtml::submitButton( 'حفظ', array('class' => 'btn purple btn-block')); ?>
            <br>
        </div>
        </div>
    <?php if(strlen($msg)>0){?>
    
    <p  style="color: red"> <b><?php echo $msg?></b> </p>
<?php }?>
    <div >
        <table class="table table-bordered" >
            <thead>
            <th>القاعة</th>
            <th>العدد الإجمالي للأجنحة</th>
            <th>الاجنحة التي تتسع الى مشروعين</th>
            <th>أرقام الأجنحة التي تتسع الى مشروعين</th>
            </thead>
            <?php
                $counter=0;
                 foreach ($halls as $fact) {
                     ?>
            <tr>
                <td>
                    <?php echo $fact['code_name']; ?>
                    <input type = hidden name="<?php echo 'halls['.$counter.'][id]' ?>" id="'.$this->name.'H" value="<?php echo $fact['id'] ?>">
                </td>
                <td>
                    <?php echo CHtml::textField('halls['.$counter.'][suite_total]',$fact['suite_total'],array('id'=>'halls['.$counter.']["suite_total"]','class' => 'form-control '));?>
                </td>
                <td>
                    <?php echo CHtml::textField('halls['.$counter.'][suite2_desc]',$fact['suite2_desc'],array('id'=>'halls['.$counter.']["suite2_desc"]','class' => 'form-control ','style'=>'direction:ltr'));?>
                </td>
                <td style="direction: ltr">
                    <?php
                        if(Mobarat::validateSuite2desc($fact['suite2_desc'], $fact['suite_total'])){
                           $suites= Mobarat::getListSuite2desc($fact['suite2_desc']);
                            foreach($suites as $s){
                                echo $s.' ';
                            } 
                        }
                    ?>
                </td>
           
            </tr>
            <?php
            $counter++;
                 }
            ?>
           
           
        </table>
    
 <div class="note ">
                <p>
                    مثال لتحديد  الاجنحة التي تتسع الى مشروعين<br>
                    لنفترض أن عدد الاجنحة الاجمالي 100 <br>
                    وان الاجنحة التي تحتوي على مشروعين هي: من 25 إلى 35 والجناح رقم 51 ومن 87 إلى 92<br>
                    فتكون قيمة الحقل: 25-35;51;87-92
                </p>
            </div> 

<div></div>
<br><br>

    <?php $this->endWidget(); ?>

</div><!-- form -->