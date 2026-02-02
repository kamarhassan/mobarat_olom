<?php 

class CodesController extends Controller
{
    public $layout ='column1_empty';
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('Place','ChildCode'),
                'users' => array('*'),
            ),/*
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'update','DeleteStudent','RoleYes','RoleNo', 'DeleteTeacher', 'completeRegisterProjects', 'sendEmailStudent', 'SendEmailTeacher', 'test', 'changePass', 'allTeacher', 'allStudent', 'ProjectReport', 'ModalProject', 'updateProject','PrizeArchive'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),*/
        );
    }
    
    
	public function actionPlace()
	{
            //$layout=''; 
            $model = new PlaceCode();
            $codekind=105;
            $code_Len=3;
//$model->mohafaza='02';$model->kadaa='02';
             
            if(isset($_POST['PlaceCode']) )
            {
                //echo $_POST['PlaceCode']['mohafaza'];
                //echo Yii::trace(CVarDumper::dumpAsString($_POST), 'PlaceCode');
                $model->attributes=$_POST['PlaceCode'];
               
                $v= $model->place;
                $v .=':'. cls_codes::getFullCode_Name($codekind,$model->place,$code_Len);
                //echo $v;
                //return;
                //$this->render('place',array('model'=>$model,'codekind'=>$codekind));
                cls_DialogBox::closeDialogBox($v,CController::createAbsoluteUrl('Codes/Place'));
                
                return;
            }
            
            $this->render('place',array('model'=>$model,'codekind'=>$codekind));
	}
        
        public function actionChildCode()
        {
            //if()
            /*if( isset($_POST['father'])) echo $_POST['father'];else 
   echo 'false' ;*/
             //echo json_encode(array('key'=>$nombre));;
            $data = cls_codes::getChildCodes_ByCodeKind($_POST['codekind'], $_POST['father'],$_POST['codelen']);

            $data = CHtml::listData($data, 'code_no', 'code_name');
            echo CHtml::tag('option', array('value' => ''), '', true);
            foreach ($data as $value => $name) {
                echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
            }
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}