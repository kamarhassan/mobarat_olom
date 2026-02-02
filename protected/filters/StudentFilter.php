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
class StudentFilter extends CFilter {

    //put your code here
    protected function preFilter($filterChain) {
        $userType = MbUser::model()->find('user_id=' . Yii::app()->user->id)->user_type;
        if ($userType == 4) {
            return false;
        } else if ($userType == 2) {
            if (Yii::app()->controller->action->id == 'regChooseProject' || Yii::app()->controller->action->id == 'RegByEmail')
                return true;
                else
                    return false;
            } 
         else if ($userType == 3) {
            if (Yii::app()->controller->action->id == 'update') {
                $studentUser = MbStudent::model()->find('student_id=' . Yii::app()->request->getParam('id'))->student_user;
                if ($studentUser != Yii::app()->user->id)
                    return false;
            }
        }
        return true;
    }

}
