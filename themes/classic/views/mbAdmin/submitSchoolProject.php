<?php $baseUrl = Yii::app()->theme->baseUrl; ?>

<?php echo CHtml::ajaxLink('<button type="button" class="btn blue ">
                                       إنهاء المدارس
                                    </button>', array('MbAdmin/PresentDay')); ?>


<?php echo CHtml::ajaxLink('<button type="button" class="btn green ">
                                      إنهاء المشاريع
                                    </button>', array('MbAdmin/FinalProject')); ?>