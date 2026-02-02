<?php

//$baseUrl = Yii::app()->theme->baseUrl;
//if (Yii::app()->controller->action->id != 'rgChooseProject') {
$user = MbUser::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
if ($user->user_type == 2) {
    echo $this->renderPartial('../mbSchool/photoNavbar');
} else {
    if ($user->user_type == 4) {
        echo $this->renderPartial('../mbTeacher/photoNavbar');
    } if ($user->user_type == 3) {
        echo $this->renderPartial('../mbStudent/photoNavbar');
    } else if ($user->user_type == 1) {
        echo $this->renderPartial('../mbAdmin/photoNavbar');
    }
}
?>