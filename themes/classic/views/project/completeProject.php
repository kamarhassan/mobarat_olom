<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-6 ">
        <div class="form-actions">


            <h1> هل أنت الأستاذ المشرف على المشروع؟</h1>
            <?php
            
            //echo CHtml::ajaxLink($b, array('MbOfficialTeacher/copyToTeacher', 'hi'), array('update' => '#test', 'data' => array('ids' => $id), 'success' => 'js:function(){window.location="../../MbSchool/updateProject/"}',));
            ?>


            <a href="<?php echo Yii::app()->createAbsoluteUrl('Project/SetTeacher'); ?>">
                <button type="button" id="back-btn" class="btn btn-block green">نعم</button>
            </a>

            <br>
            <a href="<?php echo Yii::app()->createAbsoluteUrl('Personteacher/regStep1/sclid/'.$schoolid); ?>">
                <?php echo CHtml::tag('button', array('class' => 'btn btn-warning btn-block'), '<i class="icon-remove"></i> كلا'); ?>

            </a>

            <div id="yes"></div>

        </div>
    </div>
</div>

<div id="test"></div>