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
class UserFilter extends CFilter {

    //put your code here
    protected function preFilter($filterChain) {
        
        if(isset(Yii::app()->session['clsPerson']))
        { 
            $clsPerson=Yii::app()->session['clsPerson'];
            if($clsPerson->user_type=='01')
                    return true;
            else{ //return TRUE;
                $current= Mobarat::getOpenMobaratRecord();

                 if (Yii::app()->controller->action->id == 'Update'){

                     if(User::isOfTeacherParticipant($current['mobarat_year'], Yii::app()->user->id)){
                         return Yii::app()->user->id==Yii::app()->request->getParam('id');
                     }
                 }
            }
        }
        return false;     
                 

    }

}
