
<?php
$baseUrl = Yii::app()->theme->baseUrl;
if (Yii::app()->controller->id == 'mbSchool' && (Yii::app()->controller->action->id == 'completeReg' || Yii::app()->controller->action->id == 'create' || Yii::app()->controller->action->id == 'update' || Yii::app()->controller->action->id == 'ajax' || Yii::app()->controller->action->id == 'create' || Yii::app()->controller->action->id == 'confirmationOld' || Yii::app()->controller->action->id == 'oldSchoolNewTeacher' || Yii::app()->controller->action->id == 'activationForm')) {
    ?>
    <img alt="" src="<?php echo $baseUrl; ?>/assets/img/photo/null.jpg" style="border:1px solid white; width: 29px;height: 29px;"/>
    <span class = "username">
    </span>
    <i class = "icon-angle-down"></i>
    <?php
} else {
    $info = MbSchool::model()->findByAttributes(array('school_user' => Yii::app()->user->id));
    $user = MbUser::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
    if ($user->user_type == 3) {
        echo $this->renderPartial('../mbStudent/photoNavbar');
    } else
    if ($user->user_type == 4) {
        echo $this->renderPartial('../mbTeacher/photoNavbar');
    } else {
        if ($info) {
            if ($user->user_pic == '') {
                ?>
                <img alt="" src="<?php echo $baseUrl; ?>/assets/img/photo/null.jpg" style="border:1px solid white; width: 29px;height: 29px;"/>
            <?php } else { ?>
                <img alt="" src="<?php echo $baseUrl; ?>/assets/attachments/photo/<?php echo Yii::app()->user->id; ?>/<?php echo $user->user_pic; ?>" style="border:1px solid white; width: 29px;height: 29px;"/>
                <?php
            }
        }
        ?>
        <span class="username"><?php echo $info->school_name; ?></span>
        <i class="icon-angle-down"></i>

        <?php
    }
}
?>
