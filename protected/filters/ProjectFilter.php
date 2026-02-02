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
class ProjectFilter extends CFilter {

    //put your code here
    protected function preFilter($filterChain) {
       /* $userType = MbUser::model()->find('user_id=' . Yii::app()->user->id)->user_type;
       
        if (Yii::app()->controller->action->id == 'create' && $userType == 3 && $userType == 4) {
            return false;
        }
        return true;*/
        
        if(isset(Yii::app()->session['clsPerson']))
        {
            $clsPerson=Yii::app()->session['clsPerson'];
            $current=  Mobarat::getOpenMobaratRecord();
            if($clsPerson->user_type=='01')
                    return true;
            else{
                //$d = new DateTime();
                //$date = $d->format('Y-m-d');
                if (Yii::app()->controller->action->id == 'overProject')
                    return true;      
                elseif (Yii::app()->controller->action->id == 'listprojectsscl'
                    || (Yii::app()->controller->action->id == 'listprojectsforupdatescl' &&  Mobarat::isOpenForUpdate($current))//(strtotime($date) < strtotime($current['last_update'])))
                    || (Yii::app()->controller->action->id == 'regStep1' &&  Mobarat::isOpenForUpdate($current))//(strtotime($date) < strtotime($current['last_update'])))
                    || Yii::app()->controller->action->id == 'listprojectssclarch' 
                       ){
                     //for oteacher
                    $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                           ' and school_id='.Yii::app()->request->getParam('sclid').
                           ' and oteacher_personid='.$clsPerson->person_id);
                    return $exists;
                }else if(Yii::app()->controller->action->id == 'SetTeacher'  ){
                    return User::isOfTeacherParticipant($current['mobarat_year'], Yii::app()->user->id);
                }
                
                else
                if (Yii::app()->controller->action->id == 'listprojectsstd'
                        || Yii::app()->controller->action->id == 'listprojectstea'
                        || ((Yii::app()->controller->action->id == 'listprojectsforupdatestd' 
                                || Yii::app()->controller->action->id == 'listprojectsforupdatetea') 
                                //&& (strtotime($date) < strtotime($current['last_update']))))
                                && Mobarat::isOpenForUpdate($current)))
                        
                        {
                     //for oteacher
                    return Yii::app()->request->getParam('persid')==$clsPerson->person_id;
                   
                }else
                 //if (Yii::app()->controller->action->id == 'Create' && (strtotime($date) < strtotime($current['last_register_project']))){
                 if (Yii::app()->controller->action->id == 'Create' && Mobarat::isOpenForProject($current)){
                    //for oteacher
                    $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                           ' and school_id='.Yii::app()->request->getParam('sclid').
                           ' and oteacher_personid='.$clsPerson->person_id);
                    return $exists;
                }else
                 if (Yii::app()->controller->action->id =='completeProject'){
                    $prj=Project::model()->findByPk(Yii::app()->request->getParam('id'));
                    $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                           ' and school_id='.$prj->school_id.
                           ' and oteacher_personid='.$clsPerson->person_id);
                    return $exists;
                } else if(Yii::app()->controller->action->id =='completeRegisterProjects'){
                    $prj=Project::model()->findByPk(Yii::app()->request->getParam('prjid'));
                    $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                           ' and school_id='.$prj->school_id.
                           ' and oteacher_personid='.$clsPerson->person_id);
                    return $exists;
                }
                /*if ((Yii::app()->controller->action->id == 'projectUpdate' && (strtotime($date) < strtotime($current['last_update'])))
                        || Yii::app()->controller->action->id == 'fulldetails'){*/
                if ((Yii::app()->controller->action->id == 'projectUpdate' && Mobarat::isOpenForUpdate($current))
                        || Yii::app()->controller->action->id == 'fulldetails'
                        || Yii::app()->controller->action->id == 'Download'){
                    $prj=Project::model()->findByPk(Yii::app()->request->getParam('prjid'));
                    $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                           ' and school_id='.$prj->school_id.
                           ' and oteacher_personid='.$clsPerson->person_id);
                    if($exists) return $exists;
                    $exists= ProjectTeacher::model()->exists('project_id='.Yii::app()->request->getParam('prjid').
                           ' and person_id='.$clsPerson->person_id);
                    if($exists) return $exists;
                    $exists= ProjectStudent::model()->exists('project_id='.Yii::app()->request->getParam('prjid').
                           ' and person_id='.$clsPerson->person_id);
                    if($exists) return $exists;
                }
                
            }
        }
        return false;
    }

}
