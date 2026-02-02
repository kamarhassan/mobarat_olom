<?php

class MbMessageController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'studentNotComplete', 'schoolNotComplete', 'projectNotComplete', 'adminMessage', 'adminList', 'loginMessage', 'login', 'inbox', 'inboxAll', 'send', 'delete', 'receive', 'trash', 'info'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionProjectNotComplete() {
        $id = $_GET['id'];
       
        $current= Mobarat::getOpenMobaratRecord();
                
       
        $prj= Project::model()->findByPk($id);
       
        $ms= MobaratSchool::model()->find("school_id=".$prj['school_id']." and mobarat_year=".$current['mobarat_year']);
        if($ms!=null){
            
           $pers= Person::model()->findByPk( $ms['oteacher_personid']);
           $subject='رسالة إدارية';
           $desc="الرجاء إكمال بيانات مشروع " .$prj['project_name'];
           $fromUser=Yii::app()->user->id;
           $toUser=$pers['Person_userID'];
          
           MbMessage::sendMessage($fromUser, $toUser, $subject, $desc);
           echo $pers['Person_fname'].' '.$pers['Person_lname'];
           return;
        }
        echo "error";
        /*
        $model = new MbMessage;
        $detail = new MbMessageDetail;
        $project = MbProject::model()->findByAttributes(array('project_id' => $id));
        $official = MbOfficialTeacher::model()->findByAttributes(array('oteacher_school' => $project->project_school));
        $model->message_subject = 'رسالة إدارية';
        $model->message_content = 'نرجو استكمال بيانات مشروع ' . $project->project_name;
        $model->message_date = date("Y-m-d H:i:s");
        $model->to = 0;
        if ($model->save()) {
            $detail->mdetail_message = $model->message_id;
            $detail->mdetail_receiver = $official->oteacher_user;
            $detail->mdetail_sender = Yii::app()->user->id;
            $detail->message_read_flag = 0;
            $detail->save();
        }*/
    }

    public function actionSchoolNotComplete($id) {
        $model = new MbMessage;
        $detail = new MbMessageDetail;
//        $project = MbProject::model()->findByAttributes(array('project_id' => $id));
//        $official = MbOfficialTeacher::model()->findByAttributes(array('oteacher_school' => $project->project_school));
        $model->message_subject = 'رسالة إدارية';
        $model->message_content = 'نرجو استكمال بيانات مدرستكم ';
        $model->message_date = date("Y-m-d H:i:s");
        $model->to = 0;
        if ($model->save()) {
            $detail->mdetail_message = $model->message_id;
            $detail->mdetail_receiver = $id;
            $detail->mdetail_sender = Yii::app()->user->id;
            $detail->message_read_flag = 0;
            $detail->save();
        }
    }

    public function actionStudentNotComplete($id) {
        $model = new MbMessage;
        $detail = new MbMessageDetail;
//        $project = MbProject::model()->findByAttributes(array('project_id' => $id));
//        $official = MbOfficialTeacher::model()->findByAttributes(array('oteacher_school' => $project->project_school));
        $model->message_subject = 'رسالة إدارية';
        $model->message_content = 'نرجو استكمال بياناتكم الشخصية ';
        $model->message_date = date("Y-m-d H:i:s");
        $model->to = 0;
        if ($model->save()) {
            $detail->mdetail_message = $model->message_id;
            $detail->mdetail_receiver = $id;
            $detail->mdetail_sender = Yii::app()->user->id;
            $detail->message_read_flag = 0;
            $detail->save();
        }
    }

    public function actionInboxAll() {
        $this->render('inboxAll');
    }

    public function actionSend() {
        $this->render('send');
    }

    public function actionReceive() {
        $this->render('receive');
    }

    public function actionTrash() {
        $this->render('trash');
    }

    public function actionLoginMessage($id) {
        $user = MbUser::model()->findByAttributes(array('user_id' => $id));
        if ($user->user_type == 4) {
            $teacher = MbTeacher::model()->findByAttributes(array('teacher_user' => $id));
            echo '
             رسالة إلى الأستاذ' . " ";
            echo $teacher->teacher_fname . ' ' . $teacher->teacher_lname;
        } else {

            if ($user->user_type == 3) {
                $student = MbStudent::model()->findByAttributes(array('student_user' => $id));
                echo '
رسالة إلى ' . " ";
                echo $student->student_fname . ' ' . $student->student_lname;
            }
        }
    }

    public function actionLogin($id) {
        $model = new MbMessage;
        $detail = new MbMessageDetail;
        $model->to = $id;
        $user = MbUser::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

        if ($user->user_type == 3) {
            $project = MbProjectRegistration::model()->findByAttributes(array('pregistration_user' => Yii::app()->user->id));
            $p = MbProject::model()->findByAttributes(array('project_id' => $project->pregistration_project));
            $of_teacher = MbOfficialTeacher::model()->findAll('oteacher_school =' . $p->project_school);
            $school = MbSchool::model()->findByAttributes(array('school_id' => $p->project_school));
            $of_teacher[0]['oteacher_user'] = $school->school_user;

            $criteria = new CDbCriteria;
            $criteria->with = 'studentUser';
            $criteria->alias = 't';
            $criteria->select = '*';
            $criteria->join = 'JOIN mb_user ON t.student_user = mb_user.user_id'
                    . ' JOIN mb_project_registration ON t.student_user = mb_project_registration.pregistration_user';
            $criteria->condition = 'mb_project_registration.pregistration_project = ' . $project->pregistration_project;
            $criteria->condition .= ' AND t.student_user != ' . Yii::app()->user->id;

            $c = new CDbCriteria;
            $c->with = 'teacherUser';
            $c->alias = 't';
            $c->select = '*';
            $c->join = 'JOIN mb_user ON t.teacher_user = mb_user.user_id'
                    . ' JOIN mb_project_registration ON t.teacher_user = mb_project_registration.pregistration_user';
            $c->condition = 'mb_project_registration.pregistration_project = ' . $project->pregistration_project;
            $c->condition .= ' AND mb_user.user_type = 4';

            $res = MbStudent::model()->findAll($criteria);
            foreach ($res as $v) {
                $v['student_fname'] = $v['student_fname'] . " " . $v['student_lname'];
            }
            $list1 = CHtml::listData($res, 'student_user', 'student_fname');
            $res2 = MbTeacher::model()->findAll($c);
            foreach ($res2 as $v2) {
                $v2['teacher_fname'] = "الأستاذ" . " " . $v2['teacher_fname'] . " " . $v2['teacher_lname'];
            }
            $list2 = CHtml::listData($res2, 'teacher_user', 'teacher_fname');
            foreach ($of_teacher as $v3) {
                $v3['oteacher_fname'] = "الأستاذ" . " " . $v3['oteacher_fname'] . " " . $v3['oteacher_lname'];
            }
            $list3 = CHtml::listData($of_teacher, 'oteacher_user', 'oteacher_fname');
            if ($list1 || $list2 || $list3)
                $list = $list1 + $list2 + $list3;
        } else if ($user->user_type == 2) {
            $school = MbSchool::model()->findByAttributes(array('school_user' => Yii::app()->user->id));
            $pr = MbProject::model()->findAll('project_school = ' . $school->school_id);

            $criteria = "
select *
from mb_student
where mb_student.student_user in (
select mb_project_registration.pregistration_user
from mb_project,mb_project_registration,mb_user
where project_school =" . $school->school_id . " and
mb_project.project_id = mb_project_registration.pregistration_project and mb_user.user_id = mb_project_registration.pregistration_user and mb_user.user_type = 3
)
";
            $res = Yii::app()->db->createCommand($criteria)->queryAll();

            $c = "
select *
from mb_teacher
where mb_teacher.teacher_user in (
select mb_project_registration.pregistration_user
from mb_project,mb_project_registration,mb_user
where project_school =" . $school->school_id . " and
mb_project.project_id = mb_project_registration.pregistration_project and mb_user.user_id = mb_project_registration.pregistration_user and mb_user.user_type = 4
)
";
            $option = array();
            $res2 = Yii::app()->db->createCommand($c)->queryAll();
            foreach ($res as $v) {
                array_push($option, array('student_fname' => $v['student_fname'] . " " . $v['student_lname'], 'student_user' => $v['student_user']));
            }
            $list1 = CHtml::listData($option, 'student_user', 'student_fname');

            $options = array();
            foreach ($res2 as $v2) {
                array_push($options, array('teacher_fname' => "الأستاذ" . " " . $v2['teacher_fname'] . " " . $v2['teacher_lname'], 'teacher_user' => $v2['teacher_user']));
            }

            $list2 = CHtml::listData($options, 'teacher_user', 'teacher_fname');

            $ad = array();
            $admin = MbUser::model()->findAll('user_type=1');
            foreach ($admin as $v2) {
                array_push($ad, array('admin_fname' => "الإدارة العامة", 'admin_user' => $v2['user_id']));
            }
            $listAd = CHtml::listData($ad, 'admin_user', 'admin_fname');
            if ($list1 || $list2 || $listAd)
                $list = $list1 + $list2 + $listAd;
        } else if ($user->user_type == 4) {
            $project = MbProjectRegistration::model()->findByAttributes(array('pregistration_user' => Yii::app()->user->id));
            $p = MbProject::model()->findByAttributes(array('project_id' => $project->pregistration_project));
            $of_teacher = MbOfficialTeacher::model()->findAll('oteacher_school =' . $p->project_school);
            $school = MbSchool::model()->findByAttributes(array('school_id' => $p->project_school));
            $of_teacher[0]['oteacher_user'] = $school->school_user;

            $criteria = new CDbCriteria;
            $criteria->with = 'studentUser';
            $criteria->alias = 't';
            $criteria->select = '*';
            $criteria->join = 'JOIN mb_user ON t.student_user = mb_user.user_id'
                    . ' JOIN mb_project_registration ON t.student_user = mb_project_registration.pregistration_user';
            $criteria->condition = 'mb_project_registration.pregistration_project = ' . $project->pregistration_project;

            $res = MbStudent::model()->findAll($criteria);
            foreach ($res as $v) {
                $v['student_fname'] = $v['student_fname'] . " " . $v['student_lname'];
            }
            $list1 = CHtml::listData($res, 'student_user', 'student_fname');
            foreach ($of_teacher as $v3) {
                $v3['oteacher_fname'] = "الأستاذ" . " " . $v3['oteacher_fname'] . " " . $v3['oteacher_lname'];
            }
            $list3 = CHtml::listData($of_teacher, 'oteacher_user', 'oteacher_fname');
            if ($list1 || $list3)
                $list = $list1 + $list3;
        }


// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['MbMessage'])) {
            $model->message_date = new CDbExpression('NOW()');
            $model->attributes = $_POST['MbMessage'];
            if ($model->save()) {
                $detail->mdetail_message = $model->message_id;
                $detail->mdetail_receiver = $model->to;
                $detail->mdetail_sender = Yii::app()->user->id;
                $detail->message_read_flag = 0;

                $detail->save(false);

                //lYii::app()->user->setFlash('success','ok');
                if ($user->user_type == 3) {
                    echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../MbStudent/index'
                </script>";
                }
                if ($user->user_type == 2) {
                    echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../MbSchool/index'
                </script>";
                }
                if ($user->user_type == 4) {
                    echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../MbTeacher/index'
                </script>";
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'list' => $list
        ));
    }

    public function actionAdminList($id) {
       // echo 'ssdf';
        //return;

//        $school = MbSchool::model()->findByAttributes(array('school_user' => $id));
        //$pr = MbProject::model()->findAll('project_school = ' . $id);
        $current= Mobarat::getOpenMobaratRecord();
        //$id=10002;
//
        $criteria="select 'الاستاذ المسؤول'  as label , person_fname,Person_mname,Person_lname,Person_userID 
                    from mobarat_school 
                    inner join person on person.Person_id=mobarat_school.oteacher_personid
                    where mobarat_school.mobarat_year=".$current['mobarat_year']." and mobarat_school.school_id=".$id."
                    union distinctrow
                    select 'الاستاذ المشرف'  as label, person_fname,Person_mname,Person_lname,Person_userID 
                    from project inner join project_teacher on project_teacher.project_id=project.project_id
                    inner join person on person.Person_id=project_teacher.person_id
                    where project.mobarat_year=".$current['mobarat_year']." and project.school_id=".$id."
                    union distinctrow
                    select 'الطالب' as label , person_fname,Person_mname,Person_lname,Person_userID 
                    from project inner join project_student on project_student.project_id=project.project_id
                    inner join person on person.Person_id=project_student.person_id
                    where project.mobarat_year=".$current['mobarat_year']." and project.school_id=".$id;
        
        

        $res = Yii::app()->db->createCommand($criteria)->queryAll();
        $option = array();
        foreach ($res as $v) {
            array_push($option, array('pname' => $v['label'] . " " .$v['person_fname'] . " " . $v['Person_lname'], 'user' => $v['Person_userID']));
        }
        $list1 = CHtml::listData($option, 'user', 'pname');
        
         foreach ($list1 as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
/*
        $c = "
select *
from mb_teacher
where mb_teacher.teacher_user in (
select mb_project_registration.pregistration_user
from mb_project,mb_project_registration,mb_user
where project_school =" . $id . " and
mb_project.project_id = mb_project_registration.pregistration_project and mb_user.user_id = mb_project_registration.pregistration_user and mb_user.user_type = 4
)
";
        $option = array();
        $res2 = Yii::app()->db->createCommand($c)->queryAll();
        foreach ($res as $v) {
            array_push($option, array('student_fname' => $v['student_fname'] . " " . $v['student_lname'], 'student_user' => $v['student_user']));
        }
        $list1 = CHtml::listData($option, 'student_user', 'student_fname');

        $options = array();
        foreach ($res2 as $v2) {
            array_push($options, array('teacher_fname' => "الأستاذ" . " " . $v2['teacher_fname'] . " " . $v2['teacher_lname'], 'teacher_user' => $v2['teacher_user']));
        }

        $list2 = CHtml::listData($options, 'teacher_user', 'teacher_fname');
//
        $of = array();
        $admin = MbOfficialTeacher::model()->findByAttributes(array('oteacher_school' => $id));
        array_push($of, array('admin_fname' => $admin->oteacher_fname . " " . $admin->oteacher_lname . " (الأستاذ المسؤول)", 'admin_user' => $admin->oteacher_id));
        $listAd = CHtml::listData($of, 'admin_user', 'admin_fname');
//
        if ($list1 || $list2 || $listAd)
            $list = $list1 + $list2 + $listAd;
        foreach ($list as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }*/
       
    }

    public function actionAdminMessage() {
        $model = new MbMessage;
        $detail = new MbMessageDetail;
        if (isset($_POST['MbMessage'])) {
            $model->message_date = date("Y-m-d H:i:s");
            $model->attributes = $_POST['MbMessage'];
            if ($model->save()) {
                $detail->mdetail_message = $model->message_id;
                $detail->mdetail_receiver = $model->to;
                $detail->mdetail_sender = Yii::app()->user->id;
                $detail->message_read_flag = 0;

                $detail->save(false);

                //Yii::app()->user->setFlash('success','ok');


                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../MbAdmin/index'
                </script>";
            }
        }
        $this->render('adminMessage', array('model' => $model));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new MbMessage;
        $detail = new MbMessageDetail;
        $current= Mobarat::getOpenMobaratRecord();
        $clsPerson=Yii::app()->session['clsPerson'] ;
        
        if (User::isOfTeacherParticipant($current['mobarat_year'], $clsPerson->user_id)){
            $sc=MobaratSchool::model()->find('mobarat_year='.$current['mobarat_year'].' and oteacher_personid='.$clsPerson->person_id);
            $query=" select Person_userID,concat('الإدارة : ',Person_fname ,' ', Person_lname) as person_name
                        from  person inner join user on person.Person_userID=user_id
                        where user_type='01'   ".
                    "union distinct "
                    ."select Person_userID,concat(Person_fname ,' ', Person_lname) as person_name
                        from person_student inner join person on student_personid=person_id
                        where not Person_userID is null and mobarat_year=".$current['mobarat_year']." and school_id=".$sc['school_id']."
                        union distinct
                        select Person_userID,concat(Person_fname ,' ', Person_lname) as person_name
                        from person_teacher inner join person on teacher_personid=person_id
                        where not Person_userID is null and mobarat_year=".$current['mobarat_year']." and school_id=".$sc['school_id'];
            //$rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            //$list = CHtml::listData($rs, 'Person_userID', 'person_name');
        }
        elseif (User::isTeacherParticipant($current['mobarat_year'], $clsPerson->user_id)){
            $sc= Personteacher::model()->find('mobarat_year='.$current['mobarat_year'].' and teacher_personid='.$clsPerson->person_id);
            
            $query="select Person_userID,concat(Person_fname ,' ', Person_lname) as person_name
                        from person_student inner join person on student_personid=person_id
                        where not Person_userID is null and mobarat_year=".$current['mobarat_year']." and school_id=".$sc['school_id']."
                    union distinct
                    select Person_userID,concat(Person_fname ,' ', Person_lname) as person_name
                        from person_teacher inner join person on teacher_personid=person_id
                        where not Person_userID is null and teacher_personid !=".$clsPerson->person_id
                        ." and mobarat_year=".$current['mobarat_year']." and school_id=".$sc['school_id']
                        ." union distinct
                        select Person_userID,concat(Person_fname ,' ', Person_lname) as person_name
                        from mobarat_school inner join person on oteacher_personid=person_id
                        where not Person_userID is null and mobarat_year=".$current['mobarat_year']." and school_id=".$sc['school_id'];
            //$rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            //$list = CHtml::listData($rs, 'Person_userID', 'person_name');
        }
         elseif (User::isStudentParticipant($current['mobarat_year'], $clsPerson->user_id)){
            $sc= Personstudent::model()->find('mobarat_year='.$current['mobarat_year'].' and student_personid='.$clsPerson->person_id);
            
            $query="select Person_userID,concat(Person_fname ,' ', Person_lname) as person_name
                        from person_student inner join person on student_personid=person_id
                        where not Person_userID is null and mobarat_year=".$current['mobarat_year']
                    . " and student_personid !=".$clsPerson->person_id." and school_id=".$sc['school_id']."
                        union distinct
                        select Person_userID,concat(Person_fname ,' ', Person_lname) as person_name
                        from person_teacher inner join person on teacher_personid=person_id
                        where not Person_userID is null and teacher_personid !=".$clsPerson->person_id
                        ." and mobarat_year=".$current['mobarat_year']." and school_id=".$sc['school_id']
                        ." union distinct
                        select Person_userID,concat(Person_fname ,' ', Person_lname) as person_name
                        from mobarat_school inner join person on oteacher_personid=person_id
                        where not Person_userID is null and mobarat_year=".$current['mobarat_year']." and school_id=".$sc['school_id'];
            //$rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            //$list = CHtml::listData($rs, 'Person_userID', 'person_name');
        }
        $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $list = CHtml::listData($rs, 'Person_userID', 'person_name');
/*
        $user = MbUser::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

        if ($user->user_type == 3) {
            $project = MbProjectRegistration::model()->findByAttributes(array('pregistration_user' => Yii::app()->user->id));
            $p = MbProject::model()->findByAttributes(array('project_id' => $project->pregistration_project));
            $of_teacher = MbOfficialTeacher::model()->findAll('oteacher_school =' . $p->project_school);
            $school = MbSchool::model()->findByAttributes(array('school_id' => $p->project_school));
            $of_teacher[0]['oteacher_user'] = $school->school_user;

            $criteria = new CDbCriteria;
            $criteria->with = 'studentUser';
            $criteria->alias = 't';
            $criteria->select = '*';
            $criteria->join = 'JOIN mb_user ON t.student_user = mb_user.user_id'
                    . ' JOIN mb_project_registration ON t.student_user = mb_project_registration.pregistration_user';
            $criteria->condition = 'mb_project_registration.pregistration_project = ' . $project->pregistration_project;
            $criteria->condition .= ' AND t.student_user != ' . Yii::app()->user->id;

            $c = new CDbCriteria;
            $c->with = 'teacherUser';
            $c->alias = 't';
            $c->select = '*';
            $c->join = 'JOIN mb_user ON t.teacher_user = mb_user.user_id'
                    . ' JOIN mb_project_registration ON t.teacher_user = mb_project_registration.pregistration_user';
            $c->condition = 'mb_project_registration.pregistration_project = ' . $project->pregistration_project;
            $c->condition .= ' AND mb_user.user_type = 4';

            $res = MbStudent::model()->findAll($criteria);
            foreach ($res as $v) {
                $v['student_fname'] = $v['student_fname'] . " " . $v['student_lname'];
            }
            $list1 = CHtml::listData($res, 'student_user', 'student_fname');
            $res2 = MbTeacher::model()->findAll($c);
            foreach ($res2 as $v2) {
                $v2['teacher_fname'] = "الأستاذ" . " " . $v2['teacher_fname'] . " " . $v2['teacher_lname'];
            }
            $list2 = CHtml::listData($res2, 'teacher_user', 'teacher_fname');
            foreach ($of_teacher as $v3) {
                $v3['oteacher_fname'] = "الأستاذ" . " " . $v3['oteacher_fname'] . " " . $v3['oteacher_lname'];
            }
            $list3 = CHtml::listData($of_teacher, 'oteacher_user', 'oteacher_fname');
            if ($list1 || $list2 || $list3)
                $list = $list1 + $list2 + $list3;
        } else if ($user->user_type == 2) {
            $school = MbSchool::model()->findByAttributes(array('school_user' => Yii::app()->user->id));
            $pr = MbProject::model()->findAll('project_school = ' . $school->school_id);

            $criteria = "
select *
from mb_student
where mb_student.student_user in (
select mb_project_registration.pregistration_user
from mb_project,mb_project_registration,mb_user
where project_school =" . $school->school_id . " and
mb_project.project_id = mb_project_registration.pregistration_project and mb_user.user_id = mb_project_registration.pregistration_user and mb_user.user_type = 3
)
";
            $res = Yii::app()->db->createCommand($criteria)->queryAll();

            $c = "
select *
from mb_teacher
where mb_teacher.teacher_user in (
select mb_project_registration.pregistration_user
from mb_project,mb_project_registration,mb_user
where project_school =" . $school->school_id . " and
mb_project.project_id = mb_project_registration.pregistration_project and mb_user.user_id = mb_project_registration.pregistration_user and mb_user.user_type = 4
)
";
            $option = array();
            $res2 = Yii::app()->db->createCommand($c)->queryAll();
            foreach ($res as $v) {
                array_push($option, array('student_fname' => $v['student_fname'] . " " . $v['student_lname'], 'student_user' => $v['student_user']));
            }
            $list1 = CHtml::listData($option, 'student_user', 'student_fname');

            $options = array();
            foreach ($res2 as $v2) {
                array_push($options, array('teacher_fname' => "الأستاذ" . " " . $v2['teacher_fname'] . " " . $v2['teacher_lname'], 'teacher_user' => $v2['teacher_user']));
            }

            $list2 = CHtml::listData($options, 'teacher_user', 'teacher_fname');

            $ad = array();
            $admin = MbUser::model()->findAll('user_type=1');
            foreach ($admin as $v2) {
                array_push($ad, array('admin_fname' => "الإدارة العامة", 'admin_user' => $v2['user_id']));
            }
            $listAd = CHtml::listData($ad, 'admin_user', 'admin_fname');
            if ($list1 || $list2 || $listAd)
                $list = $list1 + $list2 + $listAd;
        } else if ($user->user_type == 4) {
            $project = MbProjectRegistration::model()->findByAttributes(array('pregistration_user' => Yii::app()->user->id));
            $p = MbProject::model()->findByAttributes(array('project_id' => $project->pregistration_project));
            $of_teacher = MbOfficialTeacher::model()->findAll('oteacher_school =' . $p->project_school);
            $school = MbSchool::model()->findByAttributes(array('school_id' => $p->project_school));
            $of_teacher[0]['oteacher_user'] = $school->school_user;

            $criteria = new CDbCriteria;
            $criteria->with = 'studentUser';
            $criteria->alias = 't';
            $criteria->select = '*';
            $criteria->join = 'JOIN mb_user ON t.student_user = mb_user.user_id'
                    . ' JOIN mb_project_registration ON t.student_user = mb_project_registration.pregistration_user';
            $criteria->condition = 'mb_project_registration.pregistration_project = ' . $project->pregistration_project;

            $res = MbStudent::model()->findAll($criteria);
            foreach ($res as $v) {
                $v['student_fname'] = $v['student_fname'] . " " . $v['student_lname'];
            }
            $list1 = CHtml::listData($res, 'student_user', 'student_fname');
            foreach ($of_teacher as $v3) {
                $v3['oteacher_fname'] = "الأستاذ" . " " . $v3['oteacher_fname'] . " " . $v3['oteacher_lname'];
            }
            $list3 = CHtml::listData($of_teacher, 'oteacher_user', 'oteacher_fname');
            if ($list1 || $list3)
                $list = $list1 + $list3;
        }

*/
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['MbMessage'])) {
            $model->message_date = new CDbExpression('NOW()');
            $model->attributes = $_POST['MbMessage'];
            if ($model->save()) {
                $detail->mdetail_message = $model->message_id;
                $detail->mdetail_receiver = $model->to;
                $detail->mdetail_sender = Yii::app()->user->id;
                $detail->message_read_flag = 0;

                $detail->save(false);
                 //echo "<script>alert('لقد تم إرسال الرسالة بنجاح') </script>";
                 $this->redirect($this->createAbsoluteUrl('Participant/index'));
                //Yii::app()->user->setFlash('success','ok');
                 /*
                if ($user->user_type == 3) {
                    echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../MbStudent/index'
                </script>";
                }
                if ($user->user_type == 2) {
                    echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../MbSchool/index'
                </script>";
                }
                if ($user->user_type == 4) {
                    echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../MbTeacher/index'
                </script>";
                }*/
            }
        }

        $this->render('create', array(
            'model' => $model,
            'list' => $list
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['MbMessage'])) {
            $model->attributes = $_POST['MbMessage'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->message_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('MbMessage');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionInbox($id) {
        $model = new MbMessage;
        $detail = MbMessageDetail::model()->findByAttributes(array('mdetail_id' => $id));
        $message = MbMessage::model()->findByAttributes(array('message_id' => $detail->mdetail_message));
        $detail->message_read_flag = 1;
        $detail->save(FALSE);
        if (isset($_POST['MbMessage'])) {

            $model->attributes = $_POST['MbMessage'];
            $model->message_date = date("Y-m-d");
            $model->to = 0;
            //var_dump($model->attributes);die();
            if ($model->validate()) {
                $sql = "insert into mb_message(message_subject, message_content,message_date)
            values('" . $model->message_subject . "','" . $model->message_content . "','" . $model->message_date . "')";
                $query = Yii::app()->db->createCommand($sql);
                if ($query->execute()) {
                    $sqll = "insert into mb_message_detail(mdetail_message, mdetail_sender,mdetail_receiver,message_read_flag)
            values(" . Yii::app()->db->getLastInsertId() . "," . Yii::app()->user->id . "," . $detail->mdetail_sender . ",0)";
                    $queryy = Yii::app()->db->createCommand($sqll);
                    $queryy->execute();
                }
            }
            echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../../Site/Redirect'
                </script>";
            
/*
            $user = MbUser::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

            //Yii::app()->user->setFlash('success','ok');
            if ($user->user_type == 1) {
                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../../MbAdmin/index'
                </script>";
            }
            if ($user->user_type == 3) {
                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../../MbStudent/index'
                </script>";
            }
            if ($user->user_type == 2) {
                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../../MbSchool/index'
                </script>";
            }
            if ($user->user_type == 4) {
                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../../MbTeacher/index'
                </script>";
            }
 
 */
        }
        $this->render('inbox', array(
            'id' => $id,
            'message' => $message,
            'detail' => $detail,
            'model' => $model
        ));
    }

    public function actionInfo($id) {
        $model = new MbMessage;
        $details = new MbMessageDetail;
        $message = MbMessage::model()->findByAttributes(array('message_id' => $id));
        $detail = MbMessageDetail::model()->findByAttributes(array('mdetail_message' => $id));
        if (isset($_POST['MbMessage'])) {

            $model->attributes = $_POST['MbMessage'];
            $model->message_date = date("Y-m-d");
            $model->to = 0;
            //var_dump($model->attributes);die();
            if ($model->validate()) {
                $sql = "insert into mb_message(message_subject, message_content,message_date)
            values('" . $model->message_subject . "','" . $model->message_content . "','" . $model->message_date . "')";
                $query = Yii::app()->db->createCommand($sql);
                if ($query->execute()) {
                    $sqll = "insert into mb_message_detail(mdetail_message, mdetail_sender,mdetail_receiver,message_read_flag)
            values(" . Yii::app()->db->getLastInsertId() . "," . Yii::app()->user->id . "," . $detail->mdetail_sender . ",0)";
                    $queryy = Yii::app()->db->createCommand($sqll);
                    $queryy->execute();
                }
            }

            //$user = User::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
             echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../../Site/Redirect'
                </script>";
            //$this->redirect(array('Site/Redirect'));
/*
            //Yii::app()->user->setFlash('success','ok');
            if ($user->user_type == 1) {
                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../../MbAdmin/index'
                </script>";
            }
            if ($user->user_type == 3) {
                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../../MbStudent/index'
                </script>";
            }
            if ($user->user_type == 2) {
                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../../MbSchool/index'
                </script>";
            }
            if ($user->user_type == 4) {
                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../../MbTeacher/index'
                </script>";
            }
 * 
 */
        }
        $this->render('info', array(
            'id' => $id,
            'message' => $message,
            'detail' => $detail,
            'model' => $model
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new MbMessage('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['MbMessage']))
            $model->attributes = $_GET['MbMessage'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return MbMessage the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = MbMessage::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param MbMessage $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'mb-message-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
