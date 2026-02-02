<?php
//$baseUrl = Yii::app()->theme->baseUrl;
//if (Yii::app()->controller->action->id != 'rgChooseProject') {
if(isset( Yii::app()->session['clsPerson'] ))
{
    $clsPerson=Yii::app()->session['clsPerson'];
    $pict=cls_attach::getPictureURL(enm_Program::PERSON,$clsPerson->person_id,$clsPerson->pic,$bolExists);
 ?>   
    <img alt="" src="<?php echo $pict; ?>" style="border:1px solid white; width: 29px;height: 29px;"/>

    <span class="username"><?php echo $clsPerson->name ?></span>
    <i class="icon-angle-down"></i>
     <?php
}
/*  
$user = MbUser::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
if ($user->user_type == 2) {
    echo $this->renderPartial('../mbSchool/photoNavbar');
} else
if ($user->user_type == 4) {
    echo $this->renderPartial('../mbTeacher/photoNavbar');
} if ($user->user_type == 3) {
    echo $this->renderPartial('../mbStudent/photoNavbar');
} else {

    $baseUrl = Yii::app()->theme->baseUrl;
    $user = MbUser::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
 * 
 */


?>
