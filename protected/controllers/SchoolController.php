<?php

class SchoolController extends Controller
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
                    'application.filters.SchoolFilter',
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('create','index', 'RegisterOldSchool','AjaxRegisterOldSchool','confirmationOld','activationForm','CompleteReg','RegisterOldSchoolNewTeacher','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('update','createold','reportmain','reportbody'
                            ,'reportacceptedschoolmain','reportacceptedschoolbody','reportacceptedschooltoexcel'
                            ,'reportnotcomplete'),
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
        
    public function actionRegisterOldSchool() {
        $this->layout = '//layouts/column1_old';
        $currentMobarat=  Mobarat::getOpenMobaratRecord();

        if ($currentMobarat !=NULL)
        {
            $phone = $currentMobarat['phone_trouble'];
            $schls=  School::getUnregisteredSchool($currentMobarat['mobarat_year']);
            $this->render('RegisterOldSchool', array('phone' => $phone,'schls' => $schls));
        }
    }
        
//    public function actionAjaxRegisterOldSchool($id) {
//        $this->layout = '//layouts/column1';
// //echo "before";
//        $school = School::model()->findByAttributes(array('school_id' => $id));
//  
//        $oteach=  Personoteacher::getLastOfficialTeacher($id);
//       
//        if($oteach!=null){
//            $mizo=  cls_EMail::getMizo($oteach['Person_email1']);
//            echo '<p>أهلاً وسهلاً بك الأستاذ/ة ' . $oteach['Person_fname'] . " " . $oteach['Person_lname'] . ' المسؤول عن مباراة العلوم في ' . $school->school_name . ' عن السنة الماضية
//                                إذا كنت أنت الأستاذ المسؤول عن مباراة العلوم في هذه السنة أيضاً، يرجى';
//            echo '<strong><a href="confirmationOld/' . $id . '">الضغط هنا</a></strong>' . '،';
//            echo 'وسوف يتم ارسال رسالة إلى بريدكم الالكتروني ';
//            echo "<span class='text-danger'><strong>" . $mizo . ' </strong></span></p>';
//            echo 'إذا لم تكن أنت الأستاذ/ة ' . $oteach['Person_fname'] . " " . $oteach['Person_lname'] . ' وأصبحت الأستاذ المسؤول عن مباراة العلوم في مدرستك لهذه السنة أو أن بريدك الإلكتروني تغير يرجى';
//            echo '<strong><a href="RegisterOldSchoolNewTeacher/' . $id . '">الضغط هنا</a></strong>' . '،';
//        }
//       // else  echo "NULL";
//    }
    
    public function actionAjaxRegisterOldSchool($id) {
        $this->layout = '//layouts/column1';

        $school = School::model()->findByAttributes(array('school_id' => $id));
  
        $oteachs=  Personoteacher::getOfficialTeacher($id);
       
        if($oteachs!=null){
            $strMsg='<table>';
            foreach ($oteachs as $oteach) {
                $mizo=  cls_EMail::getMizo($oteach['Person_email1']);
                $strMsg .='<tr><td>'. $oteach['Person_fname'] . " " . $oteach['Person_lname'] .'</td>'
                            .'<td><strong>' . $mizo . ' </strong></td>'
                            .'<td>' . $oteach['years'] . ' </td>'
                            .'<td><strong><a href="confirmationOld/id/' . $id . '/persID/'.$oteach['Person_id'].'">الضغط هنا</a></strong> </td></tr>';
            }
            $strMsg.='</table>';
            $strMsg='<p>'.'حضرة الأستاذ/ة في حال كنتم مشاركين كأستاذ مسؤول في مباراة سابقة ' .' ' . ' في ' . $school->school_name .'</p>'
                        .'<p>يرجى تحديد البريد المناسب لكم</p>'
                        .$strMsg
                        .'<p>'. 'وسوف يتم ارسال رسالة إلى بريدكم الالكتروني ' .'</p>'
                        .'<p>إذا لم تكن ضمن الجدول'.'وأصبحت الأستاذ المسؤول عن مباراة العلوم في مدرستك لهذه السنة'.' يرجى ' .' '.'<strong><a href="RegisterOldSchoolNewTeacher/' . $id . '">الضغط هنا</a></strong>'.'</p>';
            echo $strMsg;
//            echo '<p>أهلاً وسهلاً بك الأستاذ/ة ' . $oteach['Person_fname'] . " " . $oteach['Person_lname'] . ' المسؤول عن مباراة العلوم في ' . $school->school_name . ' عن السنة الماضية
//                                إذا كنت أنت الأستاذ المسؤول عن مباراة العلوم في هذه السنة أيضاً، يرجى';
//            echo '<strong><a href="confirmationOld/' . $id . '">الضغط هنا</a></strong>' . '،';
//            echo 'وسوف يتم ارسال رسالة إلى بريدكم الالكتروني ';
//            echo "<span class='text-danger'><strong>" . $mizo . ' </strong></span></p>';
//            echo 'إذا لم تكن أنت الأستاذ/ة ' . $oteach['Person_fname'] . " " . $oteach['Person_lname'] . ' وأصبحت الأستاذ المسؤول عن مباراة العلوم في مدرستك لهذه السنة أو أن بريدك الإلكتروني تغير يرجى';
//            echo '<strong><a href="RegisterOldSchoolNewTeacher/' . $id . '">الضغط هنا</a></strong>' . '،';
        }
       // else  echo "NULL";
    }
    
    

    public function actionconfirmationOld($id,$persID) {
        //$layout = '//layouts/column1';
        $this->layout = '//layouts/column1';
        
        $currentMobarat =  Mobarat::getOpenMobaratRecord();
        //echo $id;
        if ($currentMobarat == null)
            return;
        
        
//        $oTeach=  Personoteacher::getLastOfficialTeacher($id);
//        if ($oTeach == null)
//            return ;
       // $oTeach=Person::model()->findByPk( $persID);
        
        
        $moba_schl=  MobaratSchool::model()->findAll('mobarat_school_RegistrationStep="01" and school_id= ' . $id . ' and mobarat_year=' .$currentMobarat['mobarat_year'] );
        if(count($moba_schl)==0)
        {
            $moba_schl=new MobaratSchool();
            $moba_schl->mobarat_year=$currentMobarat['mobarat_year'];
            $moba_schl->school_id=$id;
            $moba_schl->mobarat_school_RegistrationStep='01';
            $moba_schl->school_Past='03';
            $moba_schl->save(false);
        }
        else 
            {$moba_schl=$moba_schl[0];}
        $minute = date('i');
        $second = date('s');
        $code = $minute . $id . $second;
        $moba_schl->oteacher_personid=$persID;
        $moba_schl->confirmation_code=$code;
        $moba_schl->date_step01=new CDbExpression('now()');// date("Y-m-d H:i:s");
        $moba_schl->save(false);
        //$email = $oTeach['Person_email1'];
        /*
        $msg_st = "<table cellpadding='10' dir='rtl' style='border:1px solid black;border-collapse:collapse;'>
                    <th align='right' bgcolor='#701584'><img src='http://sciencelb.org/mobarat/moubaratTest/themes/classic/assets/img/logo.png'></br></th>
                 <tr ><td> <p align='right'>جانب الأستاذ  المحترم" . " " . $oTeach['Person_fname'] . " " . $oTeach['Person_lname'] . "  </p></td></tr>
                 <tr  bgcolor='#E0E0E0'><td direction='rtl'><p align='right'>  لقد طلبتم تسجيل مدرستكم في مباراة العلوم" . " " . $currentMobarat['mobarat_year'] . "</p></td></tr>
                 <tr><td><p align='right'><font color='#4b8df8'> لتأكيد هذا الطلب </p></td></tr>
                 <tr bgcolor='#E0E0E0'><td><p align='right'><font color='#4b8df8'><b>" . Yii::app()->createAbsoluteurl("/School/activationForm"). "/" . $id . "</b></font></p></td></tr>
                 <tr><td><p align='right'>رمز التأكيد " . " : " . $code . "</p></td></tr>
                 </table>";
        $subject = 'Activation Letter - Mobarat ' . $currentMobarat['mobarat_year'];
        $emailAddressTo=new cls_EMailAddress($email, $oTeach['Person_fname'] . " " . $oTeach['Person_lname']);
        
        $clsEMail=new cls_EMail;
        //echo $clsEMail->sendEMailWithStatic($subject,$msg_st,$emailAddressTo);
        
        if($clsEMail->sendEMailWithStatic($subject,$msg_st,$emailAddressTo)){
              //echo "<script>alert(\"true\")</script>";
        }else{
              //echo "<script>alert(\"false\")</script>";
        }*/
        //SchoolController::fctSendMailForConfirmationOld($id);
        School::sendConfirmCode($id,$persID);
        $this->render('confirmationOld');
    }
    
   
   

    public function actionactivationForm($id) {
    	
    	//$this->$layout ='layouts/column1';
		$layout = '//layouts/column2';
		//$this->layout = '//layouts/column2';
		//echo "<script>alert(1)</script>";
       //$confirmation = new MbConfirmation;
		
		 //$f = new Functions;
		//$clsEMail=new cls_EMail;
        //$layout = '//layouts/column1';
        //$conf = MbConfirmation::model()->findAll('confirmation_school= ' . $id);
	
        
        $st = " ";
        if (isset($_POST['confCode'])) {
           
            $currentMobarat =  Mobarat::getOpenMobaratRecord();
            //echo $id;
            if ($currentMobarat == null)
                return;
            
            $moba_schl=  MobaratSchool::model()->findAll('mobarat_school_RegistrationStep="01" and school_id= ' . $id . ' and mobarat_year=' .$currentMobarat['mobarat_year']);
            //echo count($moba_schl) .' '.$_POST['confCode'];
            //return;
            if(count($moba_schl)==0)
                return;
            
            $moba_schl=$moba_schl[0];
            if($moba_schl['mobarat_school_RegistrationStep']=='01'){
                
            
            $c = $_POST['confCode'];
            // echo $_POST['confCode'];return;
           // $con = MbConfirmation::model()->findAll('confirmation_school=' . $id);
            if ($moba_schl->confirmation_code == $c) {
                
                //$oTeach=  Personoteacher::getLastOfficialTeacher($id);
//                $oTeach=Person::model()->findByPk( $prsID);
//                if ($oTeach == null)
//                {echo "asd";   return ;}
                #$moba_schl->mobarat_school_RegistrationStep='02';
                #$moba_schl->save(false);
                
                $query='CALL RegisterOldSchoolOldOteacher('.$id.','.$moba_schl['mobarat_year'].')';
                $schls=Yii::app()->getDB()->createCommand($query)->execute();
                
                
                
                /*MbConfirmation::model()->updateAll(array('confirmation_flag' => 1), 'confirmation_school=' . $id);
                MbSchool::model()->updateAll(array('school_flag' => 4), 'school_id=' . $id);
                MbSchoolManager::model()->updateAll(array('smanager_flag' => 4), 'smanager_school=' . $id);
                //MbOfficialTeacher::model()->updateAll(array('oteacher_flag' => 3), 'oteacher_school=' . $id);
                $f=new Functions();
		$t=$f->getLastOfficialTeacher($id);
				
		//echo "<script>alert(\"".$t[0]['oteacher_id'] ."\")</script>";
		MbOfficialTeacher::model()->updateAll(array('oteacher_flag' => 3), 'oteacher_id=' . $t['oteacher_id']);	
		*/		
				
                $st = "has-success";
                $this->redirect($this->createAbsoluteUrl('School/completeReg'));
            } else {
                $st = "has-error";
            }
        }
        else
            $st = "has-success";
                $this->redirect($this->createAbsoluteUrl('School/completeReg'));
        }
else
        $this->renderpartial('activationForm', array( 'st' => $st));
    }
   
    public function actionCompleteReg() {
        $this->layout = '//layouts/column1';
        $currentMobarat =  Mobarat::getOpenMobaratRecord();
        if ($currentMobarat == null)
                return;
        $this->render('completeReg', array( 'year' => $currentMobarat['mobarat_year']));
    }
    
    public function actionRegisterOldSchoolNewTeacher($id) {
    	$this->layout = '//layouts/column1';
        //$data = MbOfficialTeacher::model()->findAll('oteacher_school =' . $id);
        $current=  Mobarat::getOpenMobaratRecord();
        if ($current == null)
            return ;
        if (Mobarat::getSchoolCount($current['mobarat_year'])>=$current['maxNoOfSchool']){
            echo 'لقد تم إكتمال عدد المدارس';
            return;
        }
        $model = new Person;
        $oteach=new Personoteacher;
        //$mob_sch=new MobaratSchool;
        //$newTeach = new MbTemOteacher;

        if (isset($_POST['Person'])) {

            $model->attributes = $_POST['Person'];
            $oteach->attributes = $_POST['Personoteacher'];
            $oteach->validate();
            if($model->validatePerson(enm_PersonType::OTEACHER) )
            {
                $model->date_inserted=new CDbExpression('now()');
                $model->date_lastupdate=new CDbExpression('now()');

                if ($model->save()){
                    //echo $model->Person_id;
                    
                    $image = CUploadedFile::getInstanceByName('prs_photoName');
                    $PicturePathWithOutExt=cls_attach::getPicturePathWithOutExt(enm_Program::PERSON, $model->Person_id);
                    $uploadOk=cls_attach::validateAndUploadFile($model,$image,$_FILES,'prs_photoName','Person_pic',$PicturePathWithOutExt,$model->Person_id,true,false,true );
                    $model->save();

                    $oteach->attributes = $_POST['Personoteacher'];
                    $oteach->mobarat_year=$current['mobarat_year'];
                    $oteach->oteacher_personid=$model->Person_id;
                    $oteach->date_inserted=new CDbExpression('now()');
                    $oteach->save();

                    MobaratSchool::InsertNew($current['mobarat_year'], $id, $oteach->oteacher_id, $model->Person_id, '02','02');

                   $this->redirect($this->createAbsoluteUrl('School/completeReg'));
                }
            }
            
               
        }
        $this->render('RegisterOldSchoolNewTeacher', array('model' => $model,'oteach'=>$oteach,'enmPersonType'=>  enm_PersonType::OTEACHER));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    
    private function create($bolOldRegistration=false){
        $current=  Mobarat::getOpenMobaratRecord();
        if ($current == null)
            return ;
        
        if (Mobarat::getSchoolCount($current['mobarat_year'])>=$current['maxNoOfSchool']){
            echo 'لقد تم إكتمال عدد المدارس';
            return;
        }
        $model=new School;
        $manager=new Person;
        $oteachperson = new Person;
        $oteach=new Personoteacher;
        $params=array('model'=>$model,'oteachperson'=>$oteachperson,'oteach'=>$oteach,'manager'=>$manager);
        if($bolOldRegistration){
            $myear=$current['mobarat_year']-1;
            $params['myear']=$myear;
        }
       
        if (isset($_POST['School']) && isset($_POST['Person']) && (!$bolOldRegistration || ($bolOldRegistration && isset($_POST['lstmyear'])))  ) {
            //echo $_POST['lstmyear'];return;
            if($bolOldRegistration)
                $year=$_POST['lstmyear'];
            else
                $year=$current['mobarat_year'];
            $model->attributes=$_POST['School'];
            $bolValidate=true;
            if($bolOldRegistration){
               
                     $bolValidate= $model->validateSchool(enm_SchoolType::OLD_SCHOOL);
            }else{
                 //$bolValidate=$model->validate();
                $bolValidate= $model->validateSchool(enm_SchoolType::SCHOOL);
            }
            //echo $bolValidate;return;
           
            // echo $bolValidate;//return;
            if (is_array($_POST['Person']))
            {
                $oteachperson->attributes = $_POST['Person'][0];
                $manager->attributes = $_POST['Person'][1];
               
                 if($bolOldRegistration){
                    $bolValidate= $oteachperson->validatePerson(enm_PersonType::OLD_OTEACHER) && $bolValidate;
                }else{
                    $bolValidate= $oteachperson->validatePerson(enm_PersonType::OTEACHER) && $bolValidate;
                }  //echo "<script>alert(".$bolValidate.");</script>";
                // echo $bolValidate;return;
                 if($bolOldRegistration){
                    $bolValidate= $manager->validatePerson(enm_PersonType::OLD_MANAGER) && $bolValidate;
                }else{
                    $bolValidate= $manager->validatePerson(enm_PersonType::MANAGER) && $bolValidate;
                }
            }
           
            $oteach->attributes = $_POST['Personoteacher'];
            $oteach->oteacher_personid=-1;//for Validation
            // if($bolOldRegistration){
               
            //}else{
                $bolValidate=$oteach->validate()&& $bolValidate;
           // }
            
           
            if($bolValidate)
            {
                $manager->date_inserted=new CDbExpression('now()');
                $manager->date_lastupdate=new CDbExpression('now()');
                if($manager->save())
                {
                    $image = CUploadedFile::getInstanceByName('prs_photoName1');
                    $PicturePathWithOutExt=cls_attach::getPicturePathWithOutExt(enm_Program::PERSON, $manager->Person_id);
                    $uploadOk=cls_attach::validateAndUploadFile($manager,$image,$_FILES,'prs_photoName1','Person_pic',$PicturePathWithOutExt,$manager->Person_id,true,false,true );
                    
                    $manager->save();
                    
                    $model->school_ManagerPersonID=$manager->Person_id;
                    $oteachperson->date_inserted=new CDbExpression('now()');
                    $oteachperson->date_lastupdate=new CDbExpression('now()');
                    if ($model->save() && $oteachperson->save() )
                    {
                        $image = CUploadedFile::getInstanceByName('prs_photoName0');
                        $PicturePathWithOutExt=cls_attach::getPicturePathWithOutExt(enm_Program::PERSON, $oteachperson->Person_id);
                        $uploadOk=cls_attach::validateAndUploadFile($oteachperson,$image,$_FILES,'prs_photoName0','Person_pic',$PicturePathWithOutExt,$oteachperson->Person_id,true,false,true );
                        $oteachperson->save();
                    
                        $oteach->mobarat_year=$year;
                        $oteach->oteacher_personid=$oteachperson->Person_id;
                        $oteach->date_inserted=new CDbExpression('now()');
                        $oteach->save();
                       
                        MobaratSchool::InsertNew($year, $model->school_id, $oteach->oteacher_id, $oteachperson->Person_id, '02','01');
                        $this->redirect($this->createAbsoluteUrl('School/completeReg'));
                    }
                }
            }
        }
        $this->render('create',$params);
    }
    
    public function actionreportmain()
    {
        
        $this->layout = '//layouts/column2';
        $this->render('reportmain');  
    }
    
    public function actionreportbody(){
        //echo $_POST['fname'];
        //return;
        //echo $_POST['showall'];return;
        
        $mainQuery=" from school inner join mobarat_school on mobarat_school.school_id=school.school_id 
                    left join person as ofteach on ofteach.Person_id=mobarat_school.oteacher_personid left join  user on user.user_id=ofteach.Person_userID
                    left join person as manager on manager.Person_id=school_ManagerPersonID
                    left join person_oteacher on mobarat_school.oteacher_id=person_oteacher.oteacher_id
                    where  ofteach.person_fname like '%".$_POST['fname']."%'
                    and ofteach.person_lname like '%".$_POST['lname']."%' and school_name like '%".$_POST['school']."%'";
       
        if(is_numeric($_POST['myear']))
            $mainQuery.=" and mobarat_school.mobarat_year=".$_POST['myear'];
        else{
            $current=  Mobarat::getOpenMobaratRecord();
            $mainQuery.=" and mobarat_school.mobarat_year !=".$current['mobarat_year'];
        }
        $countQuery="select count(school.school_id) ". $mainQuery;
        
        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        
        $query="select mobarat_school.mobarat_year,school.school_id,school_name,school_ename,school_street,school_email,school_phone
                    ,(select code_name from codes where code_kind=107 and code_no= school_type) as school_type
                    ,(select code_name from codes where code_kind=106 and code_no= school_level) as school_level
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,2)) as moha
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,4) and length(code_no)=4) as kada
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,6) and length(code_no)=6) as city
                    ,ofteach.Person_id as ofid,ofteach.Person_fname as ofname,ofteach.Person_mname as ofmname,ofteach.Person_lname as oflname
                    ,ofteach.Person_CellPhone as ofphone,ofteach.Person_email1 as ofmail
                    ,person_oteacher.oteacher_description
                    ,manager.Person_fname as maname,manager.Person_mname as mamname,manager.Person_lname as malname
                    ,manager.Person_CellPhone as maphone,manager.Person_email1 as mamail
                    ,(select code_name from codes where code_kind=103 and code_no=  manager.Person_sex) as masex
                    ,(select code_name from codes where code_kind=102 and code_no= manager.Person_Salutation)  as masalutation
                    ,user_mun " . $mainQuery;
        if($_POST['showall']=='true')
           $limit      ='all';// ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        else
            $limit=15;
       // echo $_POST['showall'];
        //echo $limit;return;
        $page       = ( isset( $_POST['page'] ) ) ? $_POST['page'] : 1;
        $links      =5;// ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;
        
        $para=array('page'=>$page,'showall'=>$_POST['showall'],'fname'=>$_POST['fname']
                    ,'lname'=>$_POST['lname'],'school'=>$_POST['school'],'myear'=>$_POST['myear']);
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('School/reportbody'),'fill_table');
       // echo $query;return;
        $scls    = $clspaginator->getData(  $limit ,$page);
        //echo $query;return;
        //echo count($scls->data);return;
        //echo  $page.":".$limit.":".count($stds->data);;return;
        
         if(isset($_POST['page'])){
           // echo  $page.":".$limit.":".count($stds->data);;//return;
            //return;
            
        }
       
        echo $this->renderpartial('reportbody',array('scls'=>$scls,'clspaginator'=>$clspaginator,'links'=>$links),FALSE,TRUE);
           
    }
    public function actionreportnotcomplete()
    {
        $current= Mobarat::getOpenMobaratRecord();
        $this->layout = '//layouts/column2';
        $query="select school.school_id,school_name,school_ename,school_street,school_email,school_phone
                    ,(select code_name from codes where code_kind=107 and code_no= school_type) as school_type
                    ,(select code_name from codes where code_kind=106 and code_no= school_level) as school_level
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,2)) as moha
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,4) and length(code_no)=4) as kada
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,6) and length(code_no)=6) as city
                    ,ofteach.Person_fname as ofname,ofteach.Person_mname as ofmname,ofteach.Person_lname as oflname
                    ,ofteach.Person_CellPhone as ofphone,ofteach.Person_email1 as ofmail
                    ,person_oteacher.oteacher_description
                    ,manager.Person_fname as maname,manager.Person_mname as mamname,manager.Person_lname as malname
                    ,manager.Person_CellPhone as maphone,manager.Person_email1 as mamail
                    ,(select code_name from codes where code_kind=103 and code_no=  manager.Person_sex) as masex
                    ,(select code_name from codes where code_kind=102 and code_no= manager.Person_Salutation)  as masalutation
                    ,user_mun,user_id
                    from school inner join mobarat_school on mobarat_school.school_id=school.school_id 
                    left join person as ofteach on ofteach.Person_id=mobarat_school.oteacher_personid left join  user on user.user_id=ofteach.Person_userID
                    left join person as manager on manager.Person_id=school_ManagerPersonID
                    left join person_oteacher on mobarat_school.oteacher_id=person_oteacher.oteacher_id
                    where not user_mun is null and (school_name IS NULL OR school_place IS NULL or school_level IS NULL
                            OR school_type IS NULL OR school_phone IS NULL OR school_street IS NULL)
                            AND mobarat_school.mobarat_year=".$current['mobarat_year'];
        $schls=Yii::app()->getDB()->createCommand($query)->queryall();
        //echo count($schls);return;
        $this->render('reportnotcomplete',array('schls'=>$schls));  
    }
    
    public function actionreportacceptedschoolmain()
    {
        $title='تقرير المدارس المؤكدة';
        $bodyreport='School/reportacceptedschoolbody';
        $bodyreportparams=array();
        $searchcontrol='/report/scschool01';
        $toexcelurl='School/reportacceptedschooltoexcel';
        $params=array('bodyreport'=>$bodyreport,'bodyreportparams'=>$bodyreportparams,'showcsv'=>'true','toexcelurl'=>$toexcelurl);
        $this->render('/report/reportmain',array('title'=>$title,'searchcontrol'=>$searchcontrol,'params'=>$params));  
            /*
        $this->layout = '//layouts/column2';
        $this->render('reportacceptedschoolmain');  */
    }
      
    public function actionreportbodyall(){
        $mainQuery="FROM person inner join person_teacher on person_teacher.teacher_personid=person.Person_id
                    inner join  project_teacher on project_teacher.person_id=person.Person_id
                    inner join project on project.project_id=project_teacher.project_id and person_teacher.mobarat_year=project.mobarat_year 
                    inner join school on school.school_id=person_teacher.school_id,(select @r :=0)as t
                    where person_fname like '%".$_POST['fname']."%'"
                . " and person_lname like '%".$_POST['lname']."%' and school_name like '%".$_POST['school']."%'";
        if(is_numeric($_POST['myear']))
            $mainQuery.=" and person_teacher.mobarat_year=".$_POST['myear'];
       
        $countQuery="select count(person.person_id) ". $mainQuery;
        
        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        
        $query="SELECT @r := @r+1 AS id, person.person_id,Person_fname,Person_mname,person_lname,person_email1"
                . ",person_teacher.mobarat_year,school.school_id,school.school_name  ".
                            $mainQuery;//.' limit '.$_POST['lmt'].' offset '.$_POST['oft'];
      
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
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('Personteacher/reportbodyall'),'fill_table');
        $teachs    = $clspaginator->getData(  $limit ,$page);
        //echo $limit;      return; 
         echo $this->renderpartial('reportbodyall',array('teachs'=>$teachs,'clspaginator'=>$clspaginator,'links'=>$links),FALSE,TRUE);        
           
    }
    public function actionreportacceptedschooltoexcel(){
        $mobarat=  Mobarat::getOpenMobaratRecord();
        $query="select school.school_id,  substr(user_mun,3) as user_mun ,school_name,school_ename
                    ,(select code_name from codes where code_kind=107 and code_no= school_type) as school_type
                    ,(select code_name from codes where code_kind=106 and code_no= school_level) as school_level
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,3)) as moha
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,6) and length(code_no)=6) as kada
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,9) and length(code_no)=9) as city
                    ,school_street,school_email,school_phone
                    ,ofteach.Person_fname as ofname,ofteach.Person_mname as ofmname,ofteach.Person_lname as oflname
                    ,ofteach.Person_CellPhone as ofphone,ofteach.Person_email1 as ofmail
                    ,person_oteacher.oteacher_description
                    ,manager.Person_fname as maname,manager.Person_mname as mamname,manager.Person_lname as malname
                    ,manager.Person_CellPhone as maphone,manager.Person_email1 as mamail
                    ,(select code_name from codes where code_kind=103 and code_no=  manager.Person_sex) as masex
                    ,(select code_name from codes where code_kind=102 and code_no= manager.Person_Salutation)  as masalutation
                    ,(select code_name from codes where code_kind=120 and code_no=halls) as halls
                    ,suite
                    ,(select code_name from codes where code_kind=118 and code_no=date_day) as date_day
                 from school inner join mobarat_school on mobarat_school.school_id=school.school_id 
                    left join person as ofteach on ofteach.Person_id=mobarat_school.oteacher_personid left join  user on user.user_id=ofteach.Person_userID
                    left join person as manager on manager.Person_id=school_ManagerPersonID
                    left join person_oteacher on mobarat_school.oteacher_id=person_oteacher.oteacher_id
                    where mobarat_school_RegistrationStep='04' and  mobarat_school.mobarat_year=".$mobarat['mobarat_year'].
                    " and ofteach.person_fname like '%".$_POST['txtFname']."%'
                    and ofteach.person_lname like '%".$_POST['txtLname']."%' and school_name like '%".$_POST['txtSchool']."%'";
        
         
         $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
         $label=array('الرقم','MUN','الاسم','Name','النوع','المرحلة','المحافظة','القضاء','المدينة','الشارع','البريد الالكتروني','الهاتف'
             ,'إسم الاستاذ المسؤول','أب الاستاذ المسؤول','شهرة الاستاذ المسؤول','المحمول','البريد الالكتروني','معلومات إضافية'
             ,'إسم المدير','اب المدير','شهرة المدير','المحمول','البريد الالكتروني','الجنس','المخاطبة','القاعة','الجناح','اليوم');
         cls_toCSV::exportToCSV('teacher.xls',$label,$rs);
    }
    
    
    public function actionreportacceptedschoolbody(){
        //echo $_POST['fname'];
        //return;
       
        $mobarat=  Mobarat::getOpenMobaratRecord();
        $mainQuery=" from school inner join mobarat_school on mobarat_school.school_id=school.school_id 
                    left join person as ofteach on ofteach.Person_id=mobarat_school.oteacher_personid left join  user on user.user_id=ofteach.Person_userID
                    left join person as manager on manager.Person_id=school_ManagerPersonID
                    left join person_oteacher on mobarat_school.oteacher_id=person_oteacher.oteacher_id
                    where mobarat_school_RegistrationStep='04' and  mobarat_school.mobarat_year=".$mobarat['mobarat_year'].
                    " and ofteach.person_fname like '%".$_POST['fname']."%'
                    and ofteach.person_lname like '%".$_POST['lname']."%' and school_name like '%".$_POST['school']."%'";
       /*
        if(is_numeric($_POST['myear']))
            $mainQuery.=" and mobarat_school.mobarat_year=".$_POST['myear'];
        */
        $countQuery="select count(school.school_id) ". $mainQuery;
        
        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        
        $query="select school.school_id,school_name,school_ename,school_street,school_email,school_phone
                    ,(select code_name from codes where code_kind=107 and code_no= school_type) as school_type
                    ,(select code_name from codes where code_kind=106 and code_no= school_level) as school_level
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,3)) as moha
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,6) and length(code_no)=6) as kada
                    ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,9) and length(code_no)=9) as city
                    ,(select code_name from codes where code_kind=120 and code_no=halls) as halls
                    ,suite
                    ,(select code_name from codes where code_kind=118 and code_no=date_day) as date_day
                    ,ofteach.Person_fname as ofname,ofteach.Person_mname as ofmname,ofteach.Person_lname as oflname
                    ,ofteach.Person_CellPhone as ofphone,ofteach.Person_email1 as ofmail
                    ,person_oteacher.oteacher_description
                    ,manager.Person_fname as maname,manager.Person_mname as mamname,manager.Person_lname as malname
                    ,manager.Person_CellPhone as maphone,manager.Person_email1 as mamail
                    ,(select code_name from codes where code_kind=103 and code_no=  manager.Person_sex) as masex
                    ,(select code_name from codes where code_kind=102 and code_no= manager.Person_Salutation)  as masalutation
                    ,user_mun " . $mainQuery;
        if($_POST['showall']=='true')
           $limit='all';// ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        else
            $limit=15;
        //echo $limit;return;
       
        $page       = ( isset( $_POST['page'] ) ) ? $_POST['page'] : 1;
        $links      =5;// ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;
        
        
        $para=$_POST;
        $para['page']=$page;
        /*
        $limit      =15;// ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        $page       = ( isset( $_POST['page'] ) ) ? $_POST['page'] : 1;
        $links      =5;// ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;
         //echo $query;return;
        $para=array('page'=>$page,'fname'=>$_POST['fname']
                    ,'lname'=>$_POST['lname'],'school'=>$_POST['school']);*/
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('School/reportacceptedschoolbody'),'fill_table');
        //echo $query;return;
        $scls    = $clspaginator->getData(  $limit ,$page);
       
        //echo count($scls->data);return;
        //echo  $page.":".$limit.":".count($stds->data);;return;
        
        
       
        echo $this->renderpartial('reportacceptedschoolbody',array('scls'=>$scls,'clspaginator'=>$clspaginator,'links'=>$links),FALSE,TRUE);
           
    }
    public function actionCreate()
    {
        $this->layout = '//layouts/column1';
        $this->create();
       
    }
    public function actioncreateold()
    {
        $this->layout = '//layouts/column2';
        $this->create(true);
       
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

            if(isset($_POST['School']))
            {
                    $model->attributes=$_POST['School'];
                    if($model->validateSchool(enm_SchoolType::SCHOOL)){
                        $model->save();
                     $this->redirect(array('participant/Index'));
                    }
            }

            $this->render('update',array('model'=>$model,'enmSchoolType'=> enm_SchoolType::SCHOOL));//,false,true));
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
            $dataProvider=new CActiveDataProvider('School');
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
            $model=new School('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['School']))
                    $model->attributes=$_GET['School'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return School the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
            $model=School::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param School $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='school-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
    

    
   
}
