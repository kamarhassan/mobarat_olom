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
class PersonstudentFilter extends CFilter {

    //put your code here
    protected function preFilter($filterChain) {
       /* $userType = MbUser::model()->find('user_id=' . Yii::app()->user->id)->user_type;
       
        if (Yii::app()->controller->action->id == 'create' && $userType == 3 && $userType == 4) {
            return false;
        }
        return true;*/
        if (Yii::app()->controller->action->id == 'regStepActivationForm')
                return true;
         elseif(isset(Yii::app()->session['clsPerson']))
        {
            //return true;
            $clsPerson=Yii::app()->session['clsPerson'];
            $current=  Mobarat::getOpenMobaratRecord();
            if($clsPerson->user_type=='01')
                    return true;
           
            elseif(User::isStudentParticipant($current['mobarat_year'],Yii::app()->user->id))
            {
                //return true;
                 if (Yii::app()->controller->action->id == 'Scholarship'){
                     $s= Personstudent::model()->findByPk(Yii::app()->request->getParam('stdid'));
                        if($s['student_personid']==$clsPerson->person_id){
                           return true;
                        }
                 }
            }
            elseif(User::isOfTeacherParticipant($current['mobarat_year'],Yii::app()->user->id))
            {
                
                //$d = new DateTime();
                //$date = $d->format('Y-m-d');
                //if(strtotime($date) < strtotime($current['last_register_teacher_student'])){
                 if (Mobarat::isOpenForRegisterTeacherStudent($current)){
                    if (Yii::app()->controller->action->id == 'regStep1'){
                        $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                               ' and school_id='.Yii::app()->request->getParam('sclid').
                               ' and oteacher_personid='.$clsPerson->person_id);
                        return $exists;
                    }elseif (Yii::app()->controller->action->id == 'regStep2'){
                        //return true;
                        $pr= Project::model()->find('mobarat_year='.$current['mobarat_year'].
                               ' and project_id='.Yii::app()->request->getParam('prjid'));
                        if($pr!=null){
                            $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                               ' and school_id='.$pr['school_id'].
                               ' and oteacher_personid='.$clsPerson->person_id);
                            return $exists;
                        }
                    }elseif (Yii::app()->controller->action->id == 'regSetp3'){
                        return true;
                        $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                               ' and school_id='.$_POST['schlid'].
                               ' and oteacher_personid='.$clsPerson->person_id);
                        return $exists;
                    } elseif (Yii::app()->controller->action->id == 'regStep4'){
                        $pr= Project::model()->find('mobarat_year='.$current['mobarat_year'].
                               ' and project_id='.Yii::app()->request->getParam('prjid'));
                        if($pr!=null){
                            $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                               ' and school_id='.$pr['school_id'].
                               ' and oteacher_personid='.$clsPerson->person_id);
                            return $exists;
                        }       
                    }elseif (Yii::app()->controller->action->id == 'OldStudent')
                        return true;    
                }
                if (Yii::app()->controller->action->id == 'listbyscl'){
                        $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                               ' and school_id='.Yii::app()->request->getParam('id').
                               ' and oteacher_personid='.$clsPerson->person_id);
                        return $exists;
                }elseif (Yii::app()->controller->action->id == 'SendMailToStudent'){
                        $exists=  MobaratSchool::model()->exists('mobarat_year='.$current['mobarat_year'].
                               ' and school_id='.Yii::app()->request->getParam('schid').
                               ' and oteacher_personid='.$clsPerson->person_id);
                        return $exists;
                }
                elseif (Yii::app()->controller->action->id == 'Delete'){
                    
                    $ms=  MobaratSchool::model()->find('mobarat_year='.$current['mobarat_year'].
                           ' and oteacher_personid='.$clsPerson->person_id);
                    if($ms!=null){
                        //return true;
                        $exists= Personstudent::model()->exists('mobarat_year='.$current['mobarat_year'].
                           ' and Student_id='.$_POST['id'].
                           ' and school_id='.$ms['school_id']);
                        return $exists;
                    }
                }
                
            }
        }
        return false;
    }

}
