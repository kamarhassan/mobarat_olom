<?php

class MobaratController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','Update','view','CodeEnable','Mobaratjudgeupdate'
                                    ,'Mobaratfactorupdate','Mobarathallsupdate'),
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
		$model=new Mobarat;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mobarat']))
		{
			$model->attributes=$_POST['Mobarat'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->mobarat_year));
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
		$dataProvider=new CActiveDataProvider('Mobarat');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Mobarat('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mobarat']))
			$model->attributes=$_GET['Mobarat'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Mobarat the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Mobarat::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Mobarat $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mobarat-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
    public function actionUpdate($id) {
        //echo "12121";return;
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        $sql = "insert into mobarat_code(mobarat_year,code_kind,code_no,code_Enable)
                select ".$id.",code_kind,code_no,0
                from codes where (code_kind=111 or code_kind=120) on duplicate key update mobarat_code.code_Enable=mobarat_code.code_Enable;";
        $query = Yii::app()->db->createCommand($sql);
        $query->execute();
            
        $query="select id,mobarat_code.code_Enable,code_name 
            from codes inner join mobarat_code on mobarat_code.code_kind=codes.code_kind and mobarat_code.code_no=codes.code_no
            where mobarat_code.code_kind=111 and mobarat_year=".$id;
        $prj_codes=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        
        $query="select id,mobarat_code.code_Enable,code_name 
            from codes inner join mobarat_code on mobarat_code.code_kind=codes.code_kind and mobarat_code.code_no=codes.code_no
            where mobarat_code.code_kind=120 and mobarat_year=".$id;
        $halls_codes=Yii::app()->getDB()->createCommand($query)->queryAll(true);

        if (isset($_POST['Mobarat'])) {
            $model->attributes = $_POST['Mobarat'];
            //if($model->validate())
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->mobarat_year));
        }
        else{
           
        }

        $this->render('update', array(
            'model' => $model,
            'prj_codes' => $prj_codes,
            'halls_codes' => $halls_codes,
        ));
    }
    
    public function actionMobaratjudgeupdate($id){
       $mobarat = $this->loadModel($id);
//echo "$id";return;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        $sql = "insert into mobarat_code(mobarat_year,code_kind,code_no,code_Enable)
                select ".$id.",code_kind,code_no,0
                from codes where (code_kind=118 or code_kind=119 or code_kind=121) on duplicate key update mobarat_code.code_Enable=mobarat_code.code_Enable;";
        $query = Yii::app()->db->createCommand($sql);
        $query->execute();
         
        $query="select id,mobarat_code.code_kind,mobarat_code.code_Enable,code_name 
            from codes inner join mobarat_code on mobarat_code.code_kind=codes.code_kind and mobarat_code.code_no=codes.code_no
            where (mobarat_code.code_kind=118 or mobarat_code.code_kind=119 or mobarat_code.code_kind=121)  and mobarat_year=".$id;
        $day_codes=Yii::app()->getDB()->createCommand($query)->queryAll(true);

        if (isset($_POST['Mobarat'])) {
            $mobarat->attributes = $_POST['Mobarat'];
            if ($mobarat->save()){}
               $this->redirect(array('Admin/judge'));
        }


        $this->render('Mobaratjudgeupdate', array(
            'mobarat' =>$mobarat,
            'day_codes' => $day_codes,
        ));
    }
    
    public function actionCodeEnable($code_id,$code_enable) {
        
        //return "كلا";
        if($code_enable==0)
            $c=1;
        else {
            $c=0;
        }
        //
        //echo $code_id."; ".$code_enable;return;
        $sql="update mobarat_code set code_Enable=".$c." where id=".$code_id;
        $query = Yii::app()->db->createCommand($sql);
        $success=$query->execute();
       // echo "asdasd";return;
        if(($success==true && $code_enable==0) ||($success==false && $code_enable==1))
        {
            echo "نعم";
        }
         else {
             echo "كلا";
         }
    }
    
    public function actionMobaratfactorupdate($id){
        $mobarat = $this->loadModel($id);
       
        $sql = "delete from mobarat_factor where mobarat_year=". $id ." and factor_type in (select code_no from mobarat_code where code_kind=119 and code_Enable=0 and mobarat_year=". $id ." );
                insert into mobarat_factor(mobarat_year,factor_type,factor_value)
                select mobarat_year,code_no,0 from mobarat_code where code_kind=119 and code_Enable=1 and mobarat_year=" .$id ." on duplicate key  update mobarat_factor.factor_value=mobarat_factor.factor_value;";
        $query = Yii::app()->db->createCommand($sql);
        $query->execute();
       //  echo $sql;return;
        $query="select id,code_name,factor_type,factor_value
                from mobarat_factor inner join codes on code_kind=119 and code_no=factor_type and mobarat_year=".$id;
        $factors=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $msg='';
        if (isset($_POST['factors'])) {
            $sql='';
            $sum=0;
            $error=0;
             foreach ($_POST['factors'] as $p){
                 //echo $p['factor_value'];
                 //if(isset($p['factor_value'])){
                   //  $error=1;
                 //$i=0;
                 
                    for($i=0;$i<count ($factors);$i++){
                        if($factors[$i]['id']==$p['id']){
                                if($factors[$i]['factor_value']!=$p['factor_value']){
                                    $sql.=' update mobarat_factor set factor_value='.$p['factor_value'].' where id='.$p['id']."; ";
                                }
                                 $factors[$i]['factor_value']=$p['factor_value'];
                                // 
                            }
                    } 
                    /*
                    foreach ($factors as $f){
                            if($f['id']==$p['id']){
                                if($f['factor_value']!=$p['factor_value']){
                                    $sql.=' update mobarat_factor set factor_value='.$p['factor_value'].' where id='.$f['id']."; ";
                                }
                                 $f['factor_value']=$p['factor_value'];
                                // 
                            } 
                        } */
             
                        // echo $f['factor_value'].';';
                    if(is_numeric($p['factor_value'])){ 
                        //echo $p['factor_value'];
                        $sum+=$p['factor_value'];
                        
                    }else{
                           $error=1; 
                    }
                    
               }     
               // echo $sum;return; 
               $max_of_sum_sould_be=40;
                if($sum!=$max_of_sum_sould_be)
                    $error=1;
                //echo '<br>';
                if($error==1){
                    $msg='جميع الخانات يجب ان تكون ارقام، والمجوع يجب ان يساوي '.$max_of_sum_sould_be;
                }else{
                    if(strlen($sql)>0){
                        $query = Yii::app()->db->createCommand($sql);
                    $query->execute();
                    }
                    
                    $this->redirect(array('Mobaratjudgeupdate', 'id' => $id));
               
                }
                    
           
            }

        $this->render('Mobaratfactorupdate', array(
            'mobarat' =>$mobarat,
            'factors' => $factors,
            'msg'=>$msg
            ));
    }
    
     public function actionMobarathallsupdate($id){
        $mobarat = $this->loadModel($id);
       
        $sql = "delete from mobarat_halls where mobarat_year=". $id ." and hall_code_no in (select code_no from mobarat_code where code_kind=120 and code_Enable=0);
                insert into mobarat_halls(mobarat_year,hall_code_no)
                select mobarat_year,code_no from mobarat_code where code_kind=120 and code_Enable=1 and mobarat_year=" .$id ." on duplicate key  update mobarat_halls.suite_total=mobarat_halls.suite_total;";
        $query = Yii::app()->db->createCommand($sql);
        $query->execute();
       //  echo $sql;return;
        $query="select id,code_name,hall_code_no,suite_total,suite2_desc
                from mobarat_halls inner join codes on code_kind=120 and code_no=hall_code_no and mobarat_year=".$id;
        $halls=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $msg='';
        if (isset($_POST['halls'])) {
            $sql='';
            $sum=0;
            $error=0;
             foreach ($_POST['halls'] as $p){
                 //echo $p['factor_value'];
                 //if(isset($p['factor_value'])){
                   //  $error=1;
                 //$i=0;
                 
                    for($i=0;$i<count ($halls);$i++){
                        if($halls[$i]['id']==$p['id']){
                                if($halls[$i]['suite_total']!=$p['suite_total'] 
                                        || $halls[$i]['suite2_desc']!=$p['suite2_desc']){
                                    $sql.=' update mobarat_halls set suite_total='.$p['suite_total'].', suite2_desc=\''.$p['suite2_desc'].'\' where id='.$p['id']."; ";
                                    
                                }
                                 $halls[$i]['suite_total']=$p['suite_total'];
                                 $halls[$i]['suite2_desc']=$p['suite2_desc'];
                                // 
                            }
                    } 
                    $msg .=  '<br>';
                    /*$ss=split(";",$p['suite2_desc']);
                    foreach ($ss as $s){
                         if(is_numeric($s)){
                           $msg .=$s;
                         }
                         else{
                             $cc=split("-",$s);
                             foreach ($cc as $c){
                                if(is_numeric($c)){
                                    $msg .=  ' '.$c;
                                }
                                else{
                                    $msg .=  ' ERROR';
                                }
                             }
                         }
                    }*/
                    
                    
                    if(is_numeric($p['suite_total'])){ 
                        $sum+=$p['suite_total'];
                        if(Mobarat::validateSuite2desc($p['suite2_desc'],$p['suite_total'])){
                          /* $tt= Mobarat::getListSuite2desc($p['suite2_desc']);
                           foreach ($tt as $t){
                               $msg .=  ' '.$t;
                           }*/
                        }else{
                            $error=1; 
                            $msg .=  'يوجد خطأ في تحديد الاجنحة التي تتسع الى مشروعين';
                        }
                    }else{
                        $error=1; 
                        $msg='عدد الأجنحة يجب أن يكون رقم';
                    }
                    
               }     
              
                if($error==1){
                    //$msg='عدد الأجنحة يجب أن يكون رقم';
                }else{
                    if(strlen($sql)>0){
                        $query = Yii::app()->db->createCommand($sql);
                    $query->execute();
                    }
                    
                    $this->redirect(array('update', 'id' => $id));
               
                }
                    
           
            }

        $this->render('Mobarathallsupdate', array(
            'mobarat' =>$mobarat,
            'halls' => $halls,
            'msg'=>$msg
            ));
    }
}
