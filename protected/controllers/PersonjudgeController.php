<?php

class PersonjudgeController extends Controller
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
            array('application.filters.PersonjudgeFilter',),
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
            array(
                'allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create',
                    'update',
                    'completereg',
                    'Reportjudgeaccept',
                    'Reportjudgeacceptbody',
                    'Reportjudgeaccepttoexcel',
                    'Judgeupdate',
                    'Judgeproject',
                    'TypeEnable',
                    'Reportjudgerejected',
                    'Reportjudgewaited',
                    'SelectEnable',
                    'Judgeprojectrate',
                    'SetEvening',
                    'SendAppreJudge',
                    'PrintAppreJudge',
                    'PrintPartAllJudge'
                ),
                'users' => array('@'),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array(
                'deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actioncompletereg($id)
    {
        $current =  Mobarat::getOpenMobaratRecord();
        if ($current == null)
            return;


        if (isset($_POST['rbbb'])) {
            $jud = Personjudge::model()->find('mobarat_year=' . $current['mobarat_year'] . ' and judge_personid =' . $id);
            if ($_POST['rbbb'] == 1) {
                $jud['judge_registrationStep'] = '03';
                $jud['date_step03'] = new CDbExpression('now()');
            } else {
                $jud['judge_registrationStep'] = '02';
                $jud['date_step02'] = new CDbExpression('now()');
            }

            if ($_POST['rbbb'] == 0 && isset($_POST['rbbb'])) {
                $jud['judge_note'] = $_POST['notes'];
            }
            $jud->save();
            if ($_POST['rbbb'] == 1) {
                $this->redirect(array('Participant/index'));
            } else {
                $this->redirect(array('Site/Logout'));
            }
        }
        $qu = "select  firstDayJudge, secondDayJudge  FROM mobarat where mobarat_year=" . $current['mobarat_year'];
        $mbrs = Yii::app()->getDB()->createCommand($qu)->queryAll(true);
        $this->render('completereg', array('my' => $current['mobarat_year'], 'firstDay' => $mbrs[0]['firstDayJudge'], 'secondDay' => $mbrs[0]['secondDayJudge']));
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
        $model = new Personjudge;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Personjudge'])) {
            $model->attributes = $_POST['Personjudge'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->judge_id));
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
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Personjudge'])) {
            $model->attributes = $_POST['Personjudge'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->judge_id));
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
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Personjudge');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Personjudge('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Personjudge']))
            $model->attributes = $_GET['Personjudge'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Personjudge the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Personjudge::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Personjudge $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'person-judge-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public function actionJudgeupdate($id)
    {
        $current =  Mobarat::getOpenMobaratRecord();
        $jud = Personjudge::model()->findBypk($id);
        $query = "insert into judge_type(person_id,judge_id,mobarat_year,project_type,type_enable,type_kernel)
                                    select " . $jud->judge_personid . "," . $jud['judge_id'] . "," . $current['mobarat_year'] . ",code_no,0,0
                                    from  mobarat_code where (code_kind=111 and code_Enable=1 and mobarat_year=" . $current["mobarat_year"] . ") on duplicate key update judge_type.type_enable=judge_type.type_enable;";
        $q = Yii::app()->db->createCommand($query);
        $q->execute();

        $query = "select judetype_id,person_id,judge_id,mobarat_code.mobarat_year,project_type,type_enable,type_kernel,judge_stage,code_name
                    from judge_type inner join mobarat_code on project_type=mobarat_code.code_no and mobarat_code.mobarat_year=judge_type.mobarat_year  and mobarat_code.code_kind=111
                    inner join codes on codes.code_no=mobarat_code.code_no and codes.code_kind=111  
                    where judge_id=" . $id;
        $jts = Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $query = "select concat(Person_fname,' ',Person_lname) as name from person where person_id=" . $jud->judge_personid;
        $rs = Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $name = $rs[0]['name'];

        /* if(isset($_POST['Personjudge'])){
            $jud->attributes = $_POST['Personjudge'];
            $jud->save();*/

        if (isset($_POST['judge_type'])) {
            $sql = '';
            foreach ($_POST['judge_type'] as $p) {

                for ($i = 0; $i < count($jts); $i++) {
                    if ($jts[$i]['judetype_id'] == $p['judetype_id']) {
                        if ($jts[$i]['judge_stage'] != $p['judge_stage']) {
                            $sql .= " update judge_type set judge_stage='" . $p['judge_stage'] . "' where judetype_id=" . $p['judetype_id'] . "; ";
                        }

                        // 
                    }
                }
            }
            if (strlen($sql) > 0) {
                //echo $sql;return;
                $query = Yii::app()->db->createCommand($sql);
                $query->execute();
            }
            $this->redirect(array('Personjudge/Reportjudgeaccept'));

            /*if ($jud->save()){
                  
             }*/
            // }


        }
        $this->render('Judgeupdate', array('jud' => $jud, 'jts' => $jts, 'name' => $name));
    }


    public function actionJudgeproject($id)
    {
       
        $this->layout = '';
        $current =  Mobarat::getOpenMobaratRecord();
        // echo"asdas";return;

        if ($current['enablejudgeday'] == 1) {
            $query = 'CALL RegisterJudgeProject(' . $id . ',' . $current['mobarat_year'] . ')';
            Yii::app()->getDB()->createCommand($query)->execute();

            $query = "update project_judge set judgeislogin=1 where  mobarat_year=" . $current['mobarat_year'] . " and judge_personId=" . $id;
            Yii::app()->getDB()->createCommand($query)->execute();
            //Update for Online        
            //            $query="SELECT project_judge_id,project_name,project_judge.judge_personid,(select code_name from codes where code_kind=111 and code_no=project_type) as ptype ,(select code_name from codes where code_kind=120 and code_no=halls) as hall ,suite,rated,grade
            //                FROM project_judge inner join project on project.project_id = project_judge.project_id inner join mobarat_school on mobarat_school.school_id =project.school_id  and mobarat_school.mobarat_year=project.mobarat_year
            //                where mobarat_school.mobarat_year=".$current['mobarat_year']." and judge_personId=".$id." and suite like concat(" . $current['enablejudgedaycode_no'].",'%') 
            //                order by hall,suite;";

            $query = "SELECT project_judge_id,project_name,project_judge.judge_personid,(select code_name from codes where code_kind=111 and code_no=project_type) as ptype ,(select code_name from codes where code_kind=120 and code_no=halls) as hall ,suite,rated,grade
                FROM project_judge inner join project on project.project_id = project_judge.project_id inner join mobarat_school on mobarat_school.school_id =project.school_id  and mobarat_school.mobarat_year=project.mobarat_year
                where mobarat_school.mobarat_year=" . $current['mobarat_year'] . " and judge_personId=" . $id . " order by hall,suite;";

            $prjs = Yii::app()->getDB()->createCommand($query)->queryAll(true);
            $this->render('Judgeproject', array('prjs' => $prjs));
        }
    }

    public function actionJudgeprojectrate($id, $prjjid)
    {
        $this->layout = 'column1_empty';
        $current =  Mobarat::getOpenMobaratRecord();
        // echo"asdas";return;
        // echo $prjjid;return;
        if ($current['enablejudgeday'] == 1) {
            //$prj= Project::model()->findBypk($prjid);

            $query = "SELECT project_judge_id,project_id,judge_id,judge_personId,grade FROM project_judge  "
                . "where project_judge_id=" . $prjjid; //." and mobarat_year=".$current['mobarat_year'].";";
            //echo 'fghfgh';return;
            $prjs = Yii::app()->getDB()->createCommand($query)->queryAll(true);

            //$judjs= Personjudge::model()->find('judge_personid='.$id.' and mobarat_year='.$current['mobarat_year']);
            //echo count($prjs);return;
            if (count($prjs) > 0) {

                $query = "insert into project_judge_grade(project_judge_id,project_id,judge_id,judge_personId,grade_type,date_inserted)
                    select " . $prjs[0]['project_judge_id'] . "," . $prjs[0]['project_id'] . "," . $prjs[0]['judge_id'] . "," . $prjs[0]['judge_personId'] . ",code_no, now()
                    from mobarat_code where code_kind=119 and code_Enable=1 and mobarat_year=" . $current['mobarat_year'] . "
                    on duplicate key update project_judge_grade.grade_type=project_judge_grade.grade_type;";
                $cmd = Yii::app()->db->createCommand($query);
                $cmd->execute();
                while ($cmd->pdoStatement->nextRowSet());

                $query = "select project_judge__Grade_id,grade_value,code_name,grade_type
                from mobarat_code inner join codes on mobarat_code.code_kind=codes.code_kind and mobarat_code.code_no=codes.code_no and mobarat_code.code_enable=1 and mobarat_code.code_kind=119 and mobarat_code.mobarat_year=" . $current['mobarat_year'] . " 
                inner join project_judge_grade on grade_type=mobarat_code.code_no
                where project_judge_id=" . $prjjid;
                $grades = Yii::app()->getDB()->createCommand($query)->queryAll(true);

                $query = "SELECT factor_type,factor_value FROM mobarat_factor where mobarat_year=" . $current['mobarat_year'] . ";";
                $factors = Yii::app()->getDB()->createCommand($query)->queryAll(true);

                $error = 0;
                $msg = '';
                $score = $prjs[0]['grade'];

                $sum_of_initial_fields = 0;
                $score_temp = 0;
                if (isset($_POST['project_judge_grade'])) {
                    $score = 0;
                    var_dump("initial score " . $score);
                    $sql = '';
                    foreach ($_POST['project_judge_grade'] as $p) {
                        if (is_numeric($p['grade_value']) && $p['grade_value'] >= 0 &&  $p['grade_value'] <= 25) {
                            for ($i = 0; $i < count($grades); $i++) {
                                if ($grades[$i]['project_judge__Grade_id'] == $p['project_judge__Grade_id']) {
                                    if ($grades[$i]['grade_value'] != $p['grade_value']) {
                                        $sql .= ' update project_judge_grade set grade_value=' . $p['grade_value'] . ' where project_judge__Grade_id=' . $p['project_judge__Grade_id'] . "; ";
                                    }
                                    $grades[$i]['grade_value'] = $p['grade_value'];
                                    // 
                                }
                            }


                            // ;
                            for ($i = 0; $i < count($factors); $i++) {
                                if ($factors[$i]['factor_type'] == $p['grade_type']) {

                                    $score_temp += (float)$p['grade_value'];
                                    $sum_of_initial_fields += (float)$factors[$i]['factor_value'];
                                    // 
                                }
                            }
                            $score = ($score_temp *10) / $sum_of_initial_fields;
                        } else {
                            $error = 1;
                        }
                        
                        var_dump("score temp    ".$score_temp."        sum_of_initial_fields  ".$sum_of_initial_fields ."                  score     ".$score);
                   
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
                        /*if(is_numeric($p['factor_value'])){ 
                        //echo $p['factor_value'];
                        $sum+=$p['factor_value'];
                    }else{
                           $error=1; 
                    }
                   */
                    }

                    $msg_temp = '';
                    for ($i = 0; $i < count($grades); $i++) {
                        $grades_temp =  floatval($grades[$i]['grade_value']);
                        $factors_temp =  floatval($factors[$i]['factor_value']);

                        if ($grades_temp > $factors_temp) {
                            $msg_temp = 'العلامة يجب أن تكون رقم بين 0 و ' . $factors_temp . ' عند الحقل  ' . $grades[$i]['code_name'];
                            $error = 1;
                        }
                    }


                    if ($error > 0) {
                        $msg = '';
                        $msg = $msg_temp;
                    } else {
                        if (strlen($sql) > 0) {


                            // $score = $score / 100;
                            var_dump("final score   ".$score);
                        // return;

                            $sql .= ' update project_judge set rated=1, date_grade_lastupdate=now(), grade=' . $score . ' where project_judge_id=' . $prjjid . ';';
                            $query = Yii::app()->db->createCommand($sql);
                            $query->execute();
                            //while($query->pdoStatement->nextRowSet());
                            $query->pdoStatement->closeCursor();
                        }
                    //    this line added to solve judge Makrs // حساب النتيجة النهائية بعد حفظ العلامات مباشرة
                        Project::model()->calculateGrade($prjs[0]['project_id']);
                        $this->redirect(array('Personjudge/Judgeproject/' . $id));
                    }
                }
                $query = "select project_name,school_name,project_description,(select code_name from codes where code_kind=106 and code_no=project_stage) as project_stage from project inner join school on project.school_id=school.school_id where project_id=" . $prjs[0]['project_id'];
                $details = Yii::app()->getDB()->createCommand($query)->queryAll(true);
                $this->render('Judgeprojectrate', array('grades' => $grades, 'factors' => $factors, 'details' => $details[0], 'judgepersonId' => $prjs[0]['judge_personId'], 'msg' => $msg, 'score' => $score));
            }


            /*$query='CALL RegisterJudgeProject('.$id.','.$current['mobarat_year'].')';
            Yii::app()->getDB()->createCommand($query)->execute();
            
            $query="SELECT project_judge_id,project_name,(select code_name from codes where code_kind=111 and code_no=project_type) as ptype ,(select code_name from codes where code_kind=120 and code_no=halls) as hall ,suite,rated
                FROM project_judge inner join project on project.project_id = project_judge.project_id inner join mobarat_school on mobarat_school.school_id =project.school_id  and mobarat_school.mobarat_year=project.mobarat_year
                where mobarat_school.mobarat_year=".$current['mobarat_year']." and judge_personId=".$id." and suite like concat(" . $current['enablejudgedaycode_no'].",'%') 
                order by hall,suite;";
            $prjs= Yii::app()->getDB()->createCommand($query)->queryAll(true);        
            $this->render('Judgeproject',array('prjs'=>$prjs));*/
        }
    }
    public function actionReportjudgeacceptbody()
    {
        //echo $_POST['fname'];

        // echo "asd";
        //return;
        $mobarat =  Mobarat::getOpenMobaratRecord();
        $mainQuery = " from person inner join person_judge on person.Person_id=person_judge.judge_personid
                    left join user on Person_userID=user.user_id
                    where person_judge.mobarat_year=" . $mobarat['mobarat_year'] . " and judge_registrationStep='03'
                    and person_fname like '%" . $_POST['fname'] . "%'
                    and person_lname like '%" . $_POST['lname'] . "%'";
        /*
        if(is_numeric($_POST['myear']))
            $mainQuery.=" and mobarat_school.mobarat_year=".$_POST['myear'];
        */
        $countQuery = "select count(person.Person_id) " . $mainQuery;

        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();

        $query = "select Person_id,judge_id,Person_fname ,Person_mname ,Person_lname,Person_CellPhone,Person_email1,user_mun,cert_apprecitation_print_count,cert_apprecitation_send_count
		,(select code_name from codes where code_kind=106 and code_no=judge_stage) as judge_stage
                ,(select code_name from codes where code_kind=115 and code_no=judge_speciality1) as judge_speciality1
                ,(select code_name from codes where code_kind=115 and code_no=judge_speciality2) as judge_speciality2
                ,(select group_concat( (select code_name from codes where code_kind=111 and code_no=project_type) SEPARATOR '<br>') from judge_type where type_enable=1 and judge_type.judge_id=person_judge.judge_id   ) as projectType
                ,(select group_concat( (select code_name from codes where code_kind=111 and code_no=project_type) SEPARATOR '<br>') from judge_type where type_kernel=1 and judge_type.judge_id=person_judge.judge_id   ) as projectTypeKernel
                ,(select group_concat( (select code_name from codes where code_kind=118 and code_no=judge_selecting.select_no) SEPARATOR '<br>') from  judge_selecting where person_judge.judge_id=judge_selecting.judge_id and judge_selecting.select_enable=1   ) as seletion"
            . $mainQuery;

        if ($_POST['showall'] == 'true')
            $limit = 'all'; // ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        else
            $limit = 15;
        //echo $limit;return;

        $page       = (isset($_POST['page'])) ? $_POST['page'] : 1;
        $links      = 5; // ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;


        $para = $_POST;
        $para['page'] = $page;
        /*
        $limit      =15;// ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        $page       = ( isset( $_POST['page'] ) ) ? $_POST['page'] : 1;
        $links      =5;// ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;
         //echo $query;return;
        $para=array('page'=>$page,'fname'=>$_POST['fname']
                    ,'lname'=>$_POST['lname'],'school'=>$_POST['school']);*/
        //echo $countQuery;return;
        $clspaginator = new cls_Paginator($countQuery, $query, $para, CController::createAbsoluteUrl('Personjudge/Reportjudgeacceptbody'), 'fill_table');
        //echo $query;return;
        $scls    = $clspaginator->getData($limit, $page);
        //echo $query;return;
        //echo count($scls->data);return;
        //echo  $page.":".$limit.":".count($stds->data);;return;



        echo $this->renderpartial('Reportjudgeacceptbody', array('scls' => $scls, 'clspaginator' => $clspaginator, 'links' => $links), FALSE, TRUE);
    }
    public function actionReportjudgeaccept()
    {
        $title = 'تقرير الحكام الموافقين';
        $bodyreport = 'Personjudge/Reportjudgeacceptbody';
        $bodyreportparams = array();
        $searchcontrol = '/report/scjudge01';
        $toexcelurl = 'Personjudge/Reportjudgeaccepttoexcel';
        $params = array('bodyreport' => $bodyreport, 'bodyreportparams' => $bodyreportparams, 'showcsv' => 'true', 'toexcelurl' => $toexcelurl);
        $this->render('/report/reportmain', array('title' => $title, 'searchcontrol' => $searchcontrol, 'params' => $params));
        /*
        $this->layout = '//layouts/column2';
        $this->render('reportacceptedschoolmain');  */
    }

    public function actionReportjudgeaccepttoexcel()
    {
        $mobarat =  Mobarat::getOpenMobaratRecord();
        $query = "select substr(user_mun,3) as user_mun,Person_fname  ,Person_lname
                    ,(select code_name from codes where code_kind=106 and code_no=judge_stage) as judge_stage
                    ,Person_email1,Person_CellPhone
                    ,(select group_concat( (select code_name from codes where code_kind=111 and code_no=project_type) SEPARATOR '; ') from judge_type where type_enable=1 and judge_type.judge_id=person_judge.judge_id   ) as projectType
                    ,(select group_concat( (select code_name from codes where code_kind=111 and code_no=project_type) SEPARATOR '; ') from judge_type where type_kernel=1 and judge_type.judge_id=person_judge.judge_id   ) as projectTypeKernel
                    from person inner join person_judge on person.Person_id=person_judge.judge_personid
                    left join user on Person_userID=user.user_id
                    where person_judge.mobarat_year=" . $mobarat['mobarat_year'] . " and judge_registrationStep='03'
                    and person_fname like '%" . $_POST['txtFname'] . "%'
                    and person_lname like '%" . $_POST['txtLname'] . "%'";


        $rs = Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $label = array(
            'MUN',
            'الاسم',
            'الشهرة',
            'المرحلة',
            'البريد الالكتروني',
            'الهاتف',
            'الفئة',
            'نواة الفئة'
        );
        cls_toCSV::exportToCSV('judge.xls', $label, $rs);
    }

    public function actionTypeEnable($judetype_id, $code_enable, $tp)
    {

        //return "كلا";
        if ($code_enable == 0)
            $c = 1;
        else {
            $c = 0;
        }

        if ($tp == '1')
            $code = 'type_enable';
        else {
            $code = 'type_kernel';
        }
        //
        //echo $code_id."; ".$code_enable;return;
        $sql = "update judge_type set " . $code . "=" . $c . " where judetype_id=" . $judetype_id;
        $query = Yii::app()->db->createCommand($sql);
        $success = $query->execute();
        // echo "asdasd";return;
        //echo $sql.' '.$judetype_id.' '.$c;
        if (($success == true && $code_enable == 0) || ($success == false && $code_enable == 1)) {
            echo "نعم";
        } else {
            echo "كلا";
        }
    }

    public function actionSelectEnable($judgeselecting_id, $person_id, $code_enable)
    {
        //$person_id for filter
        //return "كلا";
        if ($code_enable == 0)
            $c = 1;
        else {
            $c = 0;
        }

        $code = 'select_enable';

        //echo $code_id."; ".$code_enable;return;
        $sql = "update judge_selecting set " . $code . "=" . $c . " where judgeselecting_id=" . $judgeselecting_id;
        $query = Yii::app()->db->createCommand($sql);
        $success = $query->execute();
        // echo "asdasd";return;
        //echo $sql.' '.$judetype_id.' '.$c;
        if (($success == true && $code_enable == 0) || ($success == false && $code_enable == 1)) {
            echo "نعم";
            /* $clt="نعم";
            $cl='green';
             echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                    , array('update' => '#tp'.$judgeselecting_id, 'data' => array('judgeselecting_id' => $judgeselecting_id,'person_id'=>$person_id,'code_enable'=>1)
                                                        ));*/
        } else {
            echo "كلا";
            /*              $clt="كلا";
            $cl='red';
             echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                    , array('update' => '#tp'.$judgeselecting_id, 'data' => array('judgeselecting_id' => $judgeselecting_id,'person_id'=>$person_id,'code_enable'=>1)
                                                        ));*/
        }
    }

    public function actionSetEvening($judge_id, $person_id, $eveningparticipat)
    {
        //$person_id for filter
        //return "كلا";
        //echo "asdasd";return;
        if ($eveningparticipat == 0)
            $c = 1;
        else {
            $c = 0;
        }

        //$code='select_enable';

        //echo $code_id."; ".$code_enable;return;
        $sql = "update person_judge set eveningparticipat=" . $c . " where judge_id=" . $judge_id;
        $query = Yii::app()->db->createCommand($sql);
        $success = $query->execute();
        // echo "asdasd";return;
        //echo $sql.' '.$judetype_id.' '.$c;
        if (($success == true && $eveningparticipat == 0) || ($success == false && $eveningparticipat == 1)) {
            echo "نعم";
        } else {
            echo "كلا";
        }
    }

    public function actionReportjudgerejected()
    {
        $mobarat =  Mobarat::getOpenMobaratRecord();
        $query = "select Person_id,judge_id,Person_fname ,Person_mname ,Person_lname,Person_CellPhone,Person_email1,user_mun,judge_note
		 from person inner join person_judge on person.Person_id=person_judge.judge_personid
                 left join user on Person_userID=user.user_id
                 where person_judge.mobarat_year=" . $mobarat['mobarat_year'] . " and judge_registrationStep='02'";
        $judges = Yii::app()->getDB()->createCommand($query)->queryAll(true);

        $this->render('Reportjudgerejected', array('judges' => $judges));
        //$this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'params'=>$params));  
        /*
        $this->layout = '//layouts/column2';
        $this->render('reportacceptedschoolmain');  */
    }

    public function actionReportjudgewaited()
    {
        $mobarat =  Mobarat::getOpenMobaratRecord();
        $query = "select Person_id,judge_id,Person_fname ,Person_mname ,Person_lname,Person_CellPhone,Person_email1,user_mun
		 from person inner join person_judge on person.Person_id=person_judge.judge_personid
                 left join user on Person_userID=user.user_id
                 where person_judge.mobarat_year=" . $mobarat['mobarat_year'] . " and judge_registrationStep='01'";
        $judges = Yii::app()->getDB()->createCommand($query)->queryAll(true);

        $this->render('Reportjudgewaited', array('judges' => $judges));
        //$this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'params'=>$params));  
        /*
        $this->layout = '//layouts/column2';
        $this->render('reportacceptedschoolmain');  */
    }

    private function getJudgeQueryForCert()
    {
        $sql = "select person_judge.mobarat_year
                    ,(select code_name from codes where code_kind=102 and code_no=person.Person_Salutation ) as salutation
                    ,Person_fname,Person_mname,Person_lname,person_efname,person_emname,person_elname,Person_sex
                    ,Person_email1
                from person inner join person_judge on person.Person_id=person_judge.judge_personid ";
        return $sql;
    }
    private function certJudge($id, $sendMail)
    {
        //        $sql="select person_judge.mobarat_year
        //                    ,(select code_name from codes where code_kind=102 and code_no=person.Person_Salutation ) as salutation
        //                    ,Person_fname,Person_mname,Person_lname,person_efname,person_emname,person_elname,Person_sex
        //                    ,Person_email1
        //                from person inner join person_judge on person.Person_id=person_judge.judge_personid
        //                where judge_id=".$id;
        $sql = $this->getJudgeQueryForCert() . " where judge_id=" . $id;
        $query = Yii::app()->db->createCommand($sql);
        $prjs = $query->queryAll(TRUE);
        while ($query->pdoStatement->nextRowSet());
        if (count($prjs) > 0) {
            if ($sendMail == false)
                $sql = "update person_judge set cert_apprecitation_print_count=cert_apprecitation_print_count+1"
                    . ", cert_apprecitation_print_lstdate=now() where judge_id=" . $id;

            else
                $sql = "update person_judge set cert_apprecitation_send_count=cert_apprecitation_send_count+1"
                    . ", cert_apprecitation_send_lstdate=now() where judge_id=" . $id;
            $query = Yii::app()->db->createCommand($sql);
            $query->execute();

            $bolShowBKG = false;
            $strBKG = '';
            // $sendMail=true;
            if ($sendMail == true) {
                $bolShowBKG = true;
                $strBKG = 'Appreciation.jpg';
            }
            // echo "asdasd";return;
            $pdf = cls_PDF_Certification::getCertJudge($prjs, $bolShowBKG, $strBKG);
            //$pdf->Output('cert_051.pdf', 'I');
            //    return;
            //$pdf=cls_PDF_Certification::getCertification1($prjs[0]);
            if ($sendMail == false) {
                $pdf->Output('cert_051.pdf', 'I');
                return;
            } else {
                $email = $prjs[0]['Person_email1']; // "assaffsamer@gmail.com";
                $msg_st = "شهادة";
                //$clsEmailAddress=new cls_EMailAddress($email, "samer assaf");
                return cls_EMail::sendCert($pdf, $email, $msg_st);
            }
        }
    }
    public function actionPrintAppreJudge($id)
    {
        $this->certJudge($id, false);
    }
    public function actionSendAppreJudge($id)
    {
        $this->certJudge($id, true);
    }

    public function actionPrintPartAllJudge()
    {
        $year =  Mobarat::getOpenMobaratRecord();
        $this->certAllJudge($year['mobarat_year']);
    }
    private function certAllJudge($year)
    {
        $sql = $this->getJudgeQueryForCert() . " where  person_judge.mobarat_year=" . $year;
        $query = Yii::app()->db->createCommand($sql);
        $prjs = $query->queryAll(TRUE);
        while ($query->pdoStatement->nextRowSet());
        if (count($prjs) > 0) {
            $bolShowBKG = false;
            $strBKG = '';
            $pdf = cls_PDF_Certification::getCertJudge($prjs, $bolShowBKG, $strBKG);
            $pdf->Output('Participation_Students_' . $year . '.pdf', 'I');
        }
    }
}
