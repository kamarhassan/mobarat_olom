<?php

class PersonteacherController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
                        array('application.filters.PersonTeacherFilter',),
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','regStepComplete','regStepActivationForm'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','regStep1','regStep2','regSetp3','regStep4'
                                        ,'OldTeacher','RoleYes','RoleNo','reportall','reportbodyall','toexcel'
                                        ,'listbyscl','Delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Personteacher;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personteacher']))
		{
			$model->attributes=$_POST['Personteacher'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->teacher_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personteacher']))
		{
			$model->attributes=$_POST['Personteacher'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->teacher_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
            $id=$_POST['id'];
            $query="delete from project_teacher where teacher_id=".$id.";
                    delete from person_teacher where teacher_id=".$id."; ";
            Yii::app()->getDB()->createCommand($query)->execute();
             echo $id;
		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Personteacher');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Personteacher('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personteacher']))
			$model->attributes=$_GET['Personteacher'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Personteacher the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Personteacher::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Personteacher $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='person-teacher-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    private function getConfirmationMessage($schname,$projname,$subMUN,$user_password){
        $msg_st= "<table cellpadding='10' style='border:1px solid black;border-collapse:collapse; direction:rtl'>
                    <th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
                            <tr ><td><p align='right'><font color='#4b8df8'></font> جانب الاستاذ/الاستاذة المحترم/ المحترمة  في مدرسة <b>" . " " . $schname ."</b></p></tr>
                            <tr bgcolor='#E0E0E0' align='right'><td>اسم المشروع: " . $projname . "</td></tr>
                            <tr ><td> <p align='right'>لقد تم تأكيد تسجيل في مباراة العلوم ، إن كافة المراسلات سوف ترد إلى بريدكم الإلكتروني هذا. </br>http://mobarat.nasr.org.lb :لتسجيل الدخول</p></td></tr>
                            <tr  bgcolor='#E0E0E0'><td><p align='right'>MUN في خانة اسم المستخدم يجب كتابة الرقم الخاص بمدرستكم </p></td></tr>
                            <tr><td><p align='right'><font color='#4b8df8'><b>" . $subMUN . "</b></font> :MUN</p></td></tr>
                            <tr bgcolor='#E0E0E0'><td><p align='right'><font color='#4b8df8'><b>" . $user_password . "</b></font>:كلمة المرور</p></td></tr>
                            <tr><td><p align='right'>الخطوات اللاحقة: إكمال معلومات تسجيلك من خلال الدخول إلى موقع التسجيل.</p></td></tr>
                    </table>";

        return $msg_st;
    }
    public function actionregStep1($sclid) {
        $current=  Mobarat::getOpenMobaratRecord();

        $query="select project_id,mobarat_year,school_id,project_name
                    ,(select count( ps. project_id) from project_teacher as ps where ps. project_id=project.project_id) as teachcount
                    from project
                    where school_id=" . $sclid . " AND mobarat_year=" . $current['mobarat_year'] ;        
    
        $project=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        
        $query="select person.person_id,Person_fname,Person_lname,Person_email1,project.project_id,person_teacher.isConfirmed 
                    from person inner join person_teacher on teacher_personid=person.Person_id
                    inner join project_teacher on project_teacher.person_id=person.person_id
                    inner join project on project.project_id=project_teacher.project_id and person_teacher.mobarat_year=project.mobarat_year
                    where project.school_id=" . $sclid . " AND project.mobarat_year=" . $current['mobarat_year'] ;        
    
        $teah=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        
       
        $this->render('regStep1', array('project' => $project,'teah'=>$teah,'current'=>$current));
    }
    
    
    public function actionregStep2($prjid) {
        $title='إختيار أستاذ مشار ك  سابقاً';
        $bodyreport='personteacher/OldTeacher';
        $pr= Project::model()->findBypk($prjid);
        $bodyreportparams=array('prjid'=>$prjid,'sclid'=>$pr->school_id);
        $searchcontrol='/report/scstudent01';
        $params=array('showcsv'=>'false');
        $params=array('bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams,'showcsv'=>'false');
        $this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol
                ,'params'=>$params));  
         
        //$this->render('regStep2', array('prjid' => $prjid));
    }
    
    public function actionregSetp3() {
        //echo $_POST['schlid'].'; '.$_POST['prjid'].'; '.$_POST['id'];
       
        $currentMobarat =  Mobarat::getOpenMobaratRecord();
        //echo $id;
        if ($currentMobarat == null){
            echo 'لا يوجد مباراة مفتوحة للتسجيل';
            return;
        }
        //
        //$d = new DateTime();
        //$date = $d->format('Y-m-d');
        //if (strtotime($date) > strtotime($currentMobarat['last_register_teacher_student'])){
        if (!Mobarat::isOpenForRegisterTeacherStudent($currentMobarat)){
             echo "إنتهت مهلة التسجيل!";
            return;
        }
        
        $cp= ProjectTeacher::model()->count("project_id=".$_POST['prjid']);
        if($cp>=$currentMobarat['TeacherNbForProject'])
        {
            echo "لا يمكن إضافة أستاذ، لأنه سوف تتجاوز العدد المسموح به من الاساتذة المشرفين لكل مشروع";
            return;
        }
       
        
        $minute = date('i');
        $second = date('s');
        $code = $minute . $_POST['id'] . $second;
        //return;
        $pers=  Person::model()->findByPk($_POST['id']);
        $prj=  Project::model()->findByPk($_POST['prjid']);
        if ($pers == null || $prj==null){
            echo 'يوجد خطأ بمعطيات التسجيل';
            return;
        }
        
        //$bolExistBefore=FALSE;
        $persTeacher=  Personteacher::model()->find('teacher_personid='.$_POST['id'] .' and school_id= ' . $_POST['schlid'] . ' and mobarat_year=' .$currentMobarat['mobarat_year']);
        if ($persTeacher == null){
            // echo "9999";
            //return;
            $persTeacher=new Personteacher();
            $persTeacher->teacher_personid=$_POST['id'];
            $persTeacher->mobarat_year=$currentMobarat['mobarat_year'];
            $persTeacher->school_id=$_POST['schlid'];
        }elseif($persTeacher->isConfirmed==FALSE){
             
            $prjTeach= ProjectTeacher::model()->find('project_id !='.$_POST['prjid'].'   and teacher_id='.$persTeacher->teacher_id);
            // echo ";".count($prjStd).";";
            //return;
            if($prjTeach!=NULL  ){
                echo 'إن الاستاذ '. $pers['Person_fname'].' '.$pers['Person_lname']. ' ' .'لم يؤكد تسجيله لمشروع اخر، لذلك لا يمكن ترشيحه لهذا المشروع قبل تأكيده';
                return;
            }
           
        }//else
         //   $bolExistBefore=TRUE;
        //echo "122";
        //return;
        $persTeacher->confirmation_code=$code;
        $persTeacher->isConfirmed=FALSE;
        $persTeacher->save();
        //echo "saved";
       // return;
        echo ";".$persTeacher->teacher_id.";";
        $prjTeach=  ProjectTeacher::model()->find('project_id='.$_POST['prjid'].'   and teacher_id='.$_POST['id']);
        if($prjTeach==NULL){
            $prjTeach= new ProjectTeacher();
            $prjTeach->person_id=$_POST['id'];
            $prjTeach->project_id=$_POST['prjid'];
            $prjTeach->teacher_id=$persTeacher->teacher_id;
            $prjTeach->save();
           // echo "saved";
        //return;
        }
        $email = $pers['Person_email1'];
             
        $msg_st = "<table cellpadding='10' dir='rtl' style='border:1px solid black;border-collapse:collapse;'>
                    <th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
                 <tr ><td> <p align='right'>جانب الاستاذ  المحترم" . " " . $pers['Person_fname'] . " " . $pers['Person_lname'] . "  </p></td></tr>
                 <tr  bgcolor='#E0E0E0'><td direction='rtl'><p align='right'>  لقد تم ترشيحكم للمشاركة في مباراة العلوم " . " " . $currentMobarat['mobarat_year'] . "</p></td></tr>
                 <tr  bgcolor='#E0E0E0'><td direction='rtl'><p align='right'>   من خلال المشروع" . " " . $prj['project_name'] . "</p></td></tr>
                 <tr><td><p align='right'><font color='#4b8df8'> لتأكيد الترشيح </p></td></tr>
                 <tr bgcolor='#E0E0E0'><td><p align='right'><font color='#4b8df8'><b>" . Yii::app()->createAbsoluteurl("/personteacher/regStepActivationForm"). "/id/".$_POST['id']."/prjid/" . $_POST['prjid'] . "</b></font></p></td></tr>
                 <tr><td><p align='right'>رمز التأكيد " . " : " . $code . "</p></td></tr>
                 </table>";
      
        //echo $msg_st;
        //return;
        $subject = 'Activation Letter - Mobarat ' . $currentMobarat['mobarat_year'];
        $emailAddressTo=new cls_EMailAddress($email, $pers['Person_fname'] . " " . $pers['Person_lname']);
        
        $clsEMail=new cls_EMail;
        //echo $clsEMail->sendEMailWithStatic($subject,$msg_st,$emailAddressTo);
        
        if($clsEMail->sendEMailWithStatic($subject,$msg_st,$emailAddressTo)){
              echo "لقد تم ارسال بريد الكتروني للطالب " .$pers['Person_fname'] . " " . $pers['Person_lname']. ' '.'لترشيحه على المشاركة';
        }else{
              echo "حصل خطأ أثناء إرسال البريد الالكتروني";
        }
        //$this->render('confirmationOld');
     }
     
     public function actionOldTeacher(){
        //echo $_POST['fname'];
        //return;
       
        $mainQuery="FROM person inner join person_teacher on person_teacher.teacher_personid=person.Person_id
                    inner join school on school.school_id=person_teacher.school_id
                    inner join  project_teacher on project_teacher.person_id=person.Person_id and project_teacher.teacher_id=person_teacher.teacher_id
                    inner join project on project.project_id=project_teacher.project_id and person_teacher.mobarat_year=project.mobarat_year 
                    ,(select @r :=0)as t
                    where school.school_id=".$_POST['sclid']." and project.project_id!=".$_POST['prjid']." and person_fname like '%".$_POST['fname']."%'"
                . " and person_lname like '%".$_POST['lname']."%' and school_name like '%".$_POST['school']."%'";
        if(is_numeric($_POST['myear']))
            $mainQuery.=" and person_teacher.mobarat_year=".$_POST['myear'];
        
        $countQuery="select count(person.person_id) ". $mainQuery;
        
        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        
        $query="SELECT @r := @r+1 AS id, person.person_id,Person_fname,Person_mname,person_lname,person_email1"
                . ",person_teacher.mobarat_year,school.school_id,school.school_name  ".
                            $mainQuery;//.' limit '.$_POST['lmt'].' offset '.$_POST['oft'];
      
        $limit      = ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        $page       = ( isset( $_POST['page'] ) ) ? $_POST['page'] : 1;
        $links      =5;// ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;
        
        $para=array('page'=>$page,'prjid'=>$_POST['prjid'],'fname'=>$_POST['fname']
                    ,'lname'=>$_POST['lname'],'school'=>$_POST['school'],'myear'=>$_POST['myear']);
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('personteacher/OldStudent'),'fill_table');
        $teachs    = $clspaginator->getData(  $limit ,$page);
        //echo $stds;return;
        //echo  $page.":".$limit.":".count($stds->data);;return;
        
         if(isset($_POST['page'])){
           // echo  $page.":".$limit.":".count($stds->data);;//return;
            //return;
            
        }
        echo $this->renderpartial('oldteacher',array('teachs'=>$teachs,'clspaginator'=>$clspaginator,'links'=>$links),FALSE,TRUE);
           
    }
    
    private function sendMailToTeacher($mobarat,$pers,$perTeacher,$prjTeacher,$schl,$prj){
        if (is_null($pers->Person_userID)){
            $user=  User::insertNew($mobarat['mobarat_year'],'02','13');
        }
        else{
            $user = User::model()->findByPk( $pers->Person_userID);
        }
        $subMUN = substr($user['user_mun'], 2);
        $email = $pers['Person_email1'];
        //$schl=  School::model()->findByPk($perStudent->school_id);
        $pers->Person_userID=$user->user_id;
        $pers->save();
        $prjTeacher->isConfirmed=1;
        $perTeacher->isConfirmed=1;
        $prjTeacher->save();
        $perTeacher->save();


        $msg_st=$this->getConfirmationMessage($schl->school_name,$prj->project_name,$subMUN,$user['user_password']);
        $clsEmail=new cls_EMail();
        $clsEmailAddress=new cls_EMailAddress($email, $pers['Person_fname'] . " " . $pers['Person_lname']);

        if($clsEmail->sendEMailWithStatic('Confirmation',$msg_st,$clsEmailAddress)===true)
        {
            echo "You will recive an email";
        }
        else {
            echo "An error occurs when sending the mail";
        }

        $this->render('regStepComplete',array('email'=>$email,'current'=>$mobarat));
    }
        
    public function actionregStepActivationForm($id,$prjid) {
    	
    	$layout = '//layouts/column1';
        $st = " ";
        if (isset($_POST['confCode'])) {
           
            $currentMobarat =  Mobarat::getOpenMobaratRecord();
            if ($currentMobarat == null){
                echo 'لا يوجد مباراة مفتوحة للتأكيد';
                return;
            }
            
            $perTeacher=  Personteacher::model()->find('teacher_personid='.$id.' and mobarat_year='.$currentMobarat['mobarat_year']);
            if($perTeacher==null){
                echo 'غير مرشح';
                return;
            }
            $prj=  Project::model()->findByPK($prjid);
            if($prj==null){
                echo 'المشروع غير موجود';
                return;
            }
            // echo"asdasd";return;
            $prjTeacher= ProjectTeacher::model()->find('teacher_id='.$perTeacher->teacher_id.' and project_id='.$prjid);
            if($prjTeacher==null){
                echo 'الاستاذ غير مرشح للمشروع';
                return;
            }
             
            $c = $_POST['confCode'];
           
           // $con = MbConfirmation::model()->findAll('confirmation_school=' . $id);
            if ($perTeacher->confirmation_code == $c) {
                $pers = Person::model()->findByPK($id);
                $schl=  School::model()->findByPk($perTeacher->school_id);
                $this->sendMailToTeacher($currentMobarat,$pers,$perTeacher,$prjTeacher,$schl,$prj);
            }
            else
               $st="has-error" ;
        }
       // else
            $this->renderpartial('regStepActivationForm', array( 'st' => $st));
    }
   
    public function actionregStep4($prjid) {

        //Yii::app()->session['projId'] = $id; //$_POST['id'];

        //
        $currentMobarat =  Mobarat::getOpenMobaratRecord();
        //echo $id;
        if ($currentMobarat == null){
            echo 'لا يوجد مباراة مفتوحة للتسجيل';
            return;
        }
        //$d = new DateTime();
        //$date = $d->format('Y-m-d');
        //if (strtotime($date) > strtotime($currentMobarat['last_register_teacher_student'])){
        if (!Mobarat::isOpenForRegisterTeacherStudent($currentMobarat)){
             echo "إنتهت مهلة التسجيل!";
            return;
        }
        //
        $cp= ProjectTeacher::model()->count("project_id=".$prjid);
        if($cp>=$currentMobarat['TeacherNbForProject']){
            echo "لا يمكن إضافة أستاذ، لأنه سوف تتجاوز العدد المسموح به من الاساتذة لكل مشروع";
            return;
        }
        $prj=  Project::model()->findByPk($prjid);
        if ($prj==null){
            echo 'يوجد خطأ بمعطيات التسجيل';
            return;
        }
        $pers = new Person;

        if (isset($_POST['Person'])) {
        	//$Validator=new yii\validators\EmailValidator();
            $pers->attributes = $_POST['Person'];
            if ($pers->validate(array('Person_email1'))){
                $pers->save();
                $persTeacher=new Personteacher();
                $persTeacher->teacher_personid=$pers->Person_id;
                $persTeacher->mobarat_year=$currentMobarat['mobarat_year'];
                $persTeacher->school_id=$prj->school_id;
                $persTeacher->isConfirmed=true;
                $persTeacher->save();
                $prjTeac= new ProjectTeacher();
                $prjTeac->person_id=$pers->Person_id;
                $prjTeac->project_id=$prjid;
                $prjTeac->teacher_id=$persTeacher->teacher_id;
                $prjTeac->isConfirmed=true;
                $prjTeac->save();
                $schl=  School::model()->findByPK($prj->school_id);
                //$prj=  Project::model()->findByPK($prjid);
                
                $this->sendMailToTeacher($currentMobarat,$pers,$persTeacher,$prjTeac,$schl,$prj);
                
            }
        }
        $this->render('regStep4', array('model' => $pers));
    }
    
    public function actionRoleYes($stdid,$persstdid,$persteaid) {
        //echo "21222";return;
      
        /*$persStd=  Personstudent::model()->findByPk($id);
        $persStd->student_CanModifyProject=true;
        $persStd->save();*/
        Personstudent::model()->updateByPk($stdid,array('student_CanModifyProject' => 1));
        $std=  Person::model()->findByPk($persstdid);
        $teach=  Person::model()->findByPk($persteaid);
        $msg="لقد سمح لك الأستاذ " . $teach['Person_fname'] . " " . $teach['Person_lname'] . " " . " التعديل على مشروعك";;
        
        MbNotification::sendNotificationToUser($std->Person_userID, $msg);
/*
        $teach = MbTeacher::model()->findAll('teacher_user=' . Yii::app()->user->getId());

        MbStudent::model()->updateAll(array('student_role' => 1), 'student_id=' . $id);
        $std = MbStudent::model()->findAll('student_id=' . $id);

        $notification = new MbNotification;

        date_default_timezone_set('Asia/Beirut');
        $notification->sender_id = Yii::app()->user->getId();
        $notification->notification_time = date('H:i:s');
        $notification->notification_date = date('Y-m-d');
        $notification->notification_content = "لقد سمح لك الأستاذ " . $teach[0] ['teacher_fname'] . " " . $teach[0]['teacher_lname'] . " " . " التعديل على مشروعك";
        $notification->save();


        $notificationRec = new NotificationReceived;
        $notificationRec->notification_id = $notification->notification_id;
        $notificationRec->user_id = $std[0]['student_user'];
        $notificationRec->flag = 0;
        $notificationRec->save();*/
		
		 

                                            //$cl = "green";
                                            //$cl = "white";
                                           $clt = "نعم";
                                           // $path = "RoleNo";
                                        
                                        



        //echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
        //, array('update' => '#sp'.$id, 'data' => array('id' => $id))); 

		echo $clt ;
		
    }

    public function actionRoleNo($stdid,$persstdid,$persteaid) {
        Personstudent::model()->updateByPk($stdid,array('student_CanModifyProject' => 0));
        $std=  Person::model()->findByPk($persstdid);
        $teach=  Person::model()->findByPk($persteaid);
        $msg="لقد ألغى  الأستاذ " . $teach['Person_fname'] . " " . $teach['Person_lname'] . " " . " صلاحية التعديل على مشروعك";;
        
        MbNotification::sendNotificationToUser($std->Person_userID, $msg);
        /*
        MbStudent::model()->updateAll(array('student_role' => 0), 'student_id=' . $id);
        $teach = MbTeacher::model()->findAll('teacher_user=' . Yii::app()->user->getId());
        $std = MbStudent::model()->findAll('student_id=' . $id);
        $notification = new MbNotification;

        date_default_timezone_set('Asia/Beirut');
        $notification->sender_id = Yii::app()->user->getId();
        $notification->notification_time = date('H:i:s');
        $notification->
                notification_date = date('Y-m-d');
        $notification->notification_content = "لقد ألغى الأستاذ " . $teach[0]['teacher_fname'] . " " . $teach[0]['teacher_lname'] . " " . "صلاحية التعديل على مشروعك";
        $notification->save();


        $notificationRec = new NotificationReceived;
        $notificationRec->notification_id = $notification->notification_id;
        $notificationRec->user_id = $std[0]['student_user'];

        $notificationRec->flag = 0;
        $notificationRec->save();*/
		                                            //$cl = "red";
		                                            // $cl = "white";
                                            $clt = "كلا";
                                            //$path = "RoleYes";
		 //echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
		        //, array('update' => '#sp'.$id, 'data' => array('id' => $id)));
		 //echo "<button id=\"sp". $id."\"  type=\"button\" data-loading-text=\"...إنتظار\" class=\"demo-loading-btn btn ' . $cl . '\">' . $clt . '</button>";
		 echo $clt; 
    }

    public function actionreportall(){
        
        //$this->render('reportmain'); 
        $title='تقرير الاستاذ المشرف';
        $bodyreport='personteacher/reportbodyall';
        $bodyreportparams=array();
        $searchcontrol='/report/scstudent01';
        $toexcelurl='personteacher/toexcel';
        $params=array('bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams,'showcsv'=>'true','toexcelurl'=>$toexcelurl);
        $this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'params'=>$params));  
        //$this->render('/report/reportmain',array('title'=>$title,'bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams));  
    }
    
    public function actionreportbodyall(){
        $filter='1=1';
        
        if (strlen($_POST['fname'])>0)
            $filter .=" and person_fname like '%".$_POST['fname']."%' ";
        if (strlen($_POST['lname'])>0)
            $filter .=" and person_fname like '%".$_POST['lname']."%' ";
        if (strlen($_POST['school'])>0)
            $filter .=" and school_name like '%".$_POST['school']."%' ";
        if(is_numeric($_POST['myear']))
            $filter.=" and person_teacher.mobarat_year=".$_POST['myear'];
        
        $mainQuery="FROM person inner join person_teacher on person_teacher.teacher_personid=person.Person_id
                    inner join  project_teacher on project_teacher.person_id=person.Person_id
                    inner join project on project.project_id=project_teacher.project_id and person_teacher.mobarat_year=project.mobarat_year 
                    inner join school on school.school_id=person_teacher.school_id,(select @r :=0)as t
                   ";
       $mainQuery.=" where ".$filter;
       
        $countQuery="select count(person.person_id) ". $mainQuery;
        
        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        
        $query="SELECT @r := @r+1 AS id, person.person_id,Person_fname,Person_mname,person_lname,person_email1"
                . ",person_teacher.mobarat_year,school.school_id,school.school_name, Person_Phone, Person_CellPhone  "
                . ",(select user_mun from user where user_id=person_userID) as mun "
                . $mainQuery;//.' limit '.$_POST['lmt'].' offset '.$_POST['oft'];
      
        if($_POST['showall']=='true')
           $limit='all';// ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        else
            $limit=15;
        //echo $limit;return;
       
        $page       = ( isset( $_POST['page'] ) ) ? $_POST['page'] : 1;
        $links      =5;// ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;
        
        
        $para=$_POST;
        $para['page']=$page;
        //$para['showall']=$page;
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('personteacher/reportbodyall'),'fill_table');
        $teachs    = $clspaginator->getData(  $limit ,$page);
        //echo $limit;      return; 
         echo $this->renderpartial('/personteacher/reportbodyall',array('teachs'=>$teachs,'clspaginator'=>$clspaginator,'links'=>$links),FALSE,TRUE);        
           
    }
    
    public function actiontoexcel(){ 
        $filter='1=1';
        
        if (strlen($_POST['txtFname'])>0)
            $filter .=" and person_fname like '%".$_POST['txtFname']."%' ";
        if (strlen($_POST['txtLname'])>0)
            $filter .=" and person_fname like '%".$_POST['txtLname']."%' ";
        if (strlen($_POST['txtSchool'])>0)
            $filter .=" and school_name like '%".$_POST['txtSchool']."%' ";
        if(is_numeric($_POST['txtYear']))
            $filter.=" and person_teacher.mobarat_year=".$_POST['txtYear'];
        $query="SELECT  person.person_id,Person_fname,Person_mname,person_lname,person_email1
                ,person_teacher.mobarat_year,school.school_id,school.school_name , Person_Phone, Person_CellPhone 
                   FROM person inner join person_teacher on person_teacher.teacher_personid=person.Person_id
                    inner join  project_teacher on project_teacher.person_id=person.Person_id
                    inner join project on project.project_id=project_teacher.project_id and person_teacher.mobarat_year=project.mobarat_year 
                    inner join school on school.school_id=person_teacher.school_id,(select @r :=0)as t
                    ";
        $query.=" where ".$filter; 
         
         $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
         $label=array('الرقم','السم','الاب','الشهرة','email','السنة','رقم المدرسة','المدرسة','هاتف','خليوي');
         cls_toCSV::exportToCSV('teacher.csv',$label,$rs);
    }
    
    public function actionlistbyscl($id){
        $current= Mobarat::getOpenMobaratRecord();
        $query="select user_mun,person_id,teacher_id,school_id,Person_fname,Person_lname,(select code_name from codes where code_no=Person_sex and code_kind=103)as Person_sex,Person_email1,Person_CellPhone,teacher_levelStudy
                from person inner join person_teacher on person.Person_id=person_teacher.teacher_personid
                inner join user on user_id=person.Person_userID
                where mobarat_year=".$current['mobarat_year']." and school_id=".$id;
        $teach=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $this->render('listbyscl', array('teach' => $teach));
    }
    
}
