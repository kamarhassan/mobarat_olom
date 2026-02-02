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
class PersonjudgeFilter extends CFilter {

    //put your code here
    protected function preFilter($filterChain) {
       /* $userType = MbUser::model()->find('user_id=' . Yii::app()->user->id)->user_type;
       
        if (Yii::app()->controller->action->id == 'create' && $userType == 3 && $userType == 4) {
            return false;
        }
        return true;*/
        if(isset(Yii::app()->session['clsPerson']))
        {
            //return true;
            $clsPerson=Yii::app()->session['clsPerson'];
            $current=  Mobarat::getOpenMobaratRecord();
            if($clsPerson->user_type=='01')
                    return true;
           
            elseif(User::isJudgeParticipant($current['mobarat_year'],Yii::app()->user->id))
            {
                //return true;
                 if (Yii::app()->controller->action->id == 'completereg' 
                         || Yii::app()->controller->action->id == 'Judgeproject' 
                         || Yii::app()->controller->action->id == 'Judgeprojectrate'){
                    // $s= Personstudent::model()->findByPk(Yii::app()->request->getParam('id'));
                        if(Yii::app()->request->getParam('id')==$clsPerson->person_id){
                           return true;
                        }
                 }else if (Yii::app()->controller->action->id == 'SelectEnable' 
                         || Yii::app()->controller->action->id == 'SetEvening'){
                    // $s= Personstudent::model()->findByPk(Yii::app()->request->getParam('id'));
                        if(Yii::app()->request->getParam('person_id')==$clsPerson->person_id){
                           return true;
                        }
                 }
            }
          
        }
        return false;
    }

}
