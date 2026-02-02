<?php

class ParticipantController extends Controller
{
    public $layout = '//layouts/column2';
    
    public function accessRules()
    {
        return array(
                /*array('allow',  // allow all users to perform 'index' and 'view' actions
                        'actions'=>array('index','view'),
                        'users'=>array('*'),
                ),*/
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions'=>array('index'),
                        'users'=>array('@'),
                ),
               /* array('allow', // allow admin user to perform 'admin' and 'delete' actions
                        'actions'=>array('admin','delete'),
                        'users'=>array('admin'),
                ),*/
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionIndex()
    {
        
        $clsPerson =Yii::app()->session['clsPerson']  ;
        $mobarat=  Mobarat::getOpenMobaratRecord();
        if($mobarat==null){
            echo "لا يوجد مباراة مفتوحة!";
            return;
        }
        
        //if(User::isOfTeacherParticipant($mobarat['mobarat_year'],Yii::app()->user->id)){
        if($clsPerson->type=='o'){
            $query="select school.school_id,school_name,school_level,mobarat_school.mobarat_year,extraProject,oteacher_personid,school_ManagerPersonID
                ,(select count(project_id) from project where  project_stage='01' and project.school_id=school.school_id and project.mobarat_year=mobarat_school.mobarat_year) as projectCountMota
                ,(select count(project_id) from project where  project_stage='02' and project.school_id=school.school_id and project.mobarat_year=mobarat_school.mobarat_year) as projectCountThan
                from school inner join mobarat_school on school.school_id=mobarat_school.school_id
                where oteacher_personid=".$clsPerson->person_id." and mobarat_school.mobarat_year=".$mobarat['mobarat_year']."
                ";
            $schls=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            $this->render('idxoff', array('current' => $mobarat,'schls' => $schls,));
        }
        
        //elseif(User::isTeacherParticipant($mobarat['mobarat_year'],Yii::app()->user->id)){
        elseif($clsPerson->type=='t'){
            $p= Person::model()->findByPk($clsPerson->person_id);
            if($p->validatePerson(enm_PersonType::TEACHER)){
                $query="select person.Person_id,Person_fname,Person_lname,person_teacher.mobarat_year
                from person inner join person_teacher on teacher_personid=person.Person_id 
                where Person_id=".$clsPerson->person_id." and person_teacher.mobarat_year=".$mobarat['mobarat_year'];
                $teachs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
                $query="select person.Person_id as persstudentid,person_student.Student_id,Person_email1,Person_fname,Person_lname,student_CanModifyProject,project.project_id,project_teacher.person_id as persteacherid
                from project inner join project_student on project.project_id=project_student.project_id
                inner join project_teacher on project.project_id=project_teacher.project_id
                inner join person_student on person_student.Student_id=project_student.student_id
                inner join person on person.Person_id= project_student.person_id
                where project_teacher.person_id=".$clsPerson->person_id." and project.mobarat_year=".$mobarat['mobarat_year'];
                $stds=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            
                $this->render('idxtea', array('current' => $mobarat,'teachs' => $teachs,'stds'=>$stds));
            }else{
                $this->redirect(array('Person/update/' .$clsPerson->person_id));
            }
            
        }
        
        //elseif(User::isStudentParticipant($mobarat['mobarat_year'],Yii::app()->user->id)){
        elseif($clsPerson->type=='s'){
            $p= Person::model()->findByPk($clsPerson->person_id);
            if($p->validatePerson(enm_PersonType::STUDENT)){
                $showScholarship=false;
                $query="select person.Person_id,Person_fname,Person_lname,person_student.mobarat_year,person_student.student_id,student_class
                    from person inner join person_student on student_personid=person.Person_id 
                    where Person_id=".$clsPerson->person_id." and person_student.mobarat_year=".$mobarat['mobarat_year'];
                $stds=Yii::app()->getDB()->createCommand($query)->queryAll(true);
                if($stds[0]['student_class']=='05' || $stds[0]['student_class']=='06' || $stds[0]['student_class']=='07'){
                    StudentScholarship::insert_ifnot_exists($mobarat['mobarat_year'], $stds[0]['student_id'], $clsPerson->person_id);
                    $showScholarship=true;
                }

                $this->render('idxstd', array('current' => $mobarat,'stds' => $stds,'showScholarship'=>$showScholarship));
            }else{
                $this->redirect(array('Person/update/' .$clsPerson->person_id));
            }
           
        }
        
        //elseif(User::isJudgeParticipant($mobarat['mobarat_year'],Yii::app()->user->id)){
        elseif($clsPerson->type=='j'){
            //$showScholarship=false;
            $jud= Personjudge::model()->find('mobarat_year='.$mobarat['mobarat_year'].' and judge_personid ='.$clsPerson->person_id);
            if($jud['judge_registrationStep']=='03'){
               $query="select person.Person_id,Person_fname,Person_lname
                from person 
                where Person_id=".$clsPerson->person_id;
           
                $judge=Yii::app()->getDB()->createCommand($query)->queryAll(true);
                //echo $query;return;

                $showProject=false;
                if($mobarat['enablejudgeday']==1){
                    $showProject=true;
                }
                
                $this->render('idxjud', array('current' => $mobarat,'judge' => $judge[0],'showProject'=>$showProject)); 
            }else{
                $this->redirect(array('Personjudge/completereg/' .$clsPerson->person_id));
            }
            
        }
        
    }


}