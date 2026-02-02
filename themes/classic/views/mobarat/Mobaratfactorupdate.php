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
تحديد معايير التحكيم
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
        <table>
            <?php
                $counter=0;
                 foreach ($factors as $fact) {
                     ?>
            <tr>
                <td><?php echo $fact['code_name']; ?></td>
                <td><?php echo CHtml::textField('factors['.$counter.'][factor_value]',$fact['factor_value'],array('id'=>'factors['.$counter.']["factor_value"]','class' => 'form-control '));?>
                    <input type = hidden name="<?php echo 'factors['.$counter.'][id]' ?>" id="'.$this->name.'H" value="<?php echo $fact['id'] ?>">
                </td>
           
            </tr>
            <?php
            $counter++;
                 }
            ?>
           
           
        </table>
    


<div></div>
<br><br>

    <?php $this->endWidget(); ?>

</div><!-- form -->