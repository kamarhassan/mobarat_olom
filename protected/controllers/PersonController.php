<?php

class PersonController extends Controller
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
                    array('application.filters.PersonFilter',),
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
				'actions'=>array('create','update','fulldetails'),
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
	public function actionCreate()
	{
		$pers=new Person;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                $param['pers']=$pers;
                $param['title']='إضافة عضو إداري';
                $param['enmPersonType']= enm_PersonType::MANAGER;

		 if(isset($_POST['Person']))
            {
                $pers->attributes = $_POST['Person'];
                                 
                
                if($pers->validatePerson($param['enmPersonType']) )
                {
                    $pers->date_lastupdate=new CDbExpression('now()');
                    if ($pers->save()){
                        //echo $model->Person_id;

                        $image = CUploadedFile::getInstanceByName('prs_photoName');
                        $PicturePathWithOutExt=cls_attach::getPicturePathWithOutExt(enm_Program::PERSON, $pers->Person_id);
                        $uploadOk=cls_attach::validateAndUploadFile($pers,$image,$_FILES,'prs_photoName','Person_pic',$PicturePathWithOutExt,$pers->Person_id,true,false,true );
                        //echo $uploadOk;return;
                        //  $pers->addError('Person_pic', 'حجم الصورة يجب ان يكون أقل من '. 512 . ' kb');
                        if($uploadOk==TRUE)
                        {
                            $current=  Mobarat::getOpenMobaratRecord();
                            $user=  User::insertNew($current['mobarat_year'],'01','10');
                            $pers->Person_userID=$user['user_id'];
                            $pers->save();
                            $this->redirect(array('user/edit/'.$user['user_id']));
                          
                        }
                            
                    }
                }
            
            }

		$this->render('update',$param);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
           
            $current=  Mobarat::getOpenMobaratRecord();
            if ($current == null)
                return ;
            $param=array();
            $pers=  Person::model()->findByPk($id);
            $param['pers']=$pers;
            $oteach= Personoteacher::model()->find('mobarat_year='.$current['mobarat_year'].' and oteacher_personid ='.$id);
            if($oteach!=null){
                $param['oteach']=$oteach;
                $param['title']='معلومات الاستاذ المسؤول';
                $param['enmPersonType']= enm_PersonType::OTEACHER;
            }
            else{
                $teach= Personteacher::model()->find('mobarat_year='.$current['mobarat_year'].' and teacher_personid ='.$id);
                if($teach!=null){
                    $param['teach']=$teach;
                    $param['title']='معلومات الاستاذ المشرف';
                    $param['enmPersonType']= enm_PersonType::TEACHER;
                }
                else{
                    $std=  Personstudent::model()->find('mobarat_year='.$current['mobarat_year'].' and student_personid ='.$id);
                    if($std!=null){
                        $param['std']=$std;
                        $param['title']='معلومات الطالب';
                        $param['enmPersonType']= enm_PersonType::STUDENT;
                    }
                    else{
                        $jud= Personjudge::model()->find('mobarat_year='.$current['mobarat_year'].' and judge_personid ='.$id);
                        if($jud!=null){
                            $this->layout='';
                            $sql = "insert into judge_selecting(person_id,judge_id,mobarat_year,select_no)
                                    select ".$id.",".$jud['judge_id'].",".$current['mobarat_year'].",code_no
                                    from  mobarat_code where (code_kind=118 and code_Enable=1 and length(code_no) >2 and mobarat_year=".$current["mobarat_year"].") on duplicate key update judge_selecting.select_enable=judge_selecting.select_enable;";
                            $query = Yii::app()->db->createCommand($sql);
                            $query->execute();
        
                            $query="select judgeselecting_id,person_id,judge_id,mobarat_code.mobarat_year,select_no,select_enable,code_name
                                        from judge_selecting inner join mobarat_code on select_no=mobarat_code.code_no and mobarat_code.mobarat_year=judge_selecting.mobarat_year  and mobarat_code.code_kind=118
                                        inner join codes on codes.code_no=mobarat_code.code_no and codes.code_kind=118  
                                        where judge_id=".$jud['judge_id'];
                            $judselect= Yii::app()->getDB()->createCommand($query)->queryAll(true);
                            //echo count($judselect);return;
                            //$judselect= JudgeSelecting::model()->findAll('mobarat_year='.$current['mobarat_year'].' and judge_id ='.$jud['judge_id']);
                            $param['jud']=$jud;
                            $param['judselect']=$judselect;
                            $param['title']='معلومات الحكم';
                            $param['enmPersonType']= enm_PersonType::JUDGE;
                        }
                        else{
                            $param['title']='معلومات المدير';
                            $param['enmPersonType']= enm_PersonType::MANAGER;
                        }
                    }
                        
                }
                
            }
           
          
            
            if(isset($_POST['Person']))
            {
                $pers->attributes = $_POST['Person'];
                if(isset($oteach)&&$oteach!=null){
                    $oteach->attributes = $_POST['Personoteacher'];
                    $oteach->validate();
                }
                elseif(isset($teach)&&$teach!=null){
                    $teach->attributes = $_POST['Personteacher'];
                    $teach->validate();
                }
                elseif(isset($std)&&$std!=null){
                    $std->attributes = $_POST['Personstudent'];
                    $std->validate();
                }
                elseif(isset($jud)&&$jud!=null){
                    $jud->attributes = $_POST['Personjudge'];
                    $jud->validate();
                }
                    
                
                if($pers->validatePerson($param['enmPersonType']) )
                {
                    $pers->date_lastupdate=new CDbExpression('now()');
                    if ($pers->save()){
                        //echo $model->Person_id;

                        $image = CUploadedFile::getInstanceByName('prs_photoName');
                        $PicturePathWithOutExt=cls_attach::getPicturePathWithOutExt(enm_Program::PERSON, $pers->Person_id);
                        $uploadOk=cls_attach::validateAndUploadFile($pers,$image,$_FILES,'prs_photoName','Person_pic',$PicturePathWithOutExt,$pers->Person_id,true,false,true );
                        //echo $uploadOk;return;
                        //  $pers->addError('Person_pic', 'حجم الصورة يجب ان يكون أقل من '. 512 . ' kb');
                        if($uploadOk==TRUE)
                        {
                            $pers->save();

                            if(isset($oteach)&&$oteach!=null){
                                $oteach->save();
                                // $this->redirect(array('participant/Index'));
                            }
                            elseif(isset($teach)&&$teach!=null){
                                $teach->save();
                                // $this->redirect(array('participant/Index'));
                            }
                            elseif(isset($std)&&$std!=null){
                                $std->save();
                                // $this->redirect(array('participant/Index'));
                            }
                             elseif(isset($jud)&&$jud!=null){
                                $jud->save();
                                
                            }
                            $clsPerson =Yii::app()->session['clsPerson'];
                            if ($clsPerson->user_type == '01') {
                                //if(isset($_REQUEST['destination']))
                                 //   $this->redirect(array( $_REQUEST['destination']));
                                // else 
                                     $this->redirect(array('Admin/Index'));
                            }
                            elseif($clsPerson->user_type == '02'){
                                 $this->redirect(array('participant/Index'));
                            }
                        }
                            
                    }
                }
            
            }

            $this->render('update',$param);
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
		$dataProvider=new CActiveDataProvider('Person');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Person('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Person']))
			$model->attributes=$_GET['Person'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Person the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Person::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Person $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='person-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
    public function actionfulldetails($userid){
        $current=  Mobarat::getOpenMobaratRecord();
        if ($current == null)
            return ;
        
        $query="select 'الاستاذ المسؤول' as title, person.Person_id, concat(Person_fname, ' ' , Person_lname) as name ,person_oteacher.mobarat_year
            ,school_name,Person_email1,Person_CellPhone 
            from  user inner join person on person.Person_userID= user.user_id 
            inner join person_oteacher on Person_id=person_oteacher.oteacher_personid and person_oteacher.mobarat_year=" . $current["mobarat_year"] ."
            inner join mobarat_school on mobarat_school.oteacher_id=person_oteacher.oteacher_id
            inner join school on school.school_id=mobarat_school.school_id
            where user.user_id=".$userid;
        $p=Yii::app()->getDB()->createCommand($query)->queryall(true);
        
        if(count($p)==0){
            $query="select 'الاستاذ المشرف' as title, person.Person_id, concat(Person_fname, ' ' , Person_lname) as name ,person_teacher.mobarat_year
                ,school_name,Person_email1,Person_CellPhone 
                from  user inner join person on person.Person_userID= user.user_id 
                inner join person_teacher on Person_id=person_teacher.teacher_personid and person_teacher.mobarat_year=" . $current["mobarat_year"] ."
                inner join school on school.school_id=person_teacher.school_id
                where user.user_id=".$userid;
            $p=Yii::app()->getDB()->createCommand($query)->queryall(true);
            if(count($p)==0){
                $query="select 'الطالب' as title, person.Person_id, concat(Person_fname, ' ' , Person_lname) as name ,person_student.mobarat_year
                    ,school_name,Person_email1,Person_CellPhone 
                    from  user inner join person on person.Person_userID= user.user_id 
                    inner join person_student on Person_id=person_student.student_personid and person_student.mobarat_year=" . $current["mobarat_year"] ."
                    inner join school on school.school_id=person_student.school_id
                    where user.user_id=".$userid;
                $p=Yii::app()->getDB()->createCommand($query)->queryall(true);
            }
        }
        if(count($p)>0){
           $this->renderpartial('fulldetails',array('p'=>$p[0]));   
        }
    }
        
     
}
