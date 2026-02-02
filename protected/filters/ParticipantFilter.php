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
class ParticipanrFilter extends CFilter {

    //put your code here
    protected function preFilter($filterChain) {
        if(isset(Yii::app()->session['clsPerson']))
        {
            $clsPerson=Yii::app()->session['clsPerson'];
            if($clsPerson->user_type=='02')
                    return true;
        }
        return false;     
                 

    }

}
