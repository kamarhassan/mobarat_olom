<?php $user = MbUser::model()->findByAttributes(array('user_id' => Yii::app()->user->id)); ?>
    <?php
    if ($user->user_type == 3) {
        echo $this->renderPartial('../mbStudent/sidebar');
    }
    if ($user->user_type == 4) {
        echo $this->renderPartial('../mbTeacher/sidebar');
    }
    if ($user->user_type == 2) {
        echo $this->renderPartial('../mbSchool/sidebar');
    }
    if ($user->user_type == 1) {
        echo $this->renderPartial('../mbAdmin/sidebar');
    }
