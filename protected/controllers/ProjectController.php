<?php

class ProjectController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            array('application.filters.ProjectFilter',),
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('Create','update','OverProject','CompleteProject'
                                    ,'listprojectsforupdatescl','SetTeacher','CompleteRegisterProjects','listprojects','listprojectsbody','listprojectstoexcel'
                                    ,'projectUpdate','listprojectsscl','listprojectsstd','listprojectsforupdatestd'
                                    ,'listprojectsforupdatetea','listprojectstea','NotifyToCompleteProject','listprojectsnotcomplete'
                                    ,'reportmain','reportbody','AddPrize','trophydistribution','toexcel','fulldetails'
                                    ,'listprojectssclarch','projectsjudge','projectsjudgebody','projectjudgeadddelete'
                                    ,'listprojectsrate','listprojectsratebody','listprojectsratetoexcel','projectrate'
                                    ,'projectprintforjudge','projectprintforjudgeall','projectprintforjudgeallexcel','Download'
                                    ,'certification','SendCertification'
                                    ,'PrintStd','PrintTeacher','PrintSchool'
                                    
                                    ,'SendStd','SendTeacher','SendSchool'
                                    ,'result'
                                    ,'PrintPartAllSchool','PrintPartAllTeacher','PrintPartAllStudent'//,'projectotherprize'
                                    ,'AddOtherPrize'
                                    ),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
    public function actionOverProject() {
        $this->render('overProject');
    }
    
    public function actionCompleteProject($id) {
       $para=Yii::app()->session['para'];
        if($para!=null){
                 $schoolid=$para['school_id'];
         }
        $this->render('completeProject', array('schoolid' => $schoolid));
    }
    
    
	public function actionCreate($sclid) {
           // $id = Yii::app()->getRequest()->getQuery('er');
           // echo $scid;return;
        $model = new Project;
       // $det = new MbProjectDetail;
       // $n = new Functions();
        $current=  Mobarat::getOpenMobaratRecord();
        $school = School::model()->findByPk($sclid);
        $bolValidate=true;
        $manager= Person::model()->findByPk($school->school_ManagerPersonID);
        $ms= MobaratSchool::model()->find('school_id='. $sclid.' and mobarat_year='.$current['mobarat_year']);
        $ot=Person::model()->findByPk($ms->oteacher_personid);
       
        $bolValidate=$school->validateSchool(enm_SchoolType::SCHOOL) 
                && $manager->validatePerson(enm_PersonType::MANAGER)
                && $ot->validatePerson(enm_PersonType::OTEACHER);
        //echo count($school);return;
  /*
        if ($school['school_name'] != NULL  && $school['school_level'] != NULL 
                && $school['school_place'] != NULL 
                && $school['school_street'] != NULL && $school['school_phone'] != NULL) {*/
        if($bolValidate){
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);


            $sId = Project::model()->count('school_id=' . $sclid . ' AND mobarat_year=' . $current['mobarat_year']);
//var_dump("hassan ".$sId );
            if ($sId < 4) {
                //$oo = $current['mobarat_year'] - 1;
                //$trophy = Project::model()->count('school_id=' . $sclid . ' AND project_prize=1 AND mobarat_year=' . $oo);
                $total = $current['MaxNoOfProject'];
                $totalproject = Project::model()->count(' mobarat_year=' . $current['mobarat_year']);

                $sanawi = Project::model()->count("school_id=" . $sclid . " AND mobarat_year=" . $current['mobarat_year'] . " AND project_stage='02'");
                $motawaset = Project::model()->count("school_id=" . $sclid . " AND mobarat_year=" . $current['mobarat_year']. " AND project_stage='01'");
//echo $sanawi .' '.$motawaset;return;
                if ($totalproject <= $total) {
                    if (isset($_POST['Project'])) {
                       
                        $model->attributes = $_POST['Project'];
                        $ms=  MobaratSchool::model()->find('school_id=' . $sclid . ' AND mobarat_year=' . $current['mobarat_year']);
                        //if($school[0]['school_id']!=84){
                        if ($model->project_stage == '02') {
                            if (($sanawi == 2 && $ms['extraProject'] == 0 ) || $sanawi == 2 
                                    ||($sanawi == 2 && $ms['extraProject'] == 1 && $motawaset == 2))
                                $this->redirect(array('Project/overProject'));                         
                        } 
                        
                         else {
                       
                            if (($motawaset == 2 && $ms['extraProject'] == 0) || $motawaset == 2
                                    ||($motawaset == 2 && $ms['extraProject'] == 1 && $sanawi == 2)) 
                             
                               $this->redirect(array('Project/overProject'));  
                               
                        }
                       ////hon l error die();
//                $model->validate();
//                print_r($_POST['MbProject']);
//                die();


                        $model->school_id = $sclid;
                        $model->mobarat_year = $current['mobarat_year'];
                        $model->project_prize = 4;
                        $model->date_inserted=new CDbExpression('now()');
                        $model->date_lastupdate=new CDbExpression('now()');
                        if ($model->save()) {
                            //$det->pdetail_project = $model->project_id;
                            //$det->pdetail_help = 1;
                            //if ($det->save()) {
//get school name
                                //$schoolName = MbSchool::model()->findAll('school_id = ' . $n->getSchoolId());
//notification
                                $msg="تم تسجيل مشروع جديد بإسم " . $model->project_name . " لمدرسة " . " " . $school['school_name'];
                                MbNotification::sendNotificationByuserType('01', $msg);
                                 //$this->render('completeProject', array('id' => $model->project_id));
                                $para=array('project_id'=>$model->project_id,'oteacher_personid'=>$ms['oteacher_personid'],'school_id'=>$sclid);
                                Yii::app()->session['para']=$para;
                                $this->redirect(array('Project/completeProject/'.$model->project_id));
                            //}
                        }
                    }

                    $this->render('create', array(
                        'model' => $model,'school'=>$school,
                    ));
                } else {
                    $this->render('overProjectTotal');
                }
            } else {
                //$this->redirect(array('Project/overProject'));
                 $this->render('overProject');
            }
        } else {
            $this->render('missingData',array('sclid'=>$sclid));
        }
    }
    
    public function actionSetTeacher() {
        //echo $ids;
        $para=Yii::app()->session['para'];
        if($para!=null){
            $p=  Project::model()->findByPk($para['project_id']);
            $persteacher=Personteacher::model()->find('school_id='.$p->school_id.' and mobarat_year='.$p->mobarat_year.' and teacher_personid='.$para['oteacher_personid']);
            
            if($persteacher ==null){
                $persteacher=new Personteacher();
                $persteacher->mobarat_year=$p->mobarat_year;
                $persteacher->teacher_personid=$para['oteacher_personid'];
                $persteacher->school_id=$p->school_id;
                $persteacher->save();
            }
            $proteacher=  ProjectTeacher::model()->find('project_id='.$p->project_id.' and teacher_id='.$persteacher->teacher_id);
            if($proteacher ==null){
                $proteacher=new ProjectTeacher();
                $proteacher->project_id=$p->project_id;
                $proteacher->teacher_id=$persteacher->teacher_id;
                $proteacher->person_id=$para['oteacher_personid'];
                $proteacher->save();
            }
            unset(Yii::app()->session['para']);
            //$para=array('project_id'=>$p->project_id);
            //Yii::app()->session['para']=$para;
            $this->redirect(array('Project/completeRegisterProjects','prjid'=>$p->project_id,'sclid'=>$p->school_id));
            //$this->redirect(Yii::app()->user->returnUrl . "/Project/completeRegisterProjects");
           
        }
        echo "لا يوجد صلاحية!";
       
        
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

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->project_id));
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
    public function actionDelete($id)
    {
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
            $dataProvider=new CActiveDataProvider('Project');
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
            $model=new Project('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Project']))
                    $model->attributes=$_GET['Project'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Project the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
            $model=Project::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Project $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
        
    public function actionProjectUpdate($prjid) {
        
        //$para=Yii::app()->session['para'];
        //if($para!=null){
        $project=  Project::model()->findByPk($prjid);
        $school=  School::model()->findByPk($project->school_id);
        $clsPerson= Yii::app()->session['clsPerson'] ;
        $current=  Mobarat::getOpenMobaratRecord();
        $std=Personstudent::model()->find("student_personid=". $clsPerson->person_id." and mobarat_year=".$current['mobarat_year']);
        if($std!=null)
            $role=$std->student_CanModifyProject;
        else 
            $role=true;

        if (isset($_POST['Project'])) {
            $project->attributes = $_POST['Project'];
            $project->date_lastupdate=new CDbExpression('now()');
            $file = CUploadedFile::getInstanceByName('file');
            //if (isset($file) && count($file) > 0) {
            if (isset($file)) {
                $ext = substr($file->name,strrpos($file->name,".") + 1);
              if ($ext =='pdf' || $ext =='rar' || $ext=='zip'  )
                {
   
                    $path=  cls_attach::getRelatedFolder(enm_Program::PROJECT,$project->project_id);
                    //move_uploaded_file($file->tempName,$path.$file->name);
                    $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                    move_uploaded_file($file->tempName,$path.$prjid.'.'.$ext);
                    $project->project_attachment = $file->name;  
                                      
                }
            }
            if ($project->save()) {
                if ($std!=null) {
                    //$school=  School::model()->findByPk($project->school_id);
                    $student = Person::model()->findByPk($std->student_personid);
                    //$school = MbSchool::model()->findAll('school_id=' . $model->project_school);
                    $msg="تم تعديل المشروع  " . $project->project_name . " من قبل الطالب " . " " 
                            . $student->Person_fname . " " . $student->Person_lname 
                            . " من مدرسة" . " " . $school->school_name;
                    MbNotification::sendNotificationByuserType('01', $msg);
                    MbNotification::sendNotificationByProjectID($prjid, $msg);

                }
                else {
                    $msg="تم تعديل المشروع  " . $project->project_name . " من قبل مدرسة " . " " . $school->school_name;;
                    MbNotification::sendNotificationByuserType('01', $msg);
                }
                //return $this->goBack();
                //return $this->redirect(Yii::app()->request->urlReferrer);
                //Yii::app()->request->urlReferrer
                //echo Yii::app()->request->urlReferrer;
            }
        }


        //$this->render('projectUpdate', array('model' => $model, 'detail' => $detail));
        $this->render('projectUpdate', array('model' => $project,'role'=>$role,'slevel'=>$school->school_level));
        /*}
        else 
            echo "لا يوجد صلاحية!";*/
       
    }
    public function actionCompleteRegisterProjects($prjid,$sclid) {
        $this->render('completeRegisterProjects',array('project_id'=>$prjid,'sclid'=>$sclid));
    }
    
    public function actionlistprojectsforupdatescl($sclid) {
        //$n = new Functions();
        $current=  Mobarat::getOpenMobaratRecord();

        $query="select project_id,mobarat_year,school_id,project_name
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                    ,project_prize,project_description,project_goal,project_tools,project_steps,project_attachment
                from project
                where school_id=" . $sclid . " AND mobarat_year=" . $current['mobarat_year'] ;        
        //$project = Project::model()->findAll('school_id=' . $sclid . ' AND mobarat_year=' . $current['mobarat_year']);
        $project=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $this->render('listprojectsforupdate', array('project' => $project));
    }
    
    public function actionlistprojectsforupdatestd($persid) {
        //$n = new Functions();
        $current=  Mobarat::getOpenMobaratRecord();

        $query="select project.project_id,mobarat_year,school_id,project_name
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                    ,project_prize,project_description,project_goal,project_tools,project_steps,project_attachment
                from project inner join project_student on project.project_id=project_student.project_id 
                where project_student.person_id=" . $persid . " AND mobarat_year=" . $current['mobarat_year'] ;        
        //$project = Project::model()->findAll('school_id=' . $sclid . ' AND mobarat_year=' . $current['mobarat_year']);
        $project=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $this->render('listprojectsforupdate', array('project' => $project));
    }
    
     public function actionlistprojectsforupdatetea($persid) {
        //$n = new Functions();
        $current=  Mobarat::getOpenMobaratRecord();

        $query="select project.project_id,mobarat_year,school_id,project_name
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                    ,project_prize,project_description,project_goal,project_tools,project_steps,project_attachment
                from project inner join project_teacher on project.project_id=project_teacher.project_id 
                where project_teacher.person_id=" . $persid . " AND mobarat_year=" . $current['mobarat_year'] ;        
        //$project = Project::model()->findAll('school_id=' . $sclid . ' AND mobarat_year=' . $current['mobarat_year']);
        $project=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $this->render('listprojectsforupdate', array('project' => $project));
    }

    private function showListProject($filter,$showSendMessage=false,$isArchive=false){
        $query="select project.project_id,mobarat_year,school_id,project_name
                    ,(select school_name from school as sc where project.school_id=sc.school_id  ) as school_name
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                    ,project_prize,project_description,project_goal,project_tools,project_steps,project_attachment
                    ,45+(1-isnull(project_description))*11+(1-isnull(project_goal))*11+(1-isnull(project_tools))*11
                                +(1-isnull(project_steps))*11+(1-isnull(project_attachment))*11 as complete
                from project ";
        $query .=$filter;
        $project=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $this->render('listprojects', array('project' => $project,'showSendMessage'=>$showSendMessage,'isArchive'=>$isArchive));
        
    }
    
    public function actionlistprojectsscl($sclid) {
        $current=  Mobarat::getOpenMobaratRecord();
        $filter="where school_id=" . $sclid . " AND mobarat_year=" . $current['mobarat_year'] ;
        $this->showListProject($filter);
        
    }
    
    public function actionlistprojectssclarch($sclid) {
        $current=  Mobarat::getOpenMobaratRecord();
        $filter="where school_id=" . $sclid . " AND mobarat_year<" . $current['mobarat_year'] ;
        $this->showListProject($filter,FALSE,true);
        
    }
    
    public function actionlistprojectsstd($persid) {
        $current=  Mobarat::getOpenMobaratRecord();
        $filter=" inner join project_student on project.project_id=project_student.project_id 
                    where project_student.person_id=" . $persid . " AND project.mobarat_year=" . $current['mobarat_year'] ;
        $this->showListProject($filter);
        /*
        $query="select project.project_id,mobarat_year,school_id,project_name
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                    ,project_prize,project_description,project_goal,project_tools,project_steps,project_attachment
                    ,45+(1-isnull(project_description))*11+(1-isnull(project_goal))*11+(1-isnull(project_tools))*11
                                +(1-isnull(project_steps))*11+(1-isnull(project_attachment))*11 as complete
                from project inner join project_student on project.project_id=project_student.project_id 
                where project_student.person_id=" . $persid . " AND project.mobarat_year=" . $current['mobarat_year'] ;        
        //$project = Project::model()->findAll('school_id=' . $sclid . ' AND mobarat_year=' . $current['mobarat_year']);
        $project=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $this->render('listprojects', array('project' => $project));*/
    }
    
    public function actionlistprojectstea($persid) {
        $current=  Mobarat::getOpenMobaratRecord();
        $filter=" inner join project_teacher on project.project_id=project_teacher.project_id 
                where project_teacher.person_id=" . $persid . " AND project.mobarat_year=" . $current['mobarat_year'] ;        
        $this->showListProject($filter);
        /*
        $query="select project.project_id,mobarat_year,school_id,project_name
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                    ,project_prize,project_description,project_goal,project_tools,project_steps,project_attachment
                    ,45+(1-isnull(project_description))*11+(1-isnull(project_goal))*11+(1-isnull(project_tools))*11
                                +(1-isnull(project_steps))*11+(1-isnull(project_attachment))*11 as complete
                from project inner join project_teacher on project.project_id=project_teacher.project_id 
                where project_teacher.person_id=" . $persid . " AND project.mobarat_year=" . $current['mobarat_year'] ;        
        //$project = Project::model()->findAll('school_id=' . $sclid . ' AND mobarat_year=' . $current['mobarat_year']);
        $project=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $this->render('listprojects', array('project' => $project));
         
         */
    }
    
    public function actionlistprojects() {
        $title='تقرير المشاريع المسجلة';
        $bodyreport='Project/listprojectsbody';
        $bodyreportparams=array();
        $searchcontrol='/report/scproject02';
        $toexcelurl='Project/listprojectstoexcel';
        $params=array('bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams,'showcsv'=>'true','toexcelurl'=>$toexcelurl);
        $this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'params'=>$params));  
        /*
        $current=  Mobarat::getOpenMobaratRecord();
        $filter=" where project.mobarat_year=" . $current['mobarat_year'] ;        
        $this->showListProject($filter);  */
    }
    
    public function actionlistprojectsbody(){
        $current=  Mobarat::getOpenMobaratRecord();
         
        $mainQuery=" from project inner join school on school.school_id=project.school_id
                        inner join mobarat_school on mobarat_school.school_id=school.school_id and  mobarat_school.mobarat_year=project.mobarat_year
                        inner join person on mobarat_school.oteacher_personid=person.Person_id
                    where project.mobarat_year= ".$current['mobarat_year']
                  ." and school_name like '%".$_POST['school']."%' and project_name like '%".$_POST['pname']."%'";
        
       
        $countQuery="select count(project.project_id) ". $mainQuery;
        
        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        
        $query="select project.project_id,project.mobarat_year,project.school_id,project_name
                    ,  school_name
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                    ,(select code_name from codes where code_no=project_prize and code_kind=109) as project_prize
                    ,project_description,project_goal,project_tools,project_steps,project_attachment
                    ,45+(1-isnull(project_description))*11+(1-isnull(project_goal))*11+(1-isnull(project_tools))*11
                                +(1-isnull(project_steps))*11+(1-isnull(project_attachment))*11 as complete 
                    ,(select GROUP_CONCAT((select concat( Person_fname,' ', Person_lname) from person where project_student.person_id=person.person_id) ORDER BY person_id ASC SEPARATOR ', ')  from project_student where project_student.project_id=project.project_id GROUP BY project_student.project_id) as students  
		    ,(select (select concat( Person_fname,' ', Person_lname) from person where project_teacher.person_id=person.person_id) from project_teacher where project_teacher.project_id=project.project_id order by isConfirmed desc limit 1) as teacher
                    ,concat( Person_fname,' ', Person_lname)  as oteacher
                    ,person.Person_CellPhone,person.Person_email1".
                            $mainQuery;
      
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
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('Project/listprojectsbody'),'fill_table');
        $project    = $clspaginator->getData(  $limit ,$page);
        //echo $limit;      return; 
         echo $this->renderpartial('listprojectsbody',array('project'=>$project,'clspaginator'=>$clspaginator,'links'=>$links),TRUE,TRUE);        
           
    }
    public function actionlistprojectstoexcel(){  
        $current=  Mobarat::getOpenMobaratRecord();
        $query="select 45+(1-isnull(project_description))*11+(1-isnull(project_goal))*11+(1-isnull(project_tools))*11
                                +(1-isnull(project_steps))*11+(1-isnull(project_attachment))*11 as complete
                    ,project.project_id,project.school_id,project_name
                    ,  school_name
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                    ,(select code_name from codes where code_no=project_prize and code_kind=109) as project_prize
                    ,(select GROUP_CONCAT((select concat( Person_fname,' ', Person_lname) from person where project_student.person_id=person.person_id) ORDER BY person_id ASC SEPARATOR ', ')  from project_student where project_student.project_id=project.project_id GROUP BY project_student.project_id) as students  
		    ,(select (select concat( Person_fname,' ', Person_lname) from person where project_teacher.person_id=person.person_id) from project_teacher where project_teacher.project_id=project.project_id order by isConfirmed desc limit 1) as teacher
                    ,concat( Person_fname,' ', Person_lname)  as oteacher
                    ,person.Person_CellPhone,person.Person_email1
                    ,project_description,project_goal,project_tools,project_attachment
                    
                   from project inner join school on school.school_id=project.school_id
                        inner join mobarat_school on mobarat_school.school_id=school.school_id and  mobarat_school.mobarat_year=project.mobarat_year
                        inner join person on mobarat_school.oteacher_personid=person.Person_id
                    where project.mobarat_year= ".$current['mobarat_year']
                  ." and school_name like '%".$_POST['txtSchool']."%' and project_name like '%".$_POST['txtPname']."%'";
        
         
         $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
         $label=array('إكتمال البيانات','الرقم','رقم المدرسة','إسم المشروع','إسم المدرسة','الفئة','المرحلة','المسار','الميدالية','الطلاب','الاستاذ المشرف','الاستاذ المسؤول','الهاتف','البريد الالكتروني','الوصف','الهدف','الادوات','ملحقات');
         cls_toCSV::exportToCSV('project.csv',$label,$rs);
    }
    
    public function actionfulldetails($prjid){
        //echo '$id';return;
        $query="select project_id,school_id,project_name,mobarat_year
                ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                ,project_description,project_goal,project_tools,project_steps,project_attachment
               from project 
                where project_id= ".$prjid;
        $project=Yii::app()->getDB()->createCommand($query)->queryall(true);
        //echo count($project).";";
        
        $query="select school.school_id,school_name,school_ename,school_street,school_email,school_phone,school_ManagerPersonID
                    ,(select code_name from codes where code_kind=107 and code_no= school_type) as school_type
                    ,(select code_name from codes where code_kind=106 and code_no= school_level) as school_level
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,2)) as moha
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,4) and length(code_no)=4) as kada
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,6) and length(code_no)=6) as city
                    from school where school_id=".$project[0]['school_id'];
        $school=Yii::app()->getDB()->createCommand($query)->queryall(true);
        // echo count($school).";";
        $query="select Person_fname, Person_mname, Person_lname,Person_CellPhone ,Person_email1
                    from person where person_id=".$school[0]['school_ManagerPersonID'];
        $manager=Yii::app()->getDB()->createCommand($query)->queryall(true);
        // echo count($manager).";";
        $query="select Person_fname, Person_mname, Person_lname,Person_CellPhone ,Person_email1
                from person inner join person_oteacher on person_oteacher.oteacher_personid=person_id
                inner join mobarat_school on mobarat_school.oteacher_id=person_oteacher.oteacher_id
                 where school_id=".$project[0]['school_id']." and mobarat_school.mobarat_year=".$project[0]['mobarat_year'];
        $oteacher=Yii::app()->getDB()->createCommand($query)->queryall(true);
        // echo count($oteacher).";";
        $query="select Person_fname, Person_mname, Person_lname,Person_CellPhone ,Person_email1
                from person inner join project_teacher on project_teacher.person_id=person.person_id
                 where project_id=".$prjid;
        $teacher=Yii::app()->getDB()->createCommand($query)->queryall(true);
        // echo count($teacher).";";
        $query="select Person_fname, Person_mname, Person_lname,Person_CellPhone ,Person_email1
                from person inner join project_student on project_student.person_id=person.person_id
                 where project_id= ".$prjid;
        $stds=Yii::app()->getDB()->createCommand($query)->queryall(true);
        //echo count($stds).";";
        $this->renderpartial('fulldetails',array('project'=>$project,'school'=>$school,'manager'=>$manager,'teacher'=>$teacher,'stds'=>$stds)); 
    }
    public function actionlistprojectsnotcomplete() {
        $current=  Mobarat::getOpenMobaratRecord();
        $filter=" where project.mobarat_year=" . $current['mobarat_year'] 
                ." and (project_path IS NULL OR project_description IS NULL OR project_goal IS NULL OR project_tools IS NULL OR project_steps IS NULL OR project_attachment IS NULL)";        
        $this->showListProject($filter,true);  
    }
    
    public function actionNotifyToCompleteProject() {
        $project_id = $_GET['project_id'];
        $school_id = $_GET['school_id'];
        $current= Mobarat::getOpenMobaratRecord();
        $ms= MobaratSchool::model()->find("school_id=".$school_id." and mobarat_year=".$current['mobarat_year']);
        if($ms!=null){
           $pers= Person::model()->findByPk( $ms['oteacher_personid']);
           $prj= Project::model()->findByPk($project_id);
           $msg="الرجاء إكمال بيانات مشروع " .$prj['project_name'];
           MbNotification::sendNotificationToUser($pers['Person_userID'], $msg);
           echo $pers['Person_fname'].' '.$pers['Person_lname'];
           return;
        }
       // echo $school_id;//$ms['oteacher_personid'];
        echo "Error";
    }
    
    public function actionreportmain()
    {
        $this->layout = '//layouts/column2';
        //$this->render('reportmain'); 
        $title='تقرير المشاريع المشاركة سابقاً';
        $bodyreport='Project/reportbody';
        $bodyreportparams=array('showtropphy'=>'false');
        //$this->render('/report/reportmain',array('title'=>$title,'bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams)); 
        $searchcontrol='/report/scproject01';
         $toexcelurl='Project/toexcel';
        $params=array('bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams,'showcsv'=>'true','toexcelurl'=>$toexcelurl);
        $this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'params'=>$params)); 
        //$this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams));  
    }
    
    public function actiontrophydistribution(){
        $this->layout = '//layouts/column2';
        //$this->render('reportmain'); 
        $title='توزيع الميداليات';
        $bodyreport='Project/reportbody';
        $bodyreportparams=array('showtropphy'=>'true');
        $searchcontrol='/report/scproject01';
        $toexcelurl='Project/toexcel';
        $params=array('bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams,'showcsv'=>'true','toexcelurl'=>$toexcelurl);
        $this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'params'=>$params)); 
        //$this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams));  
        //$this->render('/report/reportmain',array('title'=>$title,'bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams));  
    }
    
    public function actionreportbody(){
        //echo" kkl;kl;";return;
        //echo $_POST['showall'];return;
        $prj_name=str_replace("'","''",$_POST['pname']);
        $mainQuery=" from project inner join school on school.school_id=project.school_id
                    where  project_name like '%".$prj_name."%'
                    and school_name like '%".$_POST['school']."%'";
       
        if(is_numeric($_POST['myear']))
            $mainQuery.=" and mobarat_year=".$_POST['myear'];
        
        $countQuery="select count(project_id) ". $mainQuery;
        
        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        //echo $countQuery;return;
        $query="select project_id,mobarat_year,school.school_id,project_name,project_prize
                    , concat(ifnull( (select code_name from codes where code_kind =109 and code_no=project_prize),'')  ,'<br/>',
ifnull((select  (select code_name from codes where code_kind =121 and code_no=pop_code_no) as prizeName from project_other_prize where pop_taked=1 and pop_project_id=project_id),'')) as prizeName
                    , school_name
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                    ,project_prize,project_description,project_goal,project_tools,project_steps,project_attachment
                    " . $mainQuery;
        //echo $_POST['showall'];return;
        if($_POST['showall']=='true')
           $limit='all';// ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        else
            $limit=15;
       //echo $_POST['showall'];
       //echo $limit;return;
        //$query.=" order by project_type,project_stage";
        $page       = ( isset( $_POST['page'] ) ) ? $_POST['page'] : 1;
        $links      =5;// ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;
        //echo $_POST['showtropphy'] ;return;
        $para=array('page'=>$page,'showtropphy'=>$_POST['showtropphy'],'showall'=>$_POST['showall'],'pname'=>$_POST['pname']
                    ,'school'=>$_POST['school'],'myear'=>$_POST['myear']);
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('Project/reportbody'),'fill_table');
       // echo $query;return;
        $prjs    = $clspaginator->getData(  $limit ,$page);
       // echo $query;return;
        //echo count($scls->data);return;
        //echo  $page.":".$limit.":".count($stds->data);;return;
        
         if(isset($_POST['page'])){
           // echo  $page.":".$limit.":".count($stds->data);;//return;
            //return;
            
        }
        $prizes= Mobarat::getCodeEnable(121);
        $query1='SELECT pop_id, pop_project_id, pop_codeid, pop_code_no, pop_taked FROM project_other_prize'
               . ' where pop_project_id in ( select project_id '. $mainQuery .')';
        $pr_przs=Yii::app()->getDB()->createCommand($query1)->queryAll(true);
        echo $this->renderpartial('reportbody',array('prjs'=>$prjs,'prizes'=>$prizes,'pr_przs'=>$pr_przs,'showtropphy'=>$_POST['showtropphy'],'clspaginator'=>$clspaginator,'links'=>$links),FALSE,TRUE);
           
    }
    
    public function actiontoexcel(){  
        $current=  Mobarat::getOpenMobaratRecord();
        $query="select project_id,mobarat_year,school.school_id, school_name,project_name
                    ,(select code_name from codes where code_kind =109 and code_no=project_prize) as prizeName
                    
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select code_name from codes where code_no=project_path and code_kind=110) as project_path
                    ,project_description,project_goal,project_tools,project_steps,project_attachment 
                    
                   from project inner join school on school.school_id=project.school_id
                    where  project_name like '%".$_POST['txtPname']."%'
                    and school_name like '%".$_POST['txtSchool']."%'";
        
         if(is_numeric($_POST['txtYear']))
            $query.=" and mobarat_year=".$_POST['txtYear']; 
         $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
         $label=array('الرقم','السنة','رقم المدرسة','إسم المدرسة','إسم المشروع','الجائزة','الفئة','المرحلة','المسار','الوصف','الهدف','الادوات','الخطوات','المرفقات');
         cls_toCSV::exportToCSV('project.csv',$label,$rs);
    }
    public function actionAddPrize($id, $f) { //id pf project
        Project::model()->updateAll(array('project_prize' => $f), 'project_id = ' . $id);
        echo $this->getPrizeDetail($id);
//        if($f=='01')
//            echo 'ذهبية';
//        else if($f=='02')
//            echo 'فضية';
//        else if($f=='03')
//            echo 'برونزية';
//        else if($f=='04')
//            echo 'لا يوجد';
        
    }
    
    public function actionAddOtherPrize($id, $f) { //id pf project
        if($f==-1){
            $sql = "update project_other_prize set project_other_prize.pop_code_no='".$f."', project_other_prize.pop_taked=0 where pop_project_id=".$id;
        }else{
            $sql = "insert into project_other_prize(pop_project_id,pop_code_no,pop_taked)
                select ".$id.",'" .$f."',1 on duplicate key  "
                . "update project_other_prize.pop_code_no='".$f."', project_other_prize.pop_taked=1";
        }
       
        $query = Yii::app()->db->createCommand($sql);
        $query->execute();
       
       echo $this->getPrizeDetail($id);
        
    }
    
    private function getPrizeDetail($id){
        $label='';
        $query='select project_prize, (select code_name from codes where code_kind =109 and code_no=project_prize) as prizeName from project where project_id='.$id;
        $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        if($rs[0]['project_prize']=='01' || $rs[0]['project_prize']=='02' || $rs[0]['project_prize']=='03')
            $label=$rs[0]['prizeName'];
        
        $query='select pop_code_no, (select code_name from codes where code_kind =121 and code_no=pop_code_no) as prizeName from project_other_prize where pop_taked=1 and pop_project_id='.$id;
        $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        if(count($rs)>0){
            if(strlen($label)>0){
                $label.='<br/>';
            }
            $label.=$rs[0]['prizeName'];
        }
        return $label;
        
    }


    public function actionprojectsjudge($id) {
        //$title='تحديد المشاريع للحكم';
        $bodyreport='Project/projectsjudgebody';
        $bodyreportparams=array('judge_id'=>$id);
        //$searchcontrol='/report/scproject02';
        //$toexcelurl='Project/listprojectstoexcel';
        //$params=array('bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams,'showcsv'=>'false','toexcelurl'=>$toexcelurl);
        //$this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'params'=>$params));  
                $this->render('projectsjudge',array('bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams));  

        /*
        $current=  Mobarat::getOpenMobaratRecord();
        $filter=" where project.mobarat_year=" . $current['mobarat_year'] ;        
        $this->showListProject($filter);  */
    }
    
    public function actionprojectsjudgebody(){
        //echo "asdadsasdas";return;
        $current=  Mobarat::getOpenMobaratRecord();
        
        $where=" where project.mobarat_year=" .$current['mobarat_year']
                ." and mobarat_school.is_present=1 and school_name like '%".$_POST['school']."%' and project_name like '%".$_POST['pname']."%'"
               // ." and ((select judge_stage from person_judge where judge_id=".$_POST['judge_id'].")='03' or  project_stage =(select judge_stage from person_judge where judge_id=".$_POST['judge_id']."))"
                ." and not project.project_id in (select project_judge.project_id from project_judge 
                                            where project_judge.judge_id=".$_POST['judge_id']." and project_judge.project_id=project.project_id and rated=1) ";
        if($current['enablejudgeday']==1){
            $where.=" and date_day='" .$current['enablejudgedaycode_no']."'";
        }
        if($_POST['showRegister']=='true'){
            $where .= " and project.project_id in (select project_id from project_judge where project_judge.judge_id=".$_POST['judge_id'].") ";
        }
        $from=" from project  inner join school on school.school_id=project.school_id "
                . " inner join mobarat_school on mobarat_school.school_id=project.school_id and mobarat_school.mobarat_year=project.mobarat_year and presence_assurance=1 ";
        
        $countQuery="select count(project.project_id) ".$from. $where;
        
        $from .=" left join project_judge on project_judge.project_id=project.project_id and (rated=1 or judgeislogin=1)";
        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        
        $query="select project.project_id,school.school_id,school_name,project_name
                ,(select code_name from codes where code_kind=111 and code_no=project_type) as project_type
                ,(select code_name from codes where code_kind=106 and code_no=project_stage) as project_stage
                ,(select code_name from codes where code_kind=120 and code_no=halls) as halls ,suite
                ,count(project_judge.project_id) as judcount
                ,(select count(project_judge.project_id) from project_judge 
                   where project_judge.judge_id=".$_POST['judge_id']." and project_judge.project_id=project.project_id) as checked ".
                           $from. $where
                .'group by  project.project_id,school.school_id,school_name,project_name,project_type,project_stage'
                //.' order by project.project_id';
                 .' order by date_day,project_type,judcount asc';
     // echo $query;return;
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
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('Project/projectsjudgebody'),'fill_table');
        $project    = $clspaginator->getData(  $limit ,$page);
        //echo $limit;      return; 
         echo $this->renderpartial('/project/projectsjudgebody',array('project'=>$project,'clspaginator'=>$clspaginator,'links'=>$links,'judge_id'=>$_POST['judge_id']),FALSE,TRUE);        
         //echo $this->renderpartial('/Admin/reportpersonmaincheck',array('pers'=>$pers,'clspaginator'=>$clspaginator,'links'=>$links),FALSE,TRUE);  
    }
    
    public function actionprojectjudgeadddelete($project_id,$judge_id,$checked) {
        $current=  Mobarat::getOpenMobaratRecord();
        $execute=0;
        
        //return "كلا";
        if($checked==0){
            $pj= Personjudge::model()->findByPk($judge_id);
            if($pj['mobarat_year']==$current['mobarat_year']){
                $sql="insert into project_judge(project_id,judge_id,judge_personId,mobarat_year,rated,date_inserted)
                        values(".$project_id.",".$judge_id.",".$pj['judge_personid'].",".$current['mobarat_year'].",0,now()) on duplicate key update rated=rated ";
                 $execute=1;
            }
        }
        else {
            $sql="delete from project_judge_grade where project_judge_id in (select project_judge_id from project_judge where project_id=".$project_id." and judge_id=".$judge_id." and mobarat_year=".$current['mobarat_year'].");
                    delete from project_judge where project_id=".$project_id." and judge_id=".$judge_id." and mobarat_year=".$current['mobarat_year'].";";
                    $execute=1;
        }
        
        if($execute==1){
            /*$sql.='; update project
                    set total_judge=(select count(project_judge_id) 
                                            from project_judge inner join judge_type on judge_type.judge_id= project_judge.judge_id 
                                where project_judge.project_id=project.project_id and type_enable=1 and type_kernel=0 )
                     ,total_judgekernel=(select count(project_judge_id) 
                                            from project_judge inner join judge_type on judge_type.judge_id= project_judge.judge_id 
                                where project_judge.project_id=project.project_id and  type_kernel=1 )
                    where project.project_id='.$project_id;*/
            $query = Yii::app()->db->createCommand($sql);
            $success=$query->execute();
            
            // تحديث النتيجة النهائية عند إضافة أو حذف حاكم
            Project::model()->calculateGrade($project_id);
           
            if(($checked==0))
            {
                echo "تمت إضافته";
            }
            else {
                 echo "تم حذفه";
            }
        }
        
       // echo "asdasd";return;
        //echo $sql.' '.$judetype_id.' '.$c;
       
    }
    

        
    public function actionlistprojectsrate() {
        $title='تقرير المشاريع';
        $bodyreport='Project/listprojectsratebody';
        $bodyreportparams=array();
        $searchcontrol='/report/scproject03';
        $toexcelurl='Project/listprojectsratetoexcel';
        //$toexcelurl='Project/result';
        //Result
        $params=array('bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams,'showcsv'=>'true','toexcelurl'=>$toexcelurl);
        $this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'params'=>$params));  
        /*
        $current=  Mobarat::getOpenMobaratRecord();
        $filter=" where project.mobarat_year=" . $current['mobarat_year'] ;        
        $this->showListProject($filter);  */
    }
    
    public function actionlistprojectsratebody(){
        $current=  Mobarat::getOpenMobaratRecord();
         
        $mainQuery=" from project inner join school on school.school_id=project.school_id
                        inner join mobarat_school on mobarat_school.mobarat_year=project.mobarat_year and mobarat_school.school_id=project.school_id
                        left join codes as cdsPrjTyp on cdsPrjTyp.code_no=project_type  and cdsPrjTyp.code_kind=111
                        left join codes as cdsPrjStg on cdsPrjStg.code_no=project_stage  and cdsPrjStg.code_kind=106
                        left join (select project_judge.project_id ,sum((case when judge_type.type_kernel=0 then 1 else 0 end)) as register_judge 
                                                                        ,sum((case when judge_type.type_kernel=1 then 1 else 0 end)) as register_judgeKernel 
                                                                from project_judge inner join project on project.project_id=project_judge.project_id
                                            inner join judge_type on judge_type.judge_id=project_judge.judge_id 
                                                                        and  judge_type.project_type=project.project_type  
                                                group by project_judge.project_id) as judReg on judReg.project_id=project.project_id
                        where  mobarat_school.presence_assurance=1 and project.mobarat_year= ".$current['mobarat_year']
                  ."    and school_name like '%".$_POST['school']."%' and project_name like '%".$_POST['pname']."%'"
                   ."   and project_type like '%".$_POST['prType']."%'"
                     ."   and project_stage like '%".$_POST['stage']."%'"
                
                ;
        
        if($_POST['suite']>0)
            $mainQuery .=' and suite= '. $_POST['suite'].' ';
        if($_POST['Register_JudgeKernel']=='true')
            $mainQuery .=' and register_judgeKernel=0 ';
        if($_POST['Register_Judge']=='true')
            $mainQuery .=' and register_judge=0 ';
        if($_POST['JudgeKernel']=='true')
            $mainQuery .=' and total_judgekernel=0 ';
        if($_POST['Judge']=='true')
            $mainQuery .=' and total_judge=0 ';
        if($_POST['projectThisDay']=='true')
            if($current['enablejudgeday']==true)
                $mainQuery .=' and date_day= '. $current['enablejudgedaycode_no'].' ';
            else {
                $mainQuery .=' and date_day= -1';
            }
        
     
        $countQuery="select count(project.project_id) ". $mainQuery;
        
        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        
        $query="select project.project_id,project.mobarat_year,project.school_id,project_name
                    ,  school_name,suite
                    ,project_stage,cdsPrjStg.code_name as project_stage_name
                    ,project_type,cdsPrjTyp.code_name as project_type_name
                    ,total_judge,total_judgekernel,total_grade,total_grade_coef 
                    ,ifnull(register_judge,0) as register_judge,ifnull(register_judgeKernel,0)as register_judgeKernel ".
                            $mainQuery . "  order by project_type,project_stage,total_judge + total_judgekernel";
        //echo $query;return;
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
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('Project/listprojectsratebody'),'fill_table');
        $project    = $clspaginator->getData(  $limit ,$page);
        //echo $limit;      return; 
         echo $this->renderpartial('listprojectsratebody',array('project'=>$project,'clspaginator'=>$clspaginator,'links'=>$links),TRUE,TRUE);        
           
    }
    public function actionlistprojectsratetoexcel(){
       // Project::calculateGradeAll();
        $current=  Mobarat::getOpenMobaratRecord();
       // echo $_POST['chProjectThisDay'];return;
        $query="select project.project_id,project.school_id,project_name
                    ,  school_name,suite
                    ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                    ,(select group_concat( concat(ifnull(Person_fname,''),' ',ifnull(Person_mname,''),' ',ifnull(Person_lname,'')) SEPARATOR '-') from person as p inner join person_teacher as pt on p.person_id=pt.teacher_personid inner join project_teacher pts on pts.teacher_id=pt.Teacher_id where pts.project_id=project.project_id) as teacher
                    ,(select group_concat( concat(ifnull(Person_fname,''),' ',ifnull(Person_mname,''),' ',ifnull(Person_lname,'')) SEPARATOR '-') from person as p inner join person_student as ps on p.person_id=ps.student_personid inner join project_student pps on pps.student_id=ps.Student_id where pps.project_id=project.project_id)as students
                    ,total_judge,total_judgekernel,total_grade,total_grade_coef ".
                            " from project inner join school on school.school_id=project.school_id
                        inner join mobarat_school on mobarat_school.mobarat_year=project.mobarat_year and mobarat_school.school_id=project.school_id
                        where  mobarat_school.presence_assurance=1 and project.mobarat_year= ".$current['mobarat_year']
                  ."    and school_name like '%".$_POST['txtSchool']."%' and project_name like '%".$_POST['txtPname']."%' ";
        if(isset($_POST['chProjectThisDay'])) 
        if($_POST['chProjectThisDay']==1)
            if($current['enablejudgeday']==true)
                $query .=' and date_day= '. $current['enablejudgedaycode_no'].' ';
            else {
                $query .=' and date_day= -1';
            }
      
        $query.= "  order by project_type,total_judge + total_judgekernel";
        
         
         $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
         $label=array('رقم المشروع','رقم المدرسة','إسم المشروع','إسم المدرسة','الجناح','الفئة','المرحلة','الاستاذ المشرف','الطلاب','عدد الحكام','عدد الحكام النواة','المعدل النهائي','المعدل النهائي المثقل');
         cls_toCSV::exportToCSV('projectrate.xls',$label,$rs);
    }
    public function actionresult(){
        $current=  Mobarat::getOpenMobaratRecord();
        $query="select project.project_id,project.school_id,project_name,school_name
                    ,project_prize,(select code_name from codes where code_no=project_prize  and code_kind=109) as project_prize_name
                    ,project_type,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type_name
                    ,project_stage,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage_name
                    ,(select group_concat( concat(ifnull(Person_fname,''),' ',ifnull(Person_mname,''),' ',ifnull(Person_lname,'')) SEPARATOR '-') from person as p inner join person_teacher as pt on p.person_id=pt.teacher_personid inner join project_teacher pts on pts.teacher_id=pt.Teacher_id where pts.project_id=project.project_id) as teacher
                    ,(select group_concat( concat(ifnull(Person_fname,''),' ',ifnull(Person_mname,''),' ',ifnull(Person_lname,'')) SEPARATOR '-') from person as p inner join person_student as ps on p.person_id=ps.student_personid inner join project_student pps on pps.student_id=ps.Student_id where pps.project_id=project.project_id)as students
                from project inner join school on school.school_id=project.school_id
                    inner join mobarat_school on mobarat_school.mobarat_year=project.mobarat_year and mobarat_school.school_id=project.school_id
                where  project.mobarat_year=".$current['mobarat_year']."
                        and project_prize in ('01','02','03') 
                order by project_prize desc";

        $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        if(count($rs)>0){
           $label=array('الفئة','المرحلة','المشروع','الطلاب','الاستاذة','المدرسة','المرتبة');
            $col=array('project_type_name','project_stage_name','project_name','students','teacher','school_name','project_prize_name');

            $query="select codes.code_no,codes.code_name 
                    from mobarat_code 
                        inner join codes on codes.code_kind=mobarat_code.code_kind and codes.code_no=mobarat_code.code_no and mobarat_year=".$current['mobarat_year']."
                    where mobarat_code.code_kind=111 and mobarat_code.code_enable=1";
            $prType=Yii::app()->getDB()->createCommand($query)->queryAll(true);

            $query="select code_no,code_name from codes 
                    where code_kind=106 and code_no in('01','02');";
            $prStage=Yii::app()->getDB()->createCommand($query)->queryAll(true);

            cls_toCSV::exportResultToCSV('result.xls',$current['mobarat_year'],$label,$col,$rs,$prType,$prStage); 
        }else{
            echo 'Please distribute medals first!';
        }
        
    }
    public function actionprojectrate($id) {
        $sql="select project_name,total_grade,total_grade_coef,total_judge,total_judgekernel from project where project_id= ".$id;
        $query = Yii::app()->db->createCommand($sql);
        $prjs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        
        
        $sql="select group_concat(distinct concat(
                'ifnull(sum(case when grade_type=''',grade_type,''' then grade_value  end),0) as ''',code_name,'''')
                ) as fn from project_judge_grade inner join codes on code_kind=119 and code_no=grade_type ;";
        $query = Yii::app()->db->createCommand($sql);
        $qrs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        //echo $qrs[0]['fn'];
        if(strlen(trim( $qrs[0]['fn']))==0)
            $strTemp='';
        else
            $strTemp=','.$qrs[0]['fn'];
        $sql="select project_judge.judge_id as 'رقم الحكم',concat(Person_fname,' ',Person_lname) as 'الحكم',grade as 'المعدل' ".$strTemp." from project_judge inner join project_judge_grade on project_judge.project_judge_id=project_judge_grade.project_judge_id
                inner join person on person.Person_id=project_judge.judge_personId
                where rated=1 and project_judge.project_id=".$id."
                group by project_judge.judge_id,grade";
        
        $query = Yii::app()->db->createCommand($sql);
        $qrs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        
        $sql="select project_judge.judge_id ,concat(Person_fname,' ',Person_lname) as judge_name 
                from project_judge inner join person on person.Person_id=project_judge.judge_personId
                where rated=0 and project_judge.project_id=".$id;
        $query = Yii::app()->db->createCommand($sql);
        $judgesNotRated=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        
         $this->render('projectrate', array('judges' => $qrs,'judgesNotRated'=>$judgesNotRated,'prj'=>$prjs[0]));
        
    }
    
     public function actionprojectprintforjudge($id) {
        return $this->printjudgeproject($id);
        
    }
    
    private function printjudgeproject($strids){
        $current=  Mobarat::getOpenMobaratRecord();
        $sql="select project.project_id,school.school_id,school_name,project_name,project_description
                ,(select code_name from codes where code_kind=111 and code_no=project_type) as project_type
                ,(select code_name from codes where code_kind=106 and code_no=project_stage) as project_stage
                ,(select code_name from codes where code_kind=120 and code_no=halls) as halls ,suite
                from project inner join school on school.school_id=project.school_id 
                 inner join mobarat_school on mobarat_school.school_id=project.school_id and mobarat_school.mobarat_year=project.mobarat_year and presence_assurance=1
                where project_id in (".$strids . ")";
        $query = Yii::app()->db->createCommand($sql);
        $prjs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        
        $sql='select code_name
                from codes inner join mobarat_code on codes.code_no=mobarat_code.code_no and codes.code_kind=mobarat_code.code_kind
                where mobarat_code.code_kind=119 and mobarat_code.code_Enable=1 and mobarat_year='.$current['mobarat_year'];
        $query = Yii::app()->db->createCommand($sql);
        $grades=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        

         $this->render('projectprintforjudge', array('prjs'=>$prjs,'grades'=>$grades));
    }
    
    public function actionprojectprintforjudgeall($id){
        $current=  Mobarat::getOpenMobaratRecord();
       # $sql="select project_id from project_judge where judge_id=".$id;
        $sql="select project_judge.project_id from project_judge inner join project on project.project_id=project_judge.project_id inner join  mobarat_school on project.school_id=mobarat_school.school_id  and mobarat_school.mobarat_year=project_judge.mobarat_year #where   # where judge_id=
                where project_judge.mobarat_year=".$current['mobarat_year']." and judge_id=".$id;
         if($current['enablejudgeday']==1){
            $sql.=" and date_day='" .$current['enablejudgedaycode_no']."'";
        }
        $query = Yii::app()->db->createCommand($sql);
        $prjs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        if(count($prjs)>0){
             $strids='-100';
            foreach($prjs as $pr){
                $strids.=','.$pr['project_id'];
            }
             return $this->printjudgeproject($strids);
        }
       
    }
    
    public function actionprojectprintforjudgeallexcel($id){
        $current=  Mobarat::getOpenMobaratRecord();
       
        
        $sql="select project_judge.project_id from project_judge inner join project on project.project_id=project_judge.project_id inner join  mobarat_school on project.school_id=mobarat_school.school_id  and mobarat_school.mobarat_year=project_judge.mobarat_year 
                where project_judge.mobarat_year=".$current['mobarat_year']." and judge_id=".$id;
        if($current['enablejudgeday']==1){
            $sql.=" and date_day='" .$current['enablejudgedaycode_no']."'";
        }
        $query = Yii::app()->db->createCommand($sql);
        $prjs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        if(count($prjs)>0){
             $strids='-100';
            foreach($prjs as $pr){
                $strids.=','.$pr['project_id'];
            }
            $sql="select project_name
                ,(select code_name from codes where code_kind=111 and code_no=project_type) as project_type
                ,(select code_name from codes where code_kind=106 and code_no=project_stage) as project_stage
                ,(select code_name from codes where code_kind=120 and code_no=halls) as halls ,suite
                from project inner join school on school.school_id=project.school_id 
                 inner join mobarat_school on mobarat_school.school_id=project.school_id and mobarat_school.mobarat_year=project.mobarat_year and presence_assurance=1
                where project_id in (".$strids . ")";
            $query = Yii::app()->db->createCommand($sql);
            $prjs=$query->queryAll(TRUE);
            while($query->pdoStatement->nextRowSet());
            $label=array('المشروع','الفئة','المرحلة','القاعة','الجناح','المنهجية العلمية','المحتوى العلمي ودقته','العرض الشفهي','البوستر والعرض','الابتكار والابداع والهدف');
            $sql='select code_name
                    from codes inner join mobarat_code on codes.code_no=mobarat_code.code_no and codes.code_kind=mobarat_code.code_kind
                    where mobarat_code.code_kind=119 and mobarat_code.code_Enable=1 and mobarat_year='.$current['mobarat_year'];
            $query = Yii::app()->db->createCommand($sql);
            $grades=$query->queryAll(TRUE);
            while($query->pdoStatement->nextRowSet());
            
            $sql="select code_name as salutation,Person_fname ,Person_lname
                from person inner join person_judge on person_judge.judge_personid=person_id and mobarat_year=".$current['mobarat_year']."
                left join codes on code_kind=102 and code_no=Person_Salutation
                where judge_id=".$id;
            $query = Yii::app()->db->createCommand($sql);
            $jud=$query->queryAll(TRUE);
            while($query->pdoStatement->nextRowSet());
            
            cls_toCSV::exportJudgeProjectToCSV('judge.xls',$jud,$label,$prjs,$grades);
            
        }
       
    }
    
    private function getArabicFile($dir){
        $scan_dir=scandir($dir);
        $temp='';
        //print_r($scan_dir);
        foreach($scan_dir as $key=>$value){
            if(!in_array($value,array('.','..'))){
                $temp=$dir.'\\'.$value;
                //echo $temp;
                if(is_dir($temp)){
                    //echo '<br>'.$temp;
                    $this->getArabicFile($temp);
                }else if(file_exists($temp)){
                     echo '<br>'.$temp;
                }else{
                   
                }
            }
        }
    }
    public function actionDownload($prjid){
//        $path=Yii::getPathOfAlias('webroot').cls_attach::MY_PATH_SEPARATOR."Data\\Project";
//        echo '\n'.$path;
//        if(is_dir($path)){
//            echo '\nBegin';
//            $this->getArabicFile($path);
//            echo '\nEnd';
//        }
//        exit;
        
        
        $p= Project::model()->findByPK($prjid);
        if($p!=null){
            //$path='D:\Apache24\htdocs\ssciencelb\protected\components\TCPDF\examples\images\logo-login.png';
            $temp=cls_attach::getAbsoluteFolderPath(enm_Program::PROJECT, $prjid);
            $path=  $temp.$p['project_attachment'];
            $bol=false;
            if(file_exists($path)){
                $bol=true;
            }else{
                $ext=pathinfo($p['project_attachment'],PATHINFO_EXTENSION);
                $path=  $temp.$p['project_id'].'.'.$ext;
                if(file_exists($path)){
                    $bol=true;
                }
            }
                
            if($bol==true){
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                //header('Content-Disposition: attachment;filename="'.$p['project_attachment'].'"');
                header('Content-Disposition: iniline;filename="'.$p['project_attachment'].'"');
//header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
//header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
                header ('Expires: 0'); // Date in the past
                //header ('inline: true');
                header ('content-length: '.filesize($path)); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0
                readfile($path);
                exit;
                //return response()->sendFile($path);
                // return Yii::app()->response()->sendFile($path);
            } 
            else 
                {
            echo '<script>alert("File Not Found")</script>';    
            }
        }
        
        
    }
    
    //toDelete
    public function actioncertification($prjid){
        //echo '$id';return;
        $query="select project_id,school_id,project_name,mobarat_year,project_prize
                ,(select code_name from codes where code_no=project_type  and code_kind=111) as project_type
                ,(select code_name from codes where code_no=project_stage  and code_kind=106) as project_stage
                ,cert_participate_send_count,cert_participate_send_lstdate
                ,cert_participate_print_count,cert_participate_print_lstdate,cert_trophy_send_count
                ,cert_trophy_send_lstdate,cert_trophy_print_count,cert_trophy_print_lstdate
               from project 
                where project_id= ".$prjid;
        $project=Yii::app()->getDB()->createCommand($query)->queryall(true);
        //echo count($project).";";
        
        $query="select school.school_id,school_name
                    from school where school_id=".$project[0]['school_id'];
        $school=Yii::app()->getDB()->createCommand($query)->queryall(true);
        // echo count($school).";";
//        $query="select Person_fname, Person_mname, Person_lname,Person_CellPhone ,Person_email1
//                    from person where person_id=".$school[0]['school_ManagerPersonID'];
//        $manager=Yii::app()->getDB()->createCommand($query)->queryall(true);
        // echo count($manager).";";
//        $query="select Person_fname, Person_mname, Person_lname,Person_CellPhone ,Person_email1
//                from person inner join person_oteacher on person_oteacher.oteacher_personid=person_id
//                inner join mobarat_school on mobarat_school.oteacher_id=person_oteacher.oteacher_id
//                 where school_id=".$project[0]['school_id']." and mobarat_school.mobarat_year=".$project[0]['mobarat_year'];
//        $oteacher=Yii::app()->getDB()->createCommand($query)->queryall(true);
        // echo count($oteacher).";";
        $query="select project_teacher_id,Person_fname, Person_mname, Person_lname,Person_CellPhone ,Person_email1
                ,cert_participate_send_count,cert_participate_send_lstdate
                ,cert_participate_print_count,cert_participate_print_lstdate,cert_trophy_send_count
                ,cert_trophy_send_lstdate,cert_trophy_print_count,cert_trophy_print_lstdate
                from person inner join project_teacher on project_teacher.person_id=person.person_id
                 where project_id=".$prjid;
        $teacher=Yii::app()->getDB()->createCommand($query)->queryall(true);
        // echo count($teacher).";";
        $query="select project_student_id,Person_fname, Person_mname, Person_lname,Person_CellPhone ,Person_email1
                 ,cert_participate_send_count,cert_participate_send_lstdate
                ,cert_participate_print_count,cert_participate_print_lstdate,cert_trophy_send_count
                ,cert_trophy_send_lstdate,cert_trophy_print_count,cert_trophy_print_lstdate
                from person inner join project_student on project_student.person_id=person.person_id
                 where project_id= ".$prjid;
        $stds=Yii::app()->getDB()->createCommand($query)->queryall(true);
        //echo count($stds).";";
        $this->render('certification',array('project'=>$project,'school'=>$school,'teacher'=>$teacher,'stds'=>$stds)); 
    }
    
    //toDelete
    public function actionSendCertification($id){
        //echo $id;
//        for($i=0;$i<10;$i++){
//        $email = "assaffsamer@gmail.com";
//
//
//        $msg_st="تجربة المرفقات";
//
//        $clsEmail=new cls_EMail();
//        $clsEmailAddress=new cls_EMailAddress($email, "samer assaf");
//        
//        
//        require_once('TCPDF/tcpdf.php');
//        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//
//        // set document information
//        $pdf->SetCreator(PDF_CREATOR);
//        $pdf->SetAuthor('Samer Assaf');
//        $pdf->SetTitle('Judge');
//
//        $pdf->setImageScale(1.25);
//
//
//
//        $lg = Array();
//        $lg['a_meta_charset'] = 'UTF-8';
//        $lg['a_meta_dir'] = 'rtl';
//        $lg['a_meta_language'] = 'ar';
//        $lg['w_page'] = 'page';
//
//
//        $pdf->setLanguageArray($lg);
//
//
//        $pdf->SetFont('dejavusans', '', 12);
//
//        $pdf->AddPage();
//        $pdf->setJPEGQuality(75);
//
//        $pdf->Image(Yii::app()->theme->baseUrl.'/assets/img/logo-login.jpg', 200, 5, 25, 20, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
//        $pdf->SetXY(40,5);
//        $pdf->Cell(75, 5, 'بطاقة تحكيم مشروع', 0, 0, 'R');
//
//        $attch= $pdf->Output('', 'S');
//
//        $clsEmail->pdfAttch=$attch;
//
//
//
//        //        if(is_null($scll->count_mailconfirmmessage_sended))
//        //            $scll->count_mailconfirmmessage_sended=0;
//        //        $scll->count_mailconfirmmessage_sended +=1;
//        //        $scll->date_lastmailconfirmmessage_sended=new CDbExpression('now()');
//        //        $scll->save(false);
//        if($clsEmail->sendEMailWithStatic('Attach',$msg_st,$clsEmailAddress)===true)
//        {
//            echo "<script> alert(\"You will recive an email\")</script>";
//        }
//        else {
//            echo "<script> alert(\"An error occurs when sending the mail\")</script>";
//        }
//    }
//        $pdf = new cls_PDF_background(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//
//// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Samer Assaf');
//$pdf->SetTitle('Certification');
//$pdf->SetSubject('Certification');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
//
//// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//
//// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(0);
//$pdf->SetFooterMargin(0);
//
//// remove default footer
//$pdf->setPrintFooter(false);
//
//// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
////        $lg = Array();
////        $lg['a_meta_charset'] = 'UTF-8';
////        $lg['a_meta_dir'] = 'rtl';
////        $lg['a_meta_language'] = 'ar';
////        $lg['w_page'] = 'page';
////
////
////        $pdf->setLanguageArray($lg);
////
////
//        $pdf->SetFont('dejavusans', '', 12);
//
//        $pdf->AddPage();
////        //$pdf->setJPEGQuality(75);
////
////        //$pdf->Image(Yii::app()->theme->baseUrl.'/assets/img/logo-login.jpg', 200, 5, 25, 20, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
//        $pdf->SetXY(40,5);
//        $pdf->Cell(75, 5, 'بطاقة تحكيم مشروع', 0, 0, 'R');
//// set some language-dependent strings (optional)
////if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
////	require_once(dirname(__FILE__).'/lang/eng.php');
////	$pdf->setLanguageArray($l);
////}
//
//// ---------------------------------------------------------
//
////// set font
////$pdf->SetFont('times', '', 48);
////
////// add a page
////$pdf->AddPage();
//
//// Print a text
//$html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 1&nbsp;</span>
//<p stroke="0.2" fill="true" strokecolor="yellow" color="blue" style="font-family:dejavusans;font-weight:bold;font-size:26pt;">تجربة طباعة خلفية لشهادة المشاركة</p>';
//$pdf->writeHTML($html, true, false, true, false, '');
//
//
////// add a page
////$pdf->AddPage();
////
////// Print a text
////$html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 2&nbsp;</span>';
////$pdf->writeHTML($html, true, false, true, false, '');
////
////// --- example with background set on page ---
////
////// remove default header
////$pdf->setPrintHeader(false);
////
////// add a page
////$pdf->AddPage();
////
////
////// -- set new background ---
////
////// get the current page break margin
////$bMargin = $pdf->getBreakMargin();
////// get current auto-page-break mode
////$auto_page_break = $pdf->getAutoPageBreak();
////// disable auto-page-break
////$pdf->SetAutoPageBreak(false, 0);
////// set bacground image
////$img_file = K_PATH_IMAGES.'image_demo.jpg';
////$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
////// restore auto-page-break status
////$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
////// set the starting point for the page content
////$pdf->setPageMark();
////
////
////// Print a text
////$html = '<span style="color:white;text-align:center;font-weight:bold;font-size:80pt;">PAGE 3</span>';
////$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
        $sql="select project_name
                    ,(select code_name from codes where code_no=project_type and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage and code_kind=106) as project_stage
                    ,project_name_en,Person_fname,Person_mname,Person_lname,person_efname,person_emname,person_elname,Person_sex
                    ,Person_email1,school_name,school_ename
                from project inner join project_student on project.project_id=project_student.project_id
                inner join person on person.Person_id=project_student.person_id
                inner join school on school.school_id=project.school_id
                where project.project_id=".$id;
        
        $query = Yii::app()->db->createCommand($sql);
        $prjs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        if(count($prjs)>0){
            foreach($prjs as $pr){
                $pdf=cls_PDF_Certification::getCertification1($pr);
                $pdf->Output('cert_051.pdf', 'I');
                return;
            }
        }
    }
    
    private function getStudentQueryForCert(){
        $sql="select project_name,project_prize,project.mobarat_year
                    ,(select code_name from codes where code_no=project_type and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage and code_kind=106) as project_stage
                    ,project_name_en,Person_fname,Person_mname,Person_lname,person_efname,person_emname,person_elname,Person_sex
                    ,Person_email1,school_name,school_ename
                from project inner join project_student on project.project_id=project_student.project_id
                inner join person on person.Person_id=project_student.person_id
                inner join school on school.school_id=project.school_id 
                inner join mobarat_school on mobarat_school.school_id=school.school_id and mobarat_school.mobarat_year=project.mobarat_year  ";
        return $sql;
    }
    private function certStd($lan,$id,$isTrophy,$sendMail){
        
        $sql=$this->getStudentQueryForCert(). " where project_student_id=".$id ." order by suite";
        $query = Yii::app()->db->createCommand($sql);
        $prjs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        if(count($prjs)>0){
            //$sql="";
            if($sendMail==false)
                if($isTrophy==false){
                    $sql="update project_student set cert_participate_print_count=cert_participate_print_count+1"
                        . ", cert_participate_print_lstdate=now() where project_student_id=".$id;
                }else{
                    $sql="update project_student set cert_trophy_print_count=cert_trophy_print_count+1"
                        . ", cert_trophy_print_lstdate=now() where project_student_id=".$id;
                }
            else
                if($isTrophy==false){
                     $sql="update project_student set cert_participate_send_count=cert_participate_send_count+1"
                        . ", cert_participate_send_lstdate=now() where project_student_id=".$id;
                    
                }else{
                   $sql="update project_student set cert_trophy_send_count=cert_trophy_send_count+1"
                        . ", cert_trophy_send_lstdate=now() where project_student_id=".$id;
                }
            
            
            $query = Yii::app()->db->createCommand($sql);
            $query->execute();
            
            $bolShowBKG=false;
            $strBKG='';
            //$sendMail=true;
            if($sendMail==true){
                $bolShowBKG=true;
                if($isTrophy==false){
                    $strBKG='Participation.jpg';
                }else{
                    $strBKG='Appreciation.jpg';
                }
                               
            }
            
            //$pdf=cls_PDF_Certification::getCertStudent($prjs,$bolShowBKG,$strBKG);
            $pdf=cls_PDF_Certification::getCert('student',$lan,$prjs,$bolShowBKG,$strBKG);
           
            if($sendMail==false){
                
                $pdf->Output('cert_051.pdf', 'I');
                return;
            }else{
                $email =$prjs[0]['Person_email1'];// "assaffsamer@gmail.com";
                $msg_st="شهادة";
               //$clsEmailAddress=new cls_EMailAddress($email, "samer assaf");
                return cls_EMail::sendCert($pdf, $email, $msg_st);
            }
        }
    }
    public function actionPrintStd($typ,$lan,$id){
         if($typ=='trophy')
            $isTrophy=true;
        else 
            $isTrophy=false;
        $this->certStd($lan,$id,$isTrophy,false);
    }
   
    public function actionSendStd($typ,$lan,$id){
         if($typ=='trophy')
            $isTrophy=true;
        else 
            $isTrophy=false;
        $this->certStd($lan,$id,$isTrophy,true);
    }
    
    private function getTeacherQueryForCert(){
        $sql="select project_teacher_id,project_name,project_prize,project.mobarat_year
                    ,(select code_name from codes where code_no=project_type and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage and code_kind=106) as project_stage
                    ,project_name_en,Person_fname,Person_mname,Person_lname,person_efname,person_emname,person_elname,Person_sex
                    ,Person_email1,school_name,school_ename
                from project inner join project_teacher on project.project_id=project_teacher.project_id
                inner join person on person.Person_id=project_teacher.person_id
                inner join school on school.school_id=project.school_id 
                inner join mobarat_school on mobarat_school.school_id=school.school_id and mobarat_school.mobarat_year=project.mobarat_year ";
        return $sql;
    }
    
    private function certTeacher($lan,$id,$isTrophy,$sendMail){
       
        $sql =$this->getTeacherQueryForCert()." where  project_teacher_id=" .$id. " order by suite ";
        
        $query = Yii::app()->db->createCommand($sql);
       // echo $sql;return;
        $prjs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        if(count($prjs)>0){
            if($sendMail==false)
            { 
                if($isTrophy==false){
                    $sql="update project_teacher set cert_participate_print_count=cert_participate_print_count+1"
                        . ", cert_participate_print_lstdate=now() where project_teacher_id=".$id;             
                }else{
                    $sql="update project_teacher set cert_trophy_print_count=cert_trophy_print_count+1"
                        . ", cert_trophy_print_lstdate=now() where project_teacher_id=".$id;    
            }}
            else
                if($isTrophy==false){
                     $sql="update project_teacher set cert_participate_send_count=cert_participate_send_count+1"
                        . ", cert_participate_send_lstdate=now() where project_teacher_id=".$id;
                    
                }else{
                   $sql="update project_teacher set cert_trophy_send_count=cert_trophy_send_count+1"
                        . ", cert_trophy_send_lstdate=now() where project_teacher_id=".$id;
                }
                 
            $query = Yii::app()->db->createCommand($sql);
            $query->execute();
           
            $bolShowBKG=false;
            $strBKG='';
            //$sendMail=true;
            if($sendMail==true){
                $bolShowBKG=true;
//                $strBKG='Appreciation.jpg';
                if($isTrophy==false){
                    $strBKG='Participation.jpg';
                }else{
                    $strBKG='Appreciation.jpg';
                }
                               
            }
            
            //$pdf=cls_PDF_Certification::getCertTeacher($prjs,$bolShowBKG,$strBKG);
            $pdf=cls_PDF_Certification::getCert('teacher',$lan,$prjs,$bolShowBKG,$strBKG);
//            $pdf->Output('cert_051.pdf', 'I');
//                return;
            //$pdf=cls_PDF_Certification::getCertification1($prjs[0]);
            if($sendMail==false){
                $pdf->Output('cert_051.pdf', 'I');
                return;
            }else{
                $email =$prjs[0]['Person_email1'];// "assaffsamer@gmail.com";
                $msg_st="شهادة";
                //$clsEmailAddress=new cls_EMailAddress($email, "samer assaf");
                return cls_EMail::sendCert($pdf, $email, $msg_st);
            }
           
        }
    }
    
    public function actionPrintTeacher($typ,$lan,$id){
         if($typ=='trophy')
            $isTrophy=true;
        else 
            $isTrophy=false;
        $this->certTeacher($lan,$id,$isTrophy,false);
    }
    
    public function actionSendTeacher($typ,$lan,$id){
         if($typ=='trophy')
            $isTrophy=true;
        else 
            $isTrophy=false;
        $this->certTeacher($lan,$id,$isTrophy,true);
    }
   

    private function getSchoolQueryForCert(){
        $sql="select project_id,project_name,project_prize,project.mobarat_year
                    ,(select code_name from codes where code_no=project_type and code_kind=111) as project_type
                    ,(select code_name from codes where code_no=project_stage and code_kind=106) as project_stage
                    ,project_name_en,Person_fname,Person_mname,Person_lname,person_efname,person_emname,person_elname,Person_sex
                    ,Person_email1,school_name,school_ename
                from project 
                inner join school on school.school_id=project.school_id
                inner join mobarat_school on mobarat_school.school_id=project.school_id and mobarat_school.mobarat_year=project.mobarat_year
                inner join person on person.Person_id=school.school_ManagerPersonID";
        return $sql;
    }
    
    private function certSchool($lan,$id,$isTrophy,$sendMail){
//        $sql="select project_id,project_name,project_prize,project.mobarat_year
//                    ,(select code_name from codes where code_no=project_type and code_kind=111) as project_type
//                    ,(select code_name from codes where code_no=project_stage and code_kind=106) as project_stage
//                    ,project_name_en,Person_fname,Person_mname,Person_lname,person_efname,person_emname,person_elname,Person_sex
//                    ,Person_email1,school_name,school_ename
//                from project 
//                inner join school on school.school_id=project.school_id
//                inner join mobarat_school on mobarat_school.school_id=project.school_id and mobarat_school.mobarat_year=project.mobarat_year
//                inner join person on person.Person_id=school.school_ManagerPersonID
//                where project_id=".$id;
        $sql=$this->getSchoolQueryForCert(). " where project_id=".$id;
        $query = Yii::app()->db->createCommand($sql);
        $prjs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        if(count($prjs)>0){
            if($sendMail==false)
                if($isTrophy==false){
                    $sql="update project set cert_participate_print_count=cert_participate_print_count+1"
                        . ", cert_participate_print_lstdate=now() where project_id=".$id;
                }else{
                    $sql="update project set cert_trophy_print_count=cert_trophy_print_count+1"
                        . ", cert_trophy_print_lstdate=now() where project_id=".$id;
                }
            else
                if($isTrophy==false){
                     $sql="update project set cert_participate_send_count=cert_participate_send_count+1"
                        . ", cert_participate_send_lstdate=now() where project_id=".$id;
                    
                }else{
                   $sql="update project set cert_trophy_send_count=cert_trophy_send_count+1"
                        . ", cert_trophy_send_lstdate=now() where project_id=".$id;
                }
            
            $query = Yii::app()->db->createCommand($sql);
            $query->execute();
            
            $bolShowBKG=false;
            $strBKG='';
            //$sendMail=true;
            if($sendMail==true){
                $bolShowBKG=true;
                $strBKG='Appreciation.jpg';
//                if($isTrophy==false){
//                    $strBKG='Participation.jpg';
//                }else{
//                    $strBKG='Appreciation.jpg';
//                }
                               
            }
            
            //$pdf=cls_PDF_Certification::getCertSchool($prjs,$bolShowBKG,$strBKG);
            $pdf=cls_PDF_Certification::getCert('school',$lan,$prjs,$bolShowBKG,$strBKG);
//            $pdf->Output('cert_051.pdf', 'I');
//                return;
            
            //$pdf=cls_PDF_Certification::getCertification1($prjs[0]);
            if($sendMail==false){
                $pdf->Output('cert_051.pdf', 'I');
                return;
            }else{
                 $email =$prjs[0]['Person_email1'];// "assaffsamer@gmail.com";
                $msg_st="شهادة";
                //$clsEmailAddress=new cls_EMailAddress($email, "samer assaf");
                return cls_EMail::sendCert($pdf, $email, $msg_st);
            }
           
        }
    }
    public function actionPrintSchool($typ,$lan,$id){
        if($typ=='trophy')
            $isTrophy=true;
        else 
            $isTrophy=false;
         $this->certSchool($lan,$id,$isTrophy,false);
    }
    /*public function actionPrintTrophySchool($id){
         $this->certSchool($id,true,false);
    }*/
    public function actionSendPartSchool($typ,$lan,$id){
        if($typ=='trophy')
            $isTrophy=true;
        else 
            $isTrophy=false;
         $this->certSchool($lan,$id,$isTrophy,true);
    }
    /*
    public function actionSendTrophySchool($id){
         $this->certSchool($id,true,true);
    }*/
    
    private function printAll($sql,$year,$typ,$lan){
        $query = Yii::app()->db->createCommand($sql);
        $prjs=$query->queryAll(TRUE);
        while($query->pdoStatement->nextRowSet());
        if(count($prjs)>0){
            $bolShowBKG=false;
            $strBKG='';
            //$pdf=cls_PDF_Certification::getCertSchool($prjs,$bolShowBKG,$strBKG);
            $pdf=cls_PDF_Certification::getCert($typ,$lan,$prjs,$bolShowBKG,$strBKG);
            $pdf->Output('Participation_Schools_'.$year.'.pdf', 'I');
        }
    }
    public function actionPrintPartAllSchool($lan){
        $year=  Mobarat::getOpenMobaratRecord();
        $sql=$this->getSchoolQueryForCert(). "  where presence_assurance=1 and mobarat_school.mobarat_year=".$year['mobarat_year'] ." order by suite";
        $this->printAll($sql,$year['mobarat_year'], 'school',$lan);
      //  $this->certAllSchool($year['mobarat_year']);
    }
//    private function certAllSchool($year){
////        $sql='select mobarat_school.mobarat_year
////                    ,Person_fname,Person_mname,Person_lname,person_efname,person_emname,person_elname,Person_sex
////                    ,Person_email1,school_name,school_ename
////                from school 
////                inner join mobarat_school on mobarat_school.school_id=school.school_id 
////                inner join person on person.Person_id=school.school_ManagerPersonID
////                where presence_assurance=1 and mobarat_school.mobarat_year='.$year ." order by suite";
//        $sql=$this->getSchoolQueryForCert(). "  where presence_assurance=1 and mobarat_school.mobarat_year=".$year ." order by suite";
//       // echo $sql;
//        $query = Yii::app()->db->createCommand($sql);
//        $prjs=$query->queryAll(TRUE);
//        while($query->pdoStatement->nextRowSet());
//        if(count($prjs)>0){
//            $bolShowBKG=false;
//            $strBKG='';
//            //$pdf=cls_PDF_Certification::getCertSchool($prjs,$bolShowBKG,$strBKG);
//            $pdf=cls_PDF_Certification::getCert('school','ar',$prjs,$bolShowBKG,$strBKG);
//            $pdf->Output('Participation_Schools_'.$year.'.pdf', 'I');
//        }
//    }

    public function actionPrintPartAllTeacher($lan){
        $year=  Mobarat::getOpenMobaratRecord();
        $sql =$this->getTeacherQueryForCert()."and presence_assurance=1  where  project.mobarat_year=".$year['mobarat_year'] . " order by suite ";
        $this->printAll($sql,$year['mobarat_year'], 'teacher',$lan);
        //$this->certAllTeacher($year['mobarat_year']);
    }
//    private function certAllTeacher($year){
//        $sql =$this->getTeacherQueryForCert()." where  project.mobarat_year=".$year . " order by suite ";
//        $query = Yii::app()->db->createCommand($sql);
//        $prjs=$query->queryAll(TRUE);
//        while($query->pdoStatement->nextRowSet());
//        if(count($prjs)>0){
//            $bolShowBKG=false;
//            $strBKG='';
//            $pdf=cls_PDF_Certification::getCert('teacher','ar',$prjs,$bolShowBKG,$strBKG);
//            $pdf->Output('Participation_Teachers_'.$year.'.pdf', 'I');
//        }
//    }
    
    public function actionPrintPartAllStudent($lan){
        $year=  Mobarat::getOpenMobaratRecord();
        $sql =$this->getStudentQueryForCert()." and presence_assurance=1 where  project.mobarat_year=".$year['mobarat_year']  ." order by suite";
        $this->printAll($sql,$year['mobarat_year'], 'student',$lan);
        //$this->certAllStudent($year['mobarat_year']);
    }
    
//    public function actionprojectotherprize($prjid){
//        $year=  Mobarat::getOpenMobaratRecord();
//        $query="select id,mobarat_code.code_kind,mobarat_code.code_Enable,code_name 
//            from codes inner join mobarat_code on mobarat_code.code_kind=codes.code_kind and mobarat_code.code_no=codes.code_no
//            where (mobarat_code.code_kind=121) and code_Enable=1  and mobarat_year=".$year['mobarat_year'];
//        
//        $otherPrize=Yii::app()->getDB()->createCommand($query)->queryAll(true);
//       
//       
//        $this->renderpartial('fulldetails',array('project'=>$project,'school'=>$school,'manager'=>$manager,'teacher'=>$teacher,'stds'=>$stds)); 
//    }
    
//    private function certAllStudent($year){
//        $sql =$this->getStudentQueryForCert()." where  project.mobarat_year=".$year ." order by suite";
//        $query = Yii::app()->db->createCommand($sql);
//        $prjs=$query->queryAll(TRUE);
//        while($query->pdoStatement->nextRowSet());
//        if(count($prjs)>0){
//            $bolShowBKG=false;
//            $strBKG='';
//            $pdf=cls_PDF_Certification::getCert('student','ar',$prjs,$bolShowBKG,$strBKG);
//            $pdf->Output('Participation_Students_'.$year.'.pdf', 'I');
//        }
//    }
   
}
