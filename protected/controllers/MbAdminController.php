
<?php

class MbAdminController extends Controller {

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
            array(
                'application.filters.AdminFilter',
//                'unit' => 'second',
            ),
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
           /* array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array( 'DeleteStudent','index', 'view'),
                'users' => array('*'),
            ),*/
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('DeleteStudent','Index', 'view','create', 'Present', 'reportNotCompleteStudent', 'increaseYear', 'decreaseYear', 'reportNotCompleteSchool', 'mm', 'reportOldSchool', 'newYear', 'ChooseSchool', 'ShowRecords', 'AllStudents', 'AllUsers', 'AllTeachers', 'indexFullyReport', 'DeleteProjectPresent', 'SubmitSchoolProject', 'FinalProject', 'ProjectPresent', 'PresentDay', 'SchoolDeletePresent', 'SchoolPresent', 'ListSchool', 'IndexJudge', 'ReadNotification', 'modalPro', 'ProjectReport', 'archive'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
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
    /*
    public function actionExtraProject($id) {
        MbSchool::model()->updateAll(array('extraProject' => 1), 'school_id = ' . $id);
    }
*/
    public function actionIncreaseYear($id) {
        echo $id;
        try {
            MbSchool::model()->updateAll(array('school_flag' => 2), 'school_flag != 6');
            MbSchoolManager::model()->updateAll(array('smanager_flag' => 2));
            MbOfficialTeacher::model()->updateAll(array('oteacher_flag' => 2));

            $full = Years::model()->findAll('type=1');
            $semi = Years::model()->findAll('type=2');

            Years::model()->updateAll(array('year' => $full[0]['year'] + 1), 'id = ' . $full[0]['id']);
            Years::model()->updateAll(array('year' => $semi[0]['year'] + 1), 'id = ' . $semi[0]['id']);
			 $this->redirect(array('index'));
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function actionDecreaseYear($id) {
        echo $id;
       try {
            
            $full = Years::model()->findAll('type=1');
            $semi = Years::model()->findAll('type=2');

            Years::model()->updateAll(array('year' => $full[0]['year'] - 1), 'id = ' . $full[0]['id']);
            Years::model()->updateAll(array('year' => $semi[0]['year'] - 1), 'id = ' . $semi[0]['id']);

            $this->redirect(array('index'));
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function actionReportNotCompleteSchool() {
        $n = new Functions;
        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->with = 'schoolUser';
        $criteria->select = '*';
        $criteria->join = 'JOIN mb_user ON t.school_user=mb_user.user_id';
        $criteria->condition = '(t.school_name IS NULL OR t.school_city IS NULL OR t.school_kadda IS NULL OR t.level IS NULL OR t.description IS NULL '
                . 'OR t.year IS NULL OR t.school_phone IS NULL OR t.school_street IS NULL) AND t.year=' . $n->getYear();
        $criteria->order = 'school_name DESC';

        $schoolConfirmed = MbSchool::model()->findAll($criteria);

        $this->render('reportNotCompleteSchool', array('schoolConfirmed' => $schoolConfirmed));
    }

    public function actionReportNotCompleteStudent() {
        $n = new Functions;
        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->with = 'studentUser';
        $criteria->select = '*';
        $criteria->join = 'JOIN mb_user ON t.student_user=mb_user.user_id';
        $criteria->condition = '(t.student_lname IS NULL OR t.student_mname IS NULL OR t.student_sex IS NULL OR t.student_fname IS NULL OR t.student_phone IS NULL '
                . 'OR t.student_birthdate IS NULL OR t.student_class IS NULL OR t.student_email IS NULL) AND t.year=' . $n->getYear();
        $criteria->order = 'student_fname DESC';

        $schoolConfirmed = MbStudent::model()->findAll($criteria);

        $this->render('reportNotCompleteStudent', array('schoolConfirmed' => $schoolConfirmed));
    }

    public function actionReportOldSchool() {
        if (isset($_POST['reset'])) {
            foreach ($_POST['reset'] as $id)
                MbSchool::model()->updateAll(array('school_flag' => 6), 'school_id = ' . $id);
        }
        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->with = 'schoolUser';
        $criteria->select = '*';
        $criteria->join = 'JOIN mb_user ON t.school_user=mb_user.user_id';
        $criteria->condition = 't.school_flag=2';
        $criteria->order = 'school_name DESC';

        $schoolConfirmed = MbSchool::model()->findAll($criteria);

        $this->render('reportOldSchool', array('schoolConfirmed' => $schoolConfirmed));
    }

    public function actionReadNotification($id) {


        NotificationReceived::model()->updateAll(array('flag' => 1), 'user_id=' . $id);
    }

    public function actionNewYear() {

        $this->render('newYear');
    }

//Fully Reports
    public function actionindexFullyReport() {
        $this->render('indexFullyReport');
    }

    public function actionAllUsers() {
        $model = MbUser::model()->findAll();
        $this->render('AllUsers', array(
            'model' => $model
        ));
    }

    public function actionAllTeachers() {
    	
    	
		$model = MbTeacher::model()->findAll('teacher_flag=1 OR teacher_flag=0');
		
		
        $this->render('AllTeachers', array(
            'model' => $model
        ));
       
        
    }

    public function actionAllStudents() {
    	$criteria = new CDbCriteria;
      
        $criteria->select = '*';
       
        $criteria->condition = 'student_flag=1 OR student_flag=0';
		$criteria->order='year';
		
        //$model = MbStudent::model()->findAll('student_flag=1 OR student_flag=0');
		$model = MbStudent::model()->findAll($criteria);
        $this->render('AllStudents', array(
            'model' => $model
        ));
    }
/*
    public function actionDeleteTeacher($id) {
        MbTeacher::model()->updateAll(array('teacher_flag' => 3), 'teacher_id = ' . $id);
    }
*/
    public function actionDeleteStudent($id) {
    	//echo "<script> alert(\"". $id ."\")</script>";
		//MbSchool::model()->updateAll(array('school_flag' => 6), 'school_id = ' . $id);
        MbStudent::model()->updateAll(array('student_flag' => 3), 'student_id = ' . $id);
    }

    public function actionChooseSchool() {
        $this->render('ChooseSchool');
    }

    public function actionShowRecords($id) {
        $school = MbSchool::model()->findAll('school_id=' . $id);
        $project = MbProject::model()->findAll('project_school=' . $id);

        $this->render('ShowRecords', array('school' => $school, 'project' => $project));
    }

//End Of ully Reports
    //judgement

    public function actionIndexJudge() {
        $this->render('indexJudgement');
    }

    public function actionPresentDay() {
        $school = MbSchool::model()->findAll();
        foreach ($school as $p) {
            if ($p->school_kadda == 26 || $p->school_kadda == 1 || $p->school_kadda == 6 || $p->school_kadda == 5 || $p->school_kadda == 4 || $p->school_kadda == 3 || $p->school_kadda == 2) {
                $dayP = new JudgementSchool;
                $dayP->presentation_day = 2;
                $dayP->school_id = $p->school_id;
                if ($dayP->save(false))
                    echo "Sucess";
                else
                    echo "Error";
            }
            else {
                $dayP = new JudgementSchool;
                $dayP->presentation_day = 1;
                $dayP->school_id = $p->school_id;
                if ($dayP->save(false))
                    echo "Sucess";
                else
                    echo "Error";
            }
        }
    }

    public function actionFinalProject() {
        $project = MbProject::model()->findAll();
        foreach ($project as $p) {
            $schoolPresent = JudgementSchool::model()->findAll('school_id=' . $p->project_school);

            $present = new PresentProject;
            $present->present = 0;
            $present->projectID = $p->project_id;
            $present->jsID = $schoolPresent[0]['jsID'];
            $present->save();
        }
    }

    public function actionListSchool() {
        $model = new MbSchool;
        $this->render('schoolPresent', array(
            'model' => $model
        ));
    }

    public function actionPresent($id) {
        $school = MbSchool::model()->findAll('school_id=' . $id);
        $project = MbProject::model()->findAll('project_school=' . $id);

        $this->render('JudgePresent', array('school' => $school, 'project' => $project));
    }

    public function actionSchoolPresent($id) {
        JudgementSchool::model()->updateAll(array('present' => 1), 'school_id=' . $id);
        echo "<button type='button'  class='btn green'>
          <i class='icon-minus'></i>
        </button>";
    }

    public function actionSchoolDeletePresent($id) {
        JudgementSchool::model()->updateAll(array('present' => 0), 'school_id=' . $id);
        $project = MbProject::model()->findAll('project_school=' . $id);

        foreach ($project as $k) {
            PresentProject::model()->updateAll(array('present' => 0), 'projectID=' . $k->project_id);
        }
        echo "<button type='button'  class='btn blue'>
          <i class='icon-check'></i>
        </button>";
    }

    public function actionProjectPresent($id) {

        PresentProject::model()->updateAll(array('present' => 1), 'projectID=' . $id);
        $ii = PresentProject::model()->findAll('projectID=' . $id);
        JudgementSchool::model()->updateAll(array('present' => 1), 'jsID=' . $ii[0]['jsID']);
    }

    public function actionDeleteProjectPresent($id) {

        PresentProject::model()->updateAll(array('present' => 0), 'projectID=' . $id);
    }

    public function actionSubmitSchoolProject() {
        $this->render('submitSchoolProject');
    }

    //end judgement

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionChangePass($id) {
        $model = new user;
        echo "hh";
        die();
        $this->render('changepass', array('model' => $model));
    }

	

    public function actionProjectReport() {

        $n = new Functions();

        $project = MbProject::model()->findAll('year=' . $n->getYear());

        $this->render('ProjectReport', array('project' => $project));
    }

    public function actionCompleteReg() {
        $this->render('completeReg');
    }

    public function actionCopyToTeacher() {
        $this->render('copyToTeacher');
    }

    public function actionUpdateProject() {
        $n = new Functions();

        $project = MbProject::model()->findAll('project_school=' . $n->getSchoolId());

        $this->render('updateProject', array('project' => $project));
    }


    public function actionArchive() {
        $bolReset=false;
        $model = new MbSchool;
        $schoolManager = new MbSchoolManager;
        $officialTeacher = new MbOfficialTeacher;
        $user = new MbUser;
        if (isset($_POST['MbSchool']) || isset($_POST['MbSchoolManager']) || isset($_POST['MbOfficialTeacher'])) {
            $model->attributes = $_POST['MbSchool'];
            $schoolManager->attributes = $_POST['MbSchoolManager'];
            $officialTeacher->attributes = $_POST['MbOfficialTeacher'];
           
			 
			  $f = new Functions;
			  $user->user_mun=$f->getNewMunRegYear(MbUsertype::schoolType,MbUsertype::schoolFlag,$model->school_year);
		      $user->user_type = MbUserType::schoolType;
        	  $user->user_password = $f->getNewPass();
			  
			  $user->save(FALSE);
              
            if ($model->school_kadda == '')
                $model->school_kadda = 26;
            //print_r($model);die();
            $sql = "insert into mb_school(year,school_name, school_ename,mouha_id, school_kadda,school_city,school_street,
                school_email,school_phone,school_extraphone,school_flag,school_fax,school_pobox,school_user)
                values(20".$model->school_year .",'" . $model->school_name . "','" . $model->school_ename . "',". $model->mouha_id . "," . $model->school_kadda . ",'" .
                    $model->school_city . "','" . $model->school_street . "','" . $model->school_email . "','" .
                    $model->school_phone . "','" . $model->school_extraphone . "',2,'" . $model->school_fax . "','" .
                    $model->school_pobox . "'," . $user->user_id . ")";
            $query = Yii::app()->db->createCommand($sql);
            $query->execute();
            //print_r($schoolManager);die();
            $school = MbSchool::model()->findByAttributes(array('school_user' => $user->user_id));
            $sql2 = "insert into mb_school_manager(smanager_school, smanager_fname, smanager_lname,smanager_ename,smanager_sex,
                smanager_email,smanager_phone,smanager_flag)
                values(" . $school->school_id . ",'" . $schoolManager->smanager_fname . "','" . $schoolManager->smanager_lname . "','" .
                    $schoolManager->smanager_ename . "','" . $schoolManager->smanager_sex . "','" . $schoolManager->smanager_email . "','" .
                    $schoolManager->smanager_phone . "',2)";
            $query2 = Yii::app()->db->createCommand($sql2);
            $query2->execute();
            //print_r($officialTeacher);die();
            $sql3 = "insert into mb_official_teacher(oteacher_school, oteacher_fname, oteacher_lname,oteacher_sex,oteacher_description,
                oteacher_mobile,oteacher_email,oteacher_ename,oteacher_flag,oteacher_user)
                values(" . $school->school_id . ",'" . $officialTeacher->oteacher_fname . "','" . $officialTeacher->oteacher_lname . "','" .
                    $officialTeacher->oteacher_sex . "','" . $officialTeacher->oteacher_description . "','" . $officialTeacher->oteacher_mobile . "','" .
                    $officialTeacher->oteacher_email . "','" . $officialTeacher->oteacher_ename . "',2," . $user->user_id . ")";
            $query3 = Yii::app()->db->createCommand($sql3);
            $query3->execute();
            $bolReset=true;
            //$this->redirect(array('MbSchool/completeReg'));
            //$this->redirect(array('archive'));
        }
                       if($bolReset==true){
                       $model = new MbSchool;
                       $schoolManager = new MbSchoolManager;
                       $officialTeacher = new MbOfficialTeacher;
                       
                       }
        $this->render('archive', array(
            'model' => $model,
            'schoolManager' => $schoolManager,
            'officialTeacher' => $officialTeacher,
        ));
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new MbAdmin;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['MbAdmin'])) {
            $model->attributes = $_POST['MbAdmin'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->admin_id));
        }

        $this->render('create', array(
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
        //echo '12123';
        //$layout = '//layouts/column1';
        $mobarat=  Mobarat::getOpenMobaratRecord();
        
        $model = new MbMessage;

        $array = array(
            array(
                'id' => 0,
                'to' => 'كل الأساتذة المسؤولين عن المدارس'
            ),
            array(
                'id' => 1,
                'to' => 'الأساتذة المشرفين على المشاريع'
            ),
            array(
                'id' => 2,
                'to' => 'كل الطلاب المشاركين'),
            array(
                'id' => 3,
                'to' => 'كل الأعضاء')
        );
        $list = CHtml::listData($array, 'id', 'to');
 /*       $dataProvider = new CActiveDataProvider('MbAdmin');*/

        if (isset($_POST['MbMessage'])) {
            $model->attributes = $_POST['MbMessage'];
            $model->message_date = new CDbExpression('NOW()');
            if ($model->to == 0) {
                $destination = MbUser::model()->findAll('user_type=2');
            } else
            if ($model->to == 1) {
                $destination = MbUser::model()->findAll('user_type=4');
            } else
            if ($model->to == 2) {
                $destination = MbUser::model()->findAll('user_type=3');
            } else
            if ($model->to == 3) {
                $destination = MbUser::model()->findAll('user_type!=1');
            }
            if ($model->save()) {
                foreach ($destination as $r) {
                    $detail = new MbMessageDetail;
                    $detail->mdetail_message = $model->message_id;
                    $detail->mdetail_receiver = $r->user_id;
                    $detail->mdetail_sender = Yii::app()->user->id;
                    $detail->message_read_flag = 0;

                    $detail->save(false);
                }
                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../MbAdmin/index'
                </script>";
            }
        }

        /*$this->render('index');*/
        $this->render('index', array(
            'mobarat'=>$mobarat,
            'model' => $model,
            'list' => $list
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        echo 'hi';
        $model = new MbAdmin('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['MbAdmin']))
            $model->attributes = $_GET['MbAdmin'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return MbAdmin the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = MbAdmin::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param MbAdmin $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'mb-admin-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    

}
