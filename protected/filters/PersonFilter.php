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
class PersonFilter extends CFilter {

    //put your code here
    protected function preFilter($filterChain) {
       /* $userType = MbUser::model()->find('user_id=' . Yii::app()->user->id)->user_type;
       
        if (Yii::app()->controller->action->id == 'create' && $userType == 3 && $userType == 4) {
            return false;
        }
        return true;*/
        //return true;
        if(isset(Yii::app()->session['clsPerson']))
        {
            $clsPerson=Yii::app()->session['clsPerson'];
            $current=  Mobarat::getOpenMobaratRecord();
            if($clsPerson->user_type=='01')
                    return true;
            else{
                //$d = new DateTime();
                //$date = $d->format('Y-m-d');
                //$date='2015';
                 //
                if (Yii::app()->controller->action->id == 'update')
                    if(User::isJudgeParticipant($current['mobarat_year'],Yii::app()->user->id)){
                        //if (strtotime($date) < strtotime($current['last_update_judge'])){
                        //if (Mobarat::isOpenForUpdate($current)){
                            return true;
                        //}
                    }
                    //elseif (strtotime($date) < strtotime($current['last_update']))
                    elseif (Mobarat::isOpenForUpdate($current))
                    {
                        if(Yii::app()->request->getParam('id')==$clsPerson->person_id)
                            return true;  
                        else{
                            if(User::isOfTeacherParticipant($current['mobarat_year'],Yii::app()->user->id)){                          
                                $ms=MobaratSchool::model()->find('oteacher_personid='.$clsPerson->person_id.' and mobarat_year='.$current['mobarat_year']);
                                if($ms!=null){
                                    //return true;
                                   $exists=  School::model()->exists('school_id='.$ms['school_id'].
                                            ' and school_ManagerPersonID='.Yii::app()->request->getParam('id'));
                                   return $exists;
                                }
                                    
                            }
                        }
                    }
                    
            }
        }
        return false;
    }

}
