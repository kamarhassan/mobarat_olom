<?php

//$flag = MbUser::model()->findAll('school_user'=>Yii::app()->user->id);

if ($flag == 2) {
    header('Refresh:10;url=' . $this->createUrl('MbSchool/index'));
}
?>


