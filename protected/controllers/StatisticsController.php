<?php

class StatisticsController extends Controller
{
	public function actionPlace()
	{
		$this->render('place');
	}
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
        
         public function accessRules() {
        return array(
           /* array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array( 'DeleteStudent','index', 'view'),
                'users' => array('*'),
            ),*/
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('ProjectTypeStat','SchoolStat'),
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
        
        
    public function actionSchoolStat() {
       $mobarat=  Mobarat::getOpenMobaratRecord();

       echo $this->renderpartial('schoolStat',array('mobarat'=>$mobarat));
        
    }
    
      public function actionProjectTypeStat() {
        $mobarat=  Mobarat::getOpenMobaratRecord();
        $Projects = Project::projectStats($mobarat['mobarat_year']);
        echo $this->renderpartial('ProjectTypeStat',array('Projects'=>$Projects));    
       
        
    }
}