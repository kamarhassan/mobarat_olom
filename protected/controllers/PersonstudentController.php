<?php

class PersonstudentController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            array(
                'application.filters.PersonStudentFilter' //path to GridViewHandler.php class
            )
        );
    }
    /*
         public function filters(){
        return array(
            array(
                'application.filters.GridViewHandler' //path to GridViewHandler.php class
            )
        );
    }*/

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'regStepComplete', 'regStepActivationForm'),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update',
                    'regStep1',
                    'regStep2',
                    'regSetp3',
                    'regStep4',
                    'OldStudent',
                    'reportnotcomplete',
                    'reportall',
                    'reportbodyall',
                    'toexcel',
                    'listbyscl',
                    'Delete',
                    'Scholarship',
                    'SendMailToStudent'
                ),
                'users' => array('@'),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin'),
                'users' => array('admin'),
            ),
            array(
                'deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Personstudent;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Personstudent'])) {
            $model->attributes = $_POST['Personstudent'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->Student_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    /*
	public function actionUpdate($persid,$stdid)
	{
            $pers=  Person::model()->findByPk($persid);
            $std=  Personstudent::model()->findByPk($stdid);
                    
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personstudent']))
		{
			$model->attributes=$_POST['Personstudent'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Student_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete()
    {
        $id = $_POST['id'];
        $query = "delete from project_student where student_id=" . $id . ";
                    delete from person_student where Student_id=" . $id . "; ";
        Yii::app()->getDB()->createCommand($query)->execute();

        // ProjectStudent::model()->delete('student_id='.$id);
        // $this->loadModel($id)->delete();
        echo $id;

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        //if(!isset($_GET['ajax']))
        //	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    private function getConfirmationMessage($schname, $projname, $subMUN, $user_password)
    {
        $msg_st = "<table cellpadding='10' style='border:1px solid black;border-collapse:collapse; direction:rtl'>
                        <th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
                                <tr ><td><p align='right'><font color='#4b8df8'></font> جانب الطالب/الطالبة المحترم/ المحترمة  في مدرسة <b>" . " " . $schname . "</b></p></tr>
                                <tr bgcolor='#E0E0E0' align='right'><td>اسم المشروع: " . $projname . "</td></tr>
                                <tr ><td> <p align='right'>لقد تم تأكيد تسجيل في مباراة العلوم ، إن كافة المراسلات سوف ترد إلى بريدكم الإلكتروني هذا. </br>http://mobarat.nasr.org.lb :لتسجيل الدخول</p></td></tr>
                                <tr  bgcolor='#E0E0E0'><td><p align='right'>MUN في خانة اسم المستخدم يجب كتابة الرقم الخاص بمدرستكم </p></td></tr>
                                <tr><td><p align='right'><font color='#4b8df8'><b>" . $subMUN . "</b></font> :MUN</p></td></tr>
                                <tr bgcolor='#E0E0E0'><td><p align='right'><font color='#4b8df8'><b>" . $user_password . "</b></font>:كلمة المرور</p></td></tr>
                                <tr><td><p align='right'>الخطوات اللاحقة: إكمال معلومات تسجيلك من خلال الدخول إلى موقع التسجيل.</p></td></tr>
                        </table>";

        return $msg_st;
    }


    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Personstudent');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Personstudent('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Personstudent']))
            $model->attributes = $_GET['Personstudent'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Personstudent the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Personstudent::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Personstudent $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'person-student-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionregStep1($sclid)
    {
        $current =  Mobarat::getOpenMobaratRecord();

        $query = "select project_id,mobarat_year,school_id,project_name
                    ,(select count(  project_student.project_id)  from person inner join person_student on student_personid=person.Person_id
                    inner join project_student on project_student.student_id=person_student.Student_id
                    where project_student.project_id=project.project_id
                    
                    ) as stdcount
                    from project
                    where school_id=" . $sclid . " AND mobarat_year=" . $current['mobarat_year'];

        $project = Yii::app()->getDB()->createCommand($query)->queryAll(true);

        $query = "select person.person_id,Person_fname,Person_lname,Person_email1,project.project_id,person_student.isConfirmed,student_personid 
                    from person inner join person_student on student_personid=person.Person_id
                    inner join project_student on project_student.person_id=person.person_id
                    inner join project on project.project_id=project_student.project_id and project.school_id=person_student.school_id and person_student.mobarat_year=project.mobarat_year
                    where project.school_id=" . $sclid . " AND project.mobarat_year=" . $current['mobarat_year'];

        $std = Yii::app()->getDB()->createCommand($query)->queryAll(true);


        $this->render('regStep1', array('project' => $project, 'std' => $std, 'current' => $current));
    }

    public function actionregStep2($prjid)
    {
        $title = 'إختيار طالب مشار ك  سابقاً';
        $bodyreport = 'personstudent/OldStudent';
        //$bodyreportparams=array('prjid'=>$prjid);
        $pr = Project::model()->findBypk($prjid);
        $bodyreportparams = array('prjid' => $prjid, 'sclid' => $pr->school_id);
        $searchcontrol = '/report/scstudent01';

        $params = array('bodyreport' => $bodyreport, 'bodyreportparams' => $bodyreportparams, 'showcsv' => 'false');
        $this->render('/report/reportmain', array('title' => $title, 'searchcontrol' => $searchcontrol, 'params' => $params));

        //$this->render('regStep2', array('prjid' => $prjid));
    }

    public function actionregSetp3()
    {
        //echo $_POST['schlid'].'; '.$_POST['prjid'].'; '.$_POST['id'];
        //return;
        $currentMobarat =  Mobarat::getOpenMobaratRecord();
        //echo $id;
        if ($currentMobarat == null) {
            echo 'لا يوجد مباراة مفتوحة للتسجيل';
            return;
        }
        //
        $cp =  ProjectStudent::model()->count("project_id=" . $_POST['prjid']);
        if ($cp >= $currentMobarat['StudentNbForProject']) {
            echo "لا يمكن إضافة الطالب، لأنه سوف تتجاوز العدد المسموح به من الطلاب لكل مشروع";
            return;
        }
        //$d = new DateTime();
        //$date = $d->format('Y-m-d');
        //if (strtotime($date) > strtotime($currentMobarat['last_register_teacher_student'])){
        if (!Mobarat::isOpenForRegisterTeacherStudent($currentMobarat)) {
            echo "إنتهت مهلة التسجيل!";
            return;
        }

        $minute = date('i');
        $second = date('s');
        $code = $minute . $_POST['id'] . $second;
        //return;
        $pers =  Person::model()->findByPk($_POST['id']);
        $prj =  Project::model()->findByPk($_POST['prjid']);
        if ($pers == null || $prj == null) {
            echo 'يوجد خطأ بمعطيات التسجيل';
            return;
        }
        //$bolExistBefore=FALSE;
        $persStudent =  Personstudent::model()->find('student_personid=' . $_POST['id'] . ' and school_id= ' . $prj['school_id'] . ' and mobarat_year=' . $currentMobarat['mobarat_year']);
        if ($persStudent == null) {
            // echo "9999";
            //return;
            $persStudent = new Personstudent();
            $persStudent->student_personid = $_POST['id'];
            $persStudent->mobarat_year = $currentMobarat['mobarat_year'];
            $persStudent->school_id = $prj['school_id'];
            //$persStudent->date_inserted=new CDbExpression('now()');
        } elseif ($persStudent->isConfirmed == FALSE) {

            $prjStd =  ProjectStudent::model()->find('project_id !=' . $_POST['prjid'] . '   and student_id=' . $persStudent->Student_id);
            // echo ";".count($prjStd).";";
            //return;
            if ($prjStd != NULL) {
                echo 'إن الطالب ' . $pers['Person_fname'] . ' ' . $pers['Person_lname'] . ' ' . 'لم يؤكد تسجيله لمشروع اخر، لذلك لا يمكن ترشيحه لهذا المشروع قبل تأكيده';
                return;
            }
        } //else
        //   $bolExistBefore=TRUE;
        //echo "122";
        //return;
        $persStudent->confirmation_code = $code;
        $persStudent->isConfirmed = FALSE;
        $persStudent->save();
        //echo "saved";
        // return;
        echo ";" . $persStudent->Student_id . ";";
        $prjStd =  ProjectStudent::model()->find('project_id=' . $_POST['prjid'] . '   and person_id=' . $_POST['id']);
        if ($prjStd == NULL) {
            $prjStd = new ProjectStudent();
            $prjStd->person_id = $_POST['id'];
            $prjStd->project_id = $_POST['prjid'];
            $prjStd->student_id = $persStudent->Student_id;
            $prjStd->save();
            // echo "saved";
            //return;
        }
        $email = $pers['Person_email1'];

        $msg_st = "<table cellpadding='10' dir='rtl' style='border:1px solid black;border-collapse:collapse;'>
                    <th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
                 <tr ><td> <p align='right'>جانب الطالب  المحترم" . " " . $pers['Person_fname'] . " " . $pers['Person_lname'] . "  </p></td></tr>
                 <tr  bgcolor='#E0E0E0'><td direction='rtl'><p align='right'>  لقد تم ترشيحكم للمشاركة في مباراة العلوم " . " " . $currentMobarat['mobarat_year'] . "</p></td></tr>
                 <tr  bgcolor='#E0E0E0'><td direction='rtl'><p align='right'>   من خلال المشروع" . " " . $prj['project_name'] . "</p></td></tr>
                 <tr><td><p align='right'><font color='#4b8df8'> لتأكيد الترشيح </p></td></tr>
                 <tr bgcolor='#E0E0E0'><td><p align='right'><font color='#4b8df8'><b>" . Yii::app()->createAbsoluteurl("/personstudent/regStepActivationForm") . "/id/" . $_POST['id'] . "/prjid/" . $_POST['prjid'] . "</b></font></p></td></tr>
                 <tr><td><p align='right'>رمز التأكيد " . " : " . $code . "</p></td></tr>
                 </table>";

        //echo $msg_st;
        //return;
        $subject = 'Activation Letter - Mobarat ' . $currentMobarat['mobarat_year'];
        $emailAddressTo = new cls_EMailAddress($email, $pers['Person_fname'] . " " . $pers['Person_lname']);

        $clsEMail = new cls_EMail;
        //echo $clsEMail->sendEMailWithStatic($subject,$msg_st,$emailAddressTo);

        if ($clsEMail->sendEMailWithStatic($subject, $msg_st, $emailAddressTo)) {
            echo "لقد تم ارسال بريد الكتروني للطالب " . $pers['Person_fname'] . " " . $pers['Person_lname'] . ' ' . 'لترشيحه على المشاركة';
        } else {
            echo "حصل خطأ أثناء إرسال البريد الالكتروني";
        }
        //$this->render('confirmationOld');
    }
    private function sendMail($mobarat, $pers, $perStudent, $prjStudent, $schl, $prj, $update)
    {

        if (is_null($pers->Person_userID)) {
            $user =  User::insertNew($mobarat['mobarat_year'], '02', '11');
        } else {
            $user = User::model()->findByPk($pers->Person_userID);
        }

        $subMUN = substr($user['user_mun'], 2);

        $email = $pers['Person_email1'];

        //$schl=  School::model()->findByPk($perStudent->school_id);
        if ($update == 1) {
            $pers->Person_userID = $user->user_id;

            $pers->save();

            $prjStudent['isConfirmed'] = 1;
            $perStudent['isConfirmed'] = 1;
            $prjStudent->save();
            $perStudent->save();
        }
        //echo "5555";return;


        $msg_st = $this->getConfirmationMessage($schl['school_name'], $prj['project_name'], $subMUN, $user['user_password']);
        $clsEmail = new cls_EMail();
        $clsEmailAddress = new cls_EMailAddress($email, $pers['Person_fname'] . " " . $pers['Person_lname']);
        //echo $msg_st;return;
        if ($clsEmail->sendEMailWithStatic('Confirmation', $msg_st, $clsEmailAddress) === true) {
            echo "You will recive an email";
        } else {
            echo "An error occurs when sending the mail";
        }
        if ($update == 1) {
            $this->render('regStepComplete', array('email' => $email, 'current' => $mobarat));
        }
    }

    public function actionregStepActivationForm($id, $prjid)
    {

        $layout = '//layouts/column1';
        $st = " ";
        if (isset($_POST['confCode'])) {

            $currentMobarat =  Mobarat::getOpenMobaratRecord();
            if ($currentMobarat == null) {
                echo 'لا يوجد مباراة مفتوحة للتأكيد';
                return;
            }

            $perStudent =  Personstudent::model()->find('student_personid=' . $id . ' and mobarat_year=' . $currentMobarat['mobarat_year']);
            if ($perStudent == null) {
                echo 'غير مرشح';
                return;
            }
            $prj =  Project::model()->findByPK($prjid);
            if ($prj == null) {
                echo 'المشروع غير موجود';
                return;
            }
            // echo"asdasd";return;
            $prjStudent =  ProjectStudent::model()->find('student_id=' . $perStudent->Student_id . ' and project_id=' . $prjid);
            if ($prjStudent == null) {
                echo 'الطالب غير مرشح للمشروع';
                return;
            }

            $c = $_POST['confCode'];

            // $con = MbConfirmation::model()->findAll('confirmation_school=' . $id);
            if ($perStudent->confirmation_code == $c) {
                $pers = Person::model()->findByPK($id);
                $schl =  School::model()->findByPk($perStudent->school_id);
                $this->sendMail($currentMobarat, $pers, $perStudent, $prjStudent, $schl, $prj, 1);
            } else
                $st = "has-error";
        }
        // else
        $this->renderpartial('regStepActivationForm', array('st' => $st));
    }



    public function actionOldStudent()
    {


        $mainQuery = "FROM person inner join person_student on person_student.student_personid=person.Person_id
                    inner join  project_student on project_student.person_id=person.Person_id
                    inner join project on project.project_id=project_student.project_id and person_student.mobarat_year=project.mobarat_year 
                    inner join school on school.school_id=person_student.school_id,(select @r :=0)as t
                    where school.school_id=" . $_POST['sclid'] . " and project.project_id!=" . $_POST['prjid'] . " and person_fname like '%" . $_POST['fname'] . "%'"
            . " and person_lname like '%" . $_POST['lname'] . "%' and school_name like '%" . $_POST['school'] . "%'";
        if (is_numeric($_POST['myear']))
            $mainQuery .= " and person_student.mobarat_year=" . $_POST['myear'];

        $countQuery = "select count(person.person_id) " . $mainQuery;

        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();

        $query = "SELECT @r := @r+1 AS id, person.person_id,Person_fname,Person_mname,person_lname,person_email1"
            . ",person_student.mobarat_year,school.school_id,school.school_name  " .
            $mainQuery; //.' limit '.$_POST['lmt'].' offset '.$_POST['oft'];

        if ($_POST['showall'] == 'true')
            $limit = 'all'; // ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        else
            $limit = 15;
        //echo $limit;return;

        $page       = (isset($_POST['page'])) ? $_POST['page'] : 1;
        $links      = 5; // ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;

        /*$para=array('page'=>$page,'showall'=>$_POST['showall'],'prjid'=>$_POST['prjid'],'fname'=>$_POST['fname']
                    ,'lname'=>$_POST['lname'],'school'=>$_POST['school'],'myear'=>$_POST['myear']);
       */
        $para = $_POST;
        $para['page'] = $page;
        //$para['showall']=$page;
        $clspaginator = new cls_Paginator($countQuery, $query, $para, CController::createAbsoluteUrl('personstudent/OldStudent'), 'fill_table');
        $stds    = $clspaginator->getData($limit, $page);
        //echo $stds;return;
        //echo  $page.":".$limit.":".count($stds->data);;return;

        if (isset($_POST['page'])) {
            // echo  $page.":".$limit.":".count($stds->data);;//return;
            //return;

        }
        //echo count($stds->data);return;
        //echo $clspaginator->_params['prjid'];return;
        echo $this->renderpartial('oldstudent', array('stds' => $stds, 'clspaginator' => $clspaginator, 'links' => $links), FALSE, TRUE);
    }


    /*
    public function actionOldStudent(){
        //echo $_POST['fname'];
        $query="SELECT @r := @r+1 AS id, person.person_id,Person_fname,Person_mname,person_lname,person_email1,person_student.mobarat_year,school.school_name
                    FROM person inner join person_student on person_student.student_personid=person.Person_id
                     inner join  project_student on project_student.person_id=person.Person_id
                     inner join school on school.school_id=person_student.school_id,(select @r :=0)as t
                    where project_id!=".$_POST['prjid']." and person_fname like '%".$_POST['fname']."%';";
        $stds=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        //echo $query; 
        //echo count($stds);
        //echo 'sdfsdf';
         $this->render('oldstudent',array('stds'=>$stds));
         
         
         $query = Article::find()->where(['status' => 1]);

// get the total number of articles (but do not fetch the article data yet)
$count = $query->count();

// create a pagination object with the total count
$pagination = new Pagination(['totalCount' => $count]);

// limit the query using the pagination and retrieve the articles
$articles = $query->offset($pagination->offset)
    ->limit($pagination->limit)
    ->all();
        
    }
    

*/
    public function actionregStep4($prjid)
    {

        //Yii::app()->session['projId'] = $id; //$_POST['id'];

        //
        $currentMobarat =  Mobarat::getOpenMobaratRecord();
        //echo $id;
        if ($currentMobarat == null) {
            echo 'لا يوجد مباراة مفتوحة للتسجيل';
            return;
        }
        //$d = new DateTime();
        //$date = $d->format('Y-m-d');
        //if (strtotime($date) > strtotime($currentMobarat['last_register_teacher_student'])){
        if (!Mobarat::isOpenForRegisterTeacherStudent($currentMobarat)) {
            echo "إنتهت مهلة التسجيل!";
            return;
        }
        //
        $cp =  ProjectStudent::model()->count("not student_id is null and not person_id is null and project_id=" . $prjid);
        if ($cp >= $currentMobarat['StudentNbForProject']) {
            echo "لا يمكن إضافة طالب، لأنه سوف تتجاوز العدد المسموح به من الطلاب لكل مشروع";
            return;
        }
        $prj =  Project::model()->findByPk($prjid);
        if ($prj == null) {
            echo 'يوجد خطأ بمعطيات التسجيل';
            return;
        }
        $pers = new Person;

        if (isset($_POST['Person'])) {
            //$Validator=new yii\validators\EmailValidator();
            $pers->attributes = $_POST['Person'];
            if ($pers->validate(array('Person_email1'))) {
                $pers->save();
                $persStudent = new Personstudent();
                $persStudent->student_personid = $pers->Person_id;
                $persStudent->mobarat_year = $currentMobarat['mobarat_year'];
                $persStudent->school_id = $prj->school_id;
                $persStudent->isConfirmed = true;
                $persStudent->save();
                $prjStd = new ProjectStudent();
                $prjStd->person_id = $pers->Person_id;
                $prjStd->project_id = $prjid;
                $prjStd->student_id = $persStudent->Student_id;
                $prjStd->isConfirmed = true;
                $prjStd->save();
                $schl =  School::model()->findByPK($prj->school_id);
                //$prj=  Project::model()->findByPK($prjid);
                //echo 1;return;
                $this->sendMail($currentMobarat, $pers, $persStudent, $prjStd, $schl, $prj, 1);
            }
        }
        $this->render('regStep4', array('model' => $pers));
    }

    public function actionSendMailToStudent($id, $stdid, $prjid, $schid)
    {

        $currentMobarat = Mobarat::getOpenMobaratRecord();
        $pers = Person::model()->findBypk($id);
        $persStudent = Personstudent::model()->findBypk($stdid);

        $prjStd = ProjectStudent::model()->find("student_id=" . $stdid . " and project_id=" . $prjid);
        //  echo count($persStudent);echo  $persStudent['school_id'];return;
        $schl = School::model()->findBypk($persStudent['school_id']);
        //   
        $prj = Project::model()->findBypk($prjid);
        //echo"asd";return;
        $this->sendMail($currentMobarat, $pers, $persStudent, $prjStd, $schl, $prj, 0);
    }


    public function actionreportnotcomplete()
    {
        $current = Mobarat::getOpenMobaratRecord();
        $query = "select Person_id,Person_fname,Person_mname,Person_lname,Person_email1
                    ,Person_birthdate,mobarat_year,Person_Phone
                    ,(select code_name from codes where code_kind=103 and code_no=Person_sex)as Person_sex
                    ,(select code_name from codes where code_kind=104 and code_no=student_class)as student_class
                    ,user_id,user_mun
                from person inner join person_student on person.Person_id=person_student.student_personid
                inner join user on user.user_id=Person_userID
                where not Person_userID is null and((Person_fname IS NULL OR Person_mname IS NULL OR Person_sex IS NULL OR Person_lname IS NULL OR Person_Phone IS NULL 
                OR Person_birthdate IS NULL OR student_class IS NULL OR Person_email1 IS NULL))
                and mobarat_year=" . $current['mobarat_year'];
        $stds = Yii::app()->getDB()->createCommand($query)->queryall();
        //echo count($schls);return;
        $this->render('reportnotcomplete', array('stds' => $stds));
    }

    public function actionreportall()
    {

        //$this->render('reportmain'); 
        $title = 'تقرير الطلاب';
        $bodyreport = '/personstudent/reportbodyall';
        $bodyreportparams = array();
        $searchcontrol = '/report/scstudent01';
        $toexcelurl = 'personstudent/toexcel';
        $params = array('bodyreport' => $bodyreport, 'bodyreportparams' => $bodyreportparams, 'showcsv' => 'true', 'toexcelurl' => $toexcelurl);
        $this->render('/report/reportmain', array('title' => $title, 'searchcontrol' => $searchcontrol, 'params' => $params));
        //$this->render('/report/reportmain',array('title'=>$title,'bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams));  
    }
    public function actionreportbodyall()
    {
        $filter = '1=1';

        if (strlen($_POST['fname']) > 0)
            $filter .= " and person_fname like '%" . $_POST['fname'] . "%' ";
        if (strlen($_POST['lname']) > 0)
            $filter .= " and person_fname like '%" . $_POST['lname'] . "%' ";
        if (strlen($_POST['school']) > 0)
            $filter .= " and school_name like '%" . $_POST['school'] . "%' ";
        if (is_numeric($_POST['myear']))
            $filter .= " and person_student.mobarat_year=" . $_POST['myear'];

        $mainQuery = "FROM person inner join person_student on person_student.student_personid=person.Person_id
                    inner join  project_student on project_student.person_id=person.Person_id
                    inner join project on project.project_id=project_student.project_id and person_student.mobarat_year=project.mobarat_year 
                    inner join school on school.school_id=person_student.school_id,(select @r :=0)as t";
        //                    where person_fname like '%".$_POST['fname']."%'"
        //                . " and person_lname like '%".$_POST['lname']."%' and school_name like '%".$_POST['school']."%'";
        $mainQuery .= " where " . $filter;

        $countQuery = "select count(person.person_id) " . $mainQuery;

        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();

        $query = "SELECT @r := @r+1 AS id, person.person_id,Person_fname,Person_mname,person_lname,person_email1"
            . ",person_student.mobarat_year,school.school_id,school.school_name,project.project_id,project_name  "
            . ",(select user_mun from user where user_id=person_userID) as mun "
            .  $mainQuery; //.' limit '.$_POST['lmt'].' offset '.$_POST['oft'];

        if ($_POST['showall'] == 'true')
            $limit = 'all'; // ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        else
            $limit = 15;
        //echo $limit;return;

        $page       = (isset($_POST['page'])) ? $_POST['page'] : 1;
        $links      = 5; // ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;

        /*$para=array('page'=>$page,'showall'=>$_POST['showall'],'prjid'=>$_POST['prjid'],'fname'=>$_POST['fname']
                    ,'lname'=>$_POST['lname'],'school'=>$_POST['school'],'myear'=>$_POST['myear']);
       */
        $para = $_POST;
        $para['page'] = $page;
        //$para['showall']=$page;
        $clspaginator = new cls_Paginator($countQuery, $query, $para, CController::createAbsoluteUrl('Personstudent/reportbodyall'), 'fill_table');
        $stds    = $clspaginator->getData($limit, $page); {
            echo $this->renderpartial('/personstudent/reportbodyall', array('stds' => $stds, 'clspaginator' => $clspaginator, 'links' => $links), FALSE, TRUE);
        }
    }


    /*******  old methode  */
    // public function actiontoexcel(){ 
    //     $filter='1=1';

    //     if (strlen($_POST['txtFname'])>0)
    //         $filter .=" and person_fname like '%".$_POST['txtFname']."%' ";
    //     if (strlen($_POST['txtLname'])>0)
    //         $filter .=" and person_fname like '%".$_POST['txtLname']."%' ";
    //     if (strlen($_POST['txtSchool'])>0)
    //         $filter .=" and school_name like '%".$_POST['txtSchool']."%' ";
    //     if(is_numeric($_POST['txtYear']))
    //         $filter.=" and person_student.mobarat_year=".$_POST['txtYear'];
    //     $query="SELECT  person.person_id,Person_fname,Person_mname,person_lname,person_email1
    //             ,person_student.mobarat_year,school.school_id,school.school_name,project.project_id,project_name  
    //                 FROM person inner join person_student on person_student.student_personid=person.Person_id
    //                 inner join  project_student on project_student.person_id=person.Person_id
    //                 inner join project on project.project_id=project_student.project_id and person_student.mobarat_year=project.mobarat_year 
    //                 inner join school on school.school_id=person_student.school_id,(select @r :=0)as t
    //                ";
    //     $query.=" where ".$filter; 

    //      $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
    //      $label=array('الرقم','السم','الاب','الشهرة','email','السنة','رقم المدرسة','المدرسة','رقم المشروع','المشروع');
    //      cls_toCSV::exportToCSV('student.csv',$label,$rs);
    // }

public function actiontoexcel()
{
    $filter = '1=1';

    if (strlen($_POST['txtFname']) > 0)
        $filter .= " and person_fname like '%" . $_POST['txtFname'] . "%' ";
    if (strlen($_POST['txtLname']) > 0)
        $filter .= " and person_lname like '%" . $_POST['txtLname'] . "%' ";
    if (strlen($_POST['txtSchool']) > 0)
        $filter .= " and school_name like '%" . $_POST['txtSchool'] . "%' ";
    if (is_numeric($_POST['txtYear']))
        $filter .= " and person_student.mobarat_year=" . $_POST['txtYear'];

    // Only class name, not code
    $query = "SELECT person.person_id,Person_fname,Person_mname,person_lname,person_email1
        ,person_student.mobarat_year,school.school_id,school.school_name,project.project_id,project_name,
        (SELECT code_name FROM codes WHERE code_kind=104 AND code_no=person_student.student_class) as class_name
        FROM person 
        INNER JOIN person_student ON person_student.student_personid=person.Person_id
        INNER JOIN project_student ON project_student.person_id=person.Person_id
        INNER JOIN project ON project.project_id=project_student.project_id AND person_student.mobarat_year=project.mobarat_year 
        INNER JOIN school ON school.school_id=person_student.school_id,(SELECT @r :=0)as t
        WHERE $filter";



$rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
         $label=array('الرقم','السم','الاب','الشهرة','email','السنة','رقم المدرسة','المدرسة','رقم المشروع','المشروع');
         cls_toCSV::exportToCSV('student.csv',$label,$rs);



         
    // $rs = Yii::app()->getDB()->createCommand($query)->queryAll(true);

    // // Only class name in label
    // $label = array('الرقم', 'السم', 'الاب', 'الشهرة', 'email', 'السنة', 'رقم المدرسة', 'المدرسة', 'رقم المشروع', 'المشروع', 'صف الطالب');

    // // Remove code, keep only class name
    // foreach ($rs as &$row) {
    //     $row['class_name'] = $row['class_name'] ?? '';
    // }

    // cls_toCSV::exportToCSV('student.csv', $label, $rs);
}


    public function actionlistbyscl($id)
    {
        $current = Mobarat::getOpenMobaratRecord();
        $query = "select user_mun,Student_id,person_id,school_id,Person_fname,Person_lname,(select code_name from codes where code_no=Person_sex and code_kind=103)as Person_sex
                ,Person_email1,Person_CellPhone,(select code_name from codes where code_no=student_class and code_kind=104) as student_class
                ,person.Person_birthdate
                from person inner join person_student on person.Person_id=person_student.student_personid
                left join user on user_id=person.Person_userID
                where mobarat_year=" . $current['mobarat_year'] . " and school_id=" . $id;
        $std = Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $this->render('listbyscl', array('std' => $std));
    }

    public function actionScholarship($stdid)
    {
        $current = Mobarat::getOpenMobaratRecord();
        $schp = StudentScholarship::model()->find("student_id=" . $stdid . " and mobarat_year=" . $current['mobarat_year']);
        $std = Personstudent::model()->findByPk($stdid);
        if ($std->student_class == '05')
            $schp->student_class = $std->student_class;

        if (isset($_POST['StudentScholarship'])) {
            $schp->attributes = $_POST['StudentScholarship'];
            if ($schp->validate()) {
                $file = CUploadedFile::getInstanceByName('file');
                if (isset($file) && count($file) > 0) {
                    $ext = substr($file->name, strrpos($file->name, ".") + 1);
                    if ($ext == 'pdf' || $ext == 'rar' || $ext == 'zip') {
                        $path =  cls_attach::getRelatedFolder(enm_Program::SCHOLARSHIP_ID, $schp->student_scholarship_id);
                        move_uploaded_file($file->tempName, $path . $file->name);
                        $schp->id_attachment = $file->name;
                    }
                }

                $file = CUploadedFile::getInstanceByName('file_grade');
                if (isset($file) && count($file) > 0) {
                    $ext = substr($file->name, strrpos($file->name, ".") + 1);
                    if ($ext == 'pdf' || $ext == 'rar' || $ext == 'zip') {
                        $path =  cls_attach::getRelatedFolder(enm_Program::SCHOLARSHIP_GRADE, $schp->student_scholarship_id);
                        move_uploaded_file($file->tempName, $path . $file->name);
                        $schp->Grade_attachment = $file->name;
                    }
                }
                if ($schp->save()) {
                    $this->redirect(array('participant/Index'));
                }
            }
        }
        //echo $stdid;return;
        $this->render('Scholarship', array('model' => $schp, 'std' => $std), false, true);
    }
}
