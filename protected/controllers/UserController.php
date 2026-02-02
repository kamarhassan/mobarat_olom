<?php

class UserController extends Controller
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
                     array(
                'application.filters.UserFilter',
//                'unit' => 'second',
            ),
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
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('reportall','reportbodyall','toexcel','Update','edit'
                                    ,'pageadddelete'),
				'users'=>array('@'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect($this->createAbsoluteUrl('Participant/index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    public function actionedit($id)
    {
        $query="insert into user_page(upg_user_id,upg_page_id,upg_allow,upg_order)
                select ". $id .",pg_id,0,pg_order from page on duplicate key update upg_allow=upg_allow";
        $cmd = Yii::app()->db->createCommand($query);
        $cmd->execute();
        
        $pages=User::getPageTree($id);
//        print_r($pg);
//        return;
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {
           // var_dump($_POST);return;
                $model->attributes=$_POST['User'];
                if(isset($_POST['ch']))
                {
                    foreach($_POST['ch'] as $key=>$value){
                        $query="update user_page set upg_allow=".$value." where upg_id=".$key;
                        $cmd = Yii::app()->db->createCommand($query);
                        $cmd->execute();
                       // echo ';' .$key.'=>'.$value .'; '.$query.'<br>';
                    }
                    //return;
                    //print_t($_POST['ch']);;return;
                
                }
                if($model->save())
                        $this->redirect($this->createAbsoluteUrl('User/reportall'));
        }

        $this->render('edit',array(
                'model'=>$model,'pages'=>$pages
        ));
    }
    public function actionreportall(){
        
        //$this->render('reportmain'); 
        $title='تقرير المستخدمون';
        $bodyreport='User/reportbodyall';
        $bodyreportparams=array();
        $searchcontrol='/report/user01';
        $toexcelurl='User/toexcel';
        $params=array('bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams,'showcsv'=>'true','toexcelurl'=>$toexcelurl);
        $this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'params'=>$params));  
        //$this->render('/report/reportmain',array('title'=>$title,'bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams));  
    }
    public function actionreportbodyall(){
        $isAdmin='02';
        if($_POST['isadmin']=='true'){
            $isAdmin='01';
        }
//        $where="from person inner join user on person.Person_userID=user.user_id
//                    where person_fname like '%".$_POST['fname']."%'"
//                . " and person_lname like '%".$_POST['lname']."%' and user_mun like '11%".$_POST['mun']."%'"
//                . " and ( Person_email1 like '%".$_POST['mail']."%' or Person_email2 like '%".$_POST['mail']."%')"
//                . " and user_type='".$isAdmin."'";
        $where="from person inner join user on person.Person_userID=user.user_id
                    where  user_mun like '11%".$_POST['mun']."%'"
                . " and user_type='".$isAdmin."' ";
        if(strlen($_POST['fname'])>0)
            $where.=" and person_lname like '%".$_POST['lname']."%' ";
        if(strlen($_POST['lname'])>0)
            $where.=" and person_lname like '%".$_POST['lname']."%' ";
        if(strlen($_POST['mail'])>0)
            $where.=" and ( Person_email1 like '%".$_POST['mail']."%' or Person_email2 like '%".$_POST['mail']."%') ";
        
        $query="select user_id, Person_fname,Person_lname, substr(user_mun,3) as user_mun, user_password ,user_type,Person_email1,Person_email2
                     " . $where;
              
        
        //echo $query;return;
        $countQuery="select count(user_mun) " . $where;
//        from person inner join user on person.Person_userID=user.user_id
//                    where person_fname like '%".$_POST['fname']."%'"
//                . " and person_lname like '%".$_POST['lname']."%' and user_mun like '11%".$_POST['mun']."%'"
//                . " and user_type='".$isAdmin."'";;
        //echo $countQuery;return;
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
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('User/reportbodyall'),'fill_table');
        $usrs    = $clspaginator->getData(  $limit ,$page);
        //echo $limit;      return; 
         echo $this->renderpartial('reportbodyall',array('usrs'=>$usrs,'clspaginator'=>$clspaginator,'links'=>$links),FALSE,TRUE);        
           
    }
    public function actiontoexcel(){  
        $isAdmin='02';
        if(isset($_POST['chIsAdmin']))
        if($_POST['chIsAdmin']==1){
            $isAdmin='01';
        }
        $query="select Person_fname,Person_lname, substr(user_mun,3) as user_mun,user_password 
                    from person inner join user on person.Person_userID=user.user_id
                    where person_fname like '%".$_POST['txtFname']."%'"
                . " and person_lname like '%".$_POST['txtLname']."%' and user_mun like '11%".$_POST['txtMun']."%'"
                 . " and ( Person_email1 like '%".$_POST['txtMail']."%' or Person_email2 like '%".$_POST['txtMail']."%')"
                . " and user_type='".$isAdmin."'";;
         $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
         $label=array('الاسم','الشهرة','MUN','Password');
         cls_toCSV::exportToCSV('users.csv',$label,$rs);
    }
    

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        
        public function actionpageadddelete($upg_id,$upg_allow) {
          //  echo "asd";return;
        $current=  Mobarat::getOpenMobaratRecord();
        $execute=0;
        
        //return "كلا";
        
        if($upg_allow==0)
            $v=1;
        else
            $v=0;
        $query="update user_page set upg_allow=".$v." where upg_id=1";    
             
        Yii::app()->getDB()->createCommand($query)->execute();
        
           
            if(($checked==0))
            {
                echo "تمت إضافته";
            }
            else {
            echo "تم حذفه";}
       
       
    }
    

       
}
