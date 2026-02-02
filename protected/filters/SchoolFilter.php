<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminFilter
 *
 * @author Hassan
 */
class SchoolFilter extends CFilter {

    //put your code here
    protected function preFilter($filterChain) {
        // ,'','','CompleteReg',''
        $current=  Mobarat::getOpenMobaratRecord();
        //$d = new DateTime();
        //$date = $d->format('Y-m-d');
        
        //if ((strtotime($date) < strtotime($current['last_register_school'])) 
        if (Mobarat::isOpenForRegisterSchool($current) 
                && (Yii::app()->controller->action->id == 'RegisterOldSchool'
                    || Yii::app()->controller->action->id == 'AjaxRegisterOldSchool'
                    || Yii::app()->controller->action->id == 'RegisterOldSchoolNewTeacher'
                    || Yii::app()->controller->action->id == 'activationForm'
                    || Yii::app()->controller->action->id == 'confirmationOld' 
                    || Yii::app()->controller->action->id == 'completeReg' 
                    || Yii::app()->controller->action->id == 'create')) {
            return true;
        }
        if(isset(Yii::app()->session['clsPerson']))
        {
            $clsPerson=Yii::app()->session['clsPerson'];

            if($clsPerson->user_type=='01')
                    return true;
            else{
                //Mobarat::isOpenForUpdate($current)
                //if ((strtotime($date) < strtotime($current['last_update'])) && Yii::app()->controller->action->id == 'update'){
                if ((Mobarat::isOpenForUpdate($current)) && Yii::app()->controller->action->id == 'update'){
                   $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                           ' and school_id='.Yii::app()->request->getParam('id').
                           ' and oteacher_personid='.$clsPerson->person_id);
                   return $exists;
                }
            }
        }
        /*$userType = MbUser::model()->find('user_id=' . Yii::app()->user->id)->user_type;
        if ($userType == 3 && $userType == 4) {
            return false;
        } else if ($userType == 2) {
            if (Yii::app()->controller->action->id == 'update') {
                $schoolUser = MbSchool::model()->find('school_id=' . Yii::app()->request->getParam('id'))->school_user;
                if ($schoolUser != Yii::app()->user->id)
                    return false;
            }
        }*/
        

    return false;
}
}
