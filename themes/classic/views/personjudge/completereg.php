
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mb-project-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

  </div>

<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-6 ">
        <div class="col-md-4 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->

           


        </div>

                <div class="col-md-4 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <?php echo CHtml::submitButton('Submit', array('class' => 'btn purple btn-block')); ?>
            <br>
        </div>

       
        <div class="portlet box blue">

            <div class="portlet-title">
                <div class="caption">
                  
                    <h1> هل تقبل المشاركة في التحكيم لمباراة العلوم لعام <?php echo $my?><br>
                        والتي سوف تجري بتاريخ <?php echo $firstDay ?> و  <?php echo $secondDay ?> 
                    </h1>                   
                </div>



            </div>
            <div class="portlet-body form">

                <div class="form-body">
                    <div class="form-group">

                        <?php echo CHtml::RadioButton('rbbb',true, array('id'=>'rbbb','value'=>1,  'style' => 'float: none;margin-right: 0px;')); echo"\t\t";

                    ?>نعم

                    <?php echo CHtml::RadioButton('rbbb',false, array( 'id'=>'rbbb','value'=>0, 'style' => 'float: none;margin-right: 0px;')); echo"\t\t";

                    ?>كلا
                    </div>
                    
                     <div class="form-group" id="txtarea">

                               
                                
                                <?php echo CHtml::textArea( 'notes','', array('class' => 'form-control', 'size' => 60
                                		, 'placeholder' => 'في حال كان الجواب كلا، يرجى كتابة سبب الرفض', 'maxlength' => 500
										, 'id' => 'txtAreaDescription'
										)); ?>
										
								<div id="textAreaFeedBack"></div>

                            </div>
                    
                   

                    <div class="col-md-4 ">
                        <!-- BEGIN SAMPLE FORM PORTLET-->

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<?php $this->endWidget(); ?>





