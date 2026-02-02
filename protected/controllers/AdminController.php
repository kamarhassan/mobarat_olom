<?php
Yii::import('ext.runactions.components.ERunActions');
class AdminController extends Controller
{
    public $layout='//layouts/column2';
    //public $layout = '//layouts/column1_empty';
    
    
	public function actionPendingSchool()
	{
             $mobarat=  Mobarat::getOpenMobaratRecord();
		 $schoolPending =  MobaratSchool::getPendingSchools($mobarat['mobarat_year']);// MbSchool::model()->findAll('school_flag!=1 AND school_flag!=6 AND school_flag!=2 AND school_flag!=8');
                    $this->render('PendingSchool', array('schoolPending' => $schoolPending));
	}
        
        public function actionWaitingconfirmcodeschool()
	{
             $mobarat=  Mobarat::getOpenMobaratRecord();
		 $schoolPending =  MobaratSchool::getWaitingconfirmcodeschools($mobarat['mobarat_year']);// MbSchool::model()->findAll('school_flag!=1 AND school_flag!=6 AND school_flag!=2 AND school_flag!=8');
                    $this->render('Waitingconfirmcodesschool', array('schoolPending' => $schoolPending));
	}
        
        public function actionSchoolhalls()
	{ 
            $mobarat=  Mobarat::getOpenMobaratRecord();
                     
            $model=new MobaratSchool();
            $model->unsetAttributes();
            
            $bShowPage=false;
            $bSubmit=false;
            $bsave=false;
           // $bsearch=false;
            $brelateall=false;
            $brelateremain=false;
            $bsendmailall=false;
            $msg='';
            if(isset($_REQUEST['subject'])){
                switch($_REQUEST['subject']){
                    case 'submit':
                        $bsave=true;
                        $bSubmit=true;
                        break;
                    case 'relateall':
                        $brelateall=true;
                        $bShowPage=true;
                        break;
                    case 'relateremain':
                        $brelateremain=true;
                        //$bsave=true;
                        $bShowPage=true;
                        break;
                    case 'sendmailall':
                        $bsendmailall=true;
                        $bsave=true;
                        break;
                        //$bShowPage=true;
                    default :
                        $bsave=true;
                        $bShowPage=true;
                        break;
                }
            }
           else 
               $bShowPage=true;
          
           
            if($brelateall==true){
                $msg=MobaratSchool::relateSchoolToHalls($mobarat['mobarat_year'],true);
                //return;
            }if($brelateremain==true){
                $msg=MobaratSchool::relateSchoolToHalls($mobarat['mobarat_year'],false);
                //echo $msg;
                //return;
            }
            
            if(MobaratSchool::hasDuplicateSuite($mobarat['mobarat_year'])==true){
                //echo 'trrrr';return;
                $model->ShowDuplicateOnly=true;
                //$bSubmit=false;
                //$bShowPage=true;
            }
            if(isset($_POST['MobaratSchool'])){
                  if(isset($_POST['MobaratSchool']['schoolName'])){
                      // echo $_POST['MobaratSchool']['schoolName'];return;
                      $model->schoolName=$_POST['MobaratSchool']['schoolName'];
                      $model->date_day=$_POST['MobaratSchool']['date_day'];
                      $model->halls=$_POST['MobaratSchool']['halls'];
                      $model->presence_assurance=$_POST['MobaratSchool']['presence_assurance'];
                      $model->is_present=$_POST['MobaratSchool']['is_present'];
                      $model->ProjectType=$_POST['MobaratSchool']['ProjectType'];
                  }
             }
             
            $model->mobarat_school_RegistrationStep='04';
            $model->mobarat_year=$mobarat['mobarat_year'];
            $data=$model->search();
            if($bsave==true){
                if(isset($_POST['MobaratSchool'])){
                    foreach($data->data as $i=>$item){
                        //echo $item['mobarat_schoolID'];
                        if(isset($_POST['MobaratSchool'][$item['mobarat_schoolID']])){
                            //echo "FALSE";return;
                            $item->attributes=$_POST['MobaratSchool'][$item['mobarat_schoolID']];
                            if($item->save(false)){}
                            else{ throw new CHttpException(404,'Cannot save.');echo "FALSE";return;}
                        }
                    }
                }    
            }
            if(MobaratSchool::hasDuplicateSuite($mobarat['mobarat_year'])==true){
                //echo 'trrrr';return;
                $model->ShowDuplicateOnly=true;
                $data=$model->search();
                $bSubmit=false;
                $bShowPage=true;
                $msg='هنك أجنحة مكررة، يرجى توزيع الاجنحة على المدارس مع تفادي التكرار';
            }else{
                $model->ShowDuplicateOnly=false;
                $data=$model->search();
            }
            
            if($bSubmit==true)
                $this->redirect(array('Judge'));
            elseif($bShowPage==true)
                $this->render('Schoolhalls', array('model' => $model,'data'=>$data,'msg'=>$msg));
            elseif($bsendmailall==true){
                // echo "yuasduh";
                //$job=Yii::app()->background->start('sendAllOteacherSuite');
                //ERunActions::touchUrl($this->createAbsoluteUrl('Admin/sendAllOteacherSuite'),'POST');
                //echo "progress".$this->createAbsoluteUrl('Admin/sendAllOteacherSuite');
                ERunActions::runAction('Admin/sendAllOteacherSuite');
               // $this->redirect(array('sendAllOteacherSuite'));
            }
                
                
            
	}
        
        public function actionResendmailconfirmcodes($id,$prsID){
            //echo $id;return;
            if (School::sendConfirmCode($id,$prsID)==true){
                echo "succeed";
            }
            else echo 'Failed';
            /*if(SchoolController::fctSendMailForConfirmationOld($id)==true)
                echo 'igh 100';
            else echo 'igh 0';*/
            //echo 'igh 100';
            //return 'asdasd';
        }
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
                'actions' => array('Index','PendingSchool','Waitingconfirmcodeschool','Resendmailconfirmcodes','DeleteSchool','RemoveSchool','ConfirmSchool'
                    ,'ModalOldOteach','ReportAcceptedSchool','ExtraProject','SendEmail','Config','Judge','InviteJudge','Schoolhalls'
                    ,'NewYear','SelectYear','reportpersonmaincheck','SendJudgeInvitation','SendJudgeInvitationAll','SendJudgeInvitationInput'
                    ,'sendOteacherSuite','sendAllOteacherSuite',),
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
    
    public function actionIndex() {
        //echo '12123';
        //$layout = '//layouts/column2';
        //echo "1223123";
        //return;
        //$mobarat=  Mobarat::getOpenMobaratRecord();
        $current= Mobarat::getOpenMobaratRecord();
        
        $model = new MbMessage;

        $array = array(
            array(
                'id' => 0,
                'to' => 'كل الأساتذة المسؤولين عن المدارس'
            ),
            array(
                'id' => 1,
                'to' => 'الأساتذة المشرفين على المشاريع'
            ),
            array(
                'id' => 2,
                'to' => 'كل الطلاب المشاركين'),
            array(
                'id' => 3,
                'to' => 'كل الأعضاء')
        );
        $list = CHtml::listData($array, 'id', 'to');


        if (isset($_POST['MbMessage'])) {
            $model->attributes = $_POST['MbMessage'];
            $model->message_date = new CDbExpression('NOW()');
            
            if ($model->to == 0) {
                $query="select Person_userID
                            from person_oteacher inner join person on person_oteacher.oteacher_personid=person_id
                            where not Person_userID is null and mobarat_year=".$current['mobarat_year'];
                //$destination = MbUser::model()->findAll('user_type=2');
            } else
            if ($model->to == 1) {
                $query="select Person_userID
                    from person_teacher inner join person on teacher_personid=person_id
                    where not Person_userID is null and mobarat_year=".$current['mobarat_year'];
                //$destination = MbUser::model()->findAll('user_type=4');
            } else
            if ($model->to == 2) {
                $query="select Person_userID
                    from person_student inner join person on student_personid=person_id
                    where not Person_userID is null and mobarat_year=".$current['mobarat_year'];
                //$destination = MbUser::model()->findAll('user_type=3');
            } else
            if ($model->to == 3) {
                $query="select Person_userID
                    from person_student inner join person on student_personid=person_id
                    where not Person_userID is null and mobarat_year=".$current['mobarat_year']."
                    union distinct
                    select Person_userID
                    from person_teacher inner join person on teacher_personid=person_id
                    where not Person_userID is null and mobarat_year=".$current['mobarat_year']."
                    union distinct
                    select Person_userID
                    from person_oteacher inner join person on person_oteacher.oteacher_personid=person_id
                    where not Person_userID is null and mobarat_year=".$current['mobarat_year'];
                //$destination = MbUser::model()->findAll('user_type!=1');
            }
            $destination=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            if ($model->save()) {
                foreach ($destination as $r) {
                    $detail = new MbMessageDetail;
                    $detail->mdetail_message = $model->message_id;
                    $detail->mdetail_receiver = $r['Person_userID'];
                    $detail->mdetail_sender = Yii::app()->user->id;
                    $detail->message_read_flag = 0;

                    $detail->save(false);
                }
                echo "<script>
                alert(\"لقد تم إرسال الرسالة بنجاح\")
                window.location='../MbAdmin/index'
                </script>";
            }
        }
        
       
        /*$this->render('index');
        $this->render('index', array(
            'mobarat'=>$current,
            'model' => $model,
            'list' => $list
        ));*/
         /* for permission*/
        $query="SELECT pg_id,pg_code_no,pg_ispage,pg_name,pg_color,pg_icon,pg_number,pg_desc,pg_url,upg_allow,upg_order "
                . " FROM user_page inner join page on pg_id=upg_page_id "
                . " where upg_allow=1 and upg_user_id=".Yii::app()->user->id
                . " order by upg_order;";
        
        $pgs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        

        $this->render('indexp', array(
            'mobarat'=>$current,
            'model' => $model,
            'list' => $list,
            'pgs'=>$pgs
        ));
        
    }

    public function actionJudge() {
        $current= Mobarat::getOpenMobaratRecord();
        
        /*$this->render('judge', array('mobarat'=>$current));*/
        
         /* for permission*/
        $query="SELECT pg_id,pg_code_no,pg_ispage,pg_name,pg_color,pg_icon,pg_number,pg_desc,pg_url,upg_allow,upg_order "
                . " FROM user_page inner join page on pg_id=upg_page_id "
                . " where upg_allow=1 and upg_user_id=".Yii::app()->user->id
                . " order by upg_order;";
        
        $pgs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $this->render('judgep', array(
            'mobarat'=>$current,
            'pgs'=>$pgs
        ));
    }
    
    public function actionConfig() {
        $current= Mobarat::getOpenMobaratRecord();
        
        
        /*$this->render('config', array('mobarat'=>$current));*/
        
        /* for permission*/
        $query="SELECT pg_id,pg_code_no,pg_ispage,pg_name,pg_color,pg_icon,pg_number,pg_desc,pg_url,upg_allow,upg_order "
                . " FROM user_page inner join page on pg_id=upg_page_id "
                . " where upg_allow=1 and upg_user_id=".Yii::app()->user->id
                . " order by upg_order;";
        
        $pgs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $this->render('configp', array(
            'mobarat'=>$current,
            'pgs'=>$pgs
        ));
    }
    
    
    public function actionNewYear(){
        $newYear= Mobarat::getMaxYear()+1;
        $mobarat=new Mobarat;
        $mobarat->mobarat_year=$newYear;
        $mobarat->last_register_school= date('Y-m-d',strtotime(($newYear-1).'-12-12'));
        $mobarat->last_register_project=date('Y-m-d',strtotime(($newYear).'-1-1'));
        $mobarat->last_register_teacher_student=date('Y-m-d',strtotime(($newYear).'-1-15'));
        $mobarat->last_update=date('Y-m-d',strtotime(($newYear).'-2-1'));
        $mobarat->last_update_judge=date('Y-m-d',strtotime(($newYear).'-4-1'));
        $mobarat->openForRegistration=1;
        
        
       
        
        Mobarat::model()->updateAll(array('openForRegistration'=>false));
        if($mobarat->save()){
            $query="insert into mobarat_code(mobarat_year,code_kind,code_no,code_Enable)
                select ".$newYear.",code_kind,code_no,1
                from codes where code_kind=111 or code_kind=118
                on duplicate key update mobarat_code.code_Enable=mobarat_code.code_Enable;";
            $cmd = Yii::app()->db->createCommand($query);
            $cmd->execute();
            
          /*  echo "<script>
                alert(\"لقد تم إضافة سنة بنجاح\")
                window.location='../Admin/Config'
                </script>";*/
        }
        else {
            /*echo "<script>
                alert(\"حصل خطأ\")
                window.location='../Admin/Config'
                </script>";*/
        }
        echo "<script>
                 window.location='../Admin/Config'
                </script>";
    }
    
     public function actionSelectYear() {
       
        $current= Mobarat::getOpenMobaratRecord();
        if(count($current)>0)
            $mo= Mobarat::model()->findAll('mobarat_year!='.$current['mobarat_year']);
        else {
            $mo= Mobarat::model()->findAll('1=1');
        }
        $list = CHtml::listData($mo, 'mobarat_year', 'mobarat_year');


        if (isset($_POST['mobaratyear'])) {
            if (is_numeric( $_POST['mobaratyear'])){
                
            Mobarat::model()->updateAll(array('openForRegistration'=>false));
            Mobarat::model()->updateByPk(array('mobarat_year'=>$_POST['mobaratyear']),array('openForRegistration'=>true));
             echo "<script>
                alert(\"لقد تم تعديل السنة بنجاح\")
                window.location='../Admin/Config'
                </script>";
            }
            
            
        }
        

        /*$this->render('index');*/
        $this->render('selectyear', array(
            'list' => $list,'mobarat'=>$current
        ));
    }

    
    public function actionDeleteSchool($id) {
        /*
        MbSchool::model()->updateAll(array('school_flag' => 6), 'school_id = ' . $id);
        MbOfficialTeacher::model()->updateAll(array('oteacher_flag' => 6), 'oteacher_school = ' . $id);
        MbSchoolManager::model()->updateAll(array('smanager_flag' => 6), 'smanager_school = ' . $id);
         *
         */
        $mobarat=  Mobarat::getOpenMobaratRecord();
        MobaratSchool::model()->updateAll(array('mobarat_school_RegistrationStep' => '03','date_step03'=>new CDbExpression('now()')), 'mobarat_year='.$mobarat['mobarat_year'].' and school_id = ' . $id);
        //$query="update mobarat_school set mobarat_school_RegistrationStep='03', date_step03=now() where mobarat_year=".$mobarat['mobarat_year']." and school_id = " . $id;
        //$schls=Yii::app()->getDB()->createCommand($query)->execute();
    }
    
    public function actionRemoveSchool($id){
        $mobarat=  Mobarat::getOpenMobaratRecord();
        $ms=MobaratSchool::model()->find('mobarat_year='.$mobarat['mobarat_year'].' and school_id = ' . $id);
        $query="delete from project_student where project_id in (select project_id from project where mobarat_year=".$mobarat['mobarat_year']." and school_id=".$id.");
                delete from project_teacher where project_id in (select project_id from project where mobarat_year=".$mobarat['mobarat_year']." and school_id=".$id.");
                delete from project where mobarat_year=".$mobarat['mobarat_year']." and school_id=".$id.";
                delete from person_student where mobarat_year=".$mobarat['mobarat_year']." and school_id=".$id.";
                delete from person_teacher where mobarat_year=".$mobarat['mobarat_year']." and school_id=".$id.";
                delete from mobarat_school where mobarat_year=".$mobarat['mobarat_year']." and school_id=".$id.";
                delete from person_oteacher where mobarat_year=".$mobarat['mobarat_year']." and oteacher_id=".$id.";";
        Yii::app()->getDB()->createCommand($query)->execute();
    }
	
    private function getConfirmationMessage($oteacher_fname,$oteacher_lname,$school_name,$subMUN,$user_password){
        $mobarat=  Mobarat::getOpenMobaratRecord();    
		$msg_st="<table dir='rtl' cellpadding='10' style='border:1px solid black;border-collapse:collapse;'>
    			<th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
			    	<tr ><td ><p align='right'><font color='#4b8df8'>جانب الأستاذ /الأستاذة <b>" . $oteacher_fname . " " . $oteacher_lname . "</b>
                			</font> المحترم/المحترمة مسؤول/مسؤولة مباراة العلوم في  <font color='#4b8df8'><b>" . $school_name . "</b></font> </p></td></tr>
    				<tr > <td><p align='right'> لقد تم تأكيد تسجيل مدرستكم في مباراة العلوم ، إن كافة المراسلات سوف ترد إلى بريدكم الإلكتروني  <br> لتسجيل الدخول  http://mobarat.nasr.org.lb </p></td></tr>
    				<tr  bgcolor='#E0E0E0'><td><p align='right'>MUN في خانة اسم المستخدم يجب كتابة الرقم الخاص بمدرستكم </p></td></tr>
    				<tr><td><p align='right'><font color='#4b8df8'><b> MUN : " . $subMUN . "</b></font> </p></td></tr>
    				<tr bgcolor='#E0E0E0'><td><p align='right'>كلمة المرور : <font color='#4b8df8'><b>" . $user_password . "</b></font></p></td></tr>
    				<tr><td><p align='right'> الخطوات اللاحقة: تسجيل المشاريع والأساتذة والطلاب</br>
                				يمكنكم كحد أقصى تسجيل مشروع واحد لكل مرحلة  متوسط أو ثانوي  لكل مشروع أستاذ عدد:".$mobarat['TeacherNbForProject'] ."  وطلاب عدد: ".$mobarat['StudentNbForProject'] ." كحد أقصى
                		</p></td></tr>
    				<tr bgcolor='#E0E0E0'><td><p align='right'>يمكنكم الاطلاع وتعديل بيانات مدرستكم من خلال الدخول إلى موقع التسجيل</p></td></tr>
    			</table>";
				
		return $msg_st;
	}

     public function actionSendEmail($id) {
        //echo "<script> alert(\"14\") </script> ";	
        $mobarat=  Mobarat::getOpenMobaratRecord();
        $scll = MobaratSchool::model()->find('mobarat_year='.$mobarat['mobarat_year'].' and school_id = ' . $id);
        
        $s = Person::model()->findByPk($scll->oteacher_personid);
        $sc=  School::model()->findByPk( $id);
        $user = User::model()->findByPk( $s->Person_userID);

        $subMUN = substr($user['user_mun'], 2);

        $email = $s['Person_email1'];


        $msg_st=$this->getConfirmationMessage($s['Person_fname'],$s['Person_lname'],$sc['school_name'],$subMUN,$user['user_password']);

        $clsEmail=new cls_EMail();
        $clsEmailAddress=new cls_EMailAddress($email, $s['Person_fname'] . " " . $s['Person_lname']);
        if(is_null($scll->count_mailconfirmmessage_sended))
            $scll->count_mailconfirmmessage_sended=0;
        $scll->count_mailconfirmmessage_sended +=1;
        $scll->date_lastmailconfirmmessage_sended=new CDbExpression('now()');
        $scll->save(false);
        if($clsEmail->sendEMailWithStatic('Confirmation',$msg_st,$clsEmailAddress)===true)
        {
            echo "<script> alert(\"You will recive an email\")</script>";
        }
        else {
            echo "<script> alert(\"An error occurs when sending the mail\")</script>";
        }
            
        
    }
    public function actionConfirmSchool($id) {
       // $bSucceed=0;
        $mobarat=  Mobarat::getOpenMobaratRecord();
        $scll = MobaratSchool::model()->find('mobarat_school_RegistrationStep="02" and mobarat_year='.$mobarat['mobarat_year'].' and school_id = ' . $id);
        
        if ($scll->school_Past == '01') {

            $user=  User::insertNew($mobarat['mobarat_year'],'02','12');

            $s = Person::model()->findByPk( $scll->oteacher_personid);
            $sc=  School::model()->findByPk( $id);

            $email = $s['Person_email1'];
            $subMUN = substr($user->user_mun, 2);
            $msg_st=$this->getConfirmationMessage($s['Person_fname'],$s['Person_lname'],$sc['school_name'],$subMUN,$user->user_password);
	
            $clsEmail=new cls_EMail();

            $clsEmailAddress=new cls_EMailAddress($email, $s['Person_fname'] . " " . $s['Person_lname']);

            if($clsEmail->sendEMailWithStatic('Confirmation',$msg_st,$clsEmailAddress)==true)
            {
                    echo "<script> alert(\"You will recive an email\")</script>";
            }
            else {
                    echo "<script> alert(\"An error occurs when sending the mail\")</script>";
            }
                       
            $user->save(false);
            $s['Person_userID']=$user->user_id;
			//echo $s['Person_userID'];
            $s->save(false);
            $scll->mobarat_school_RegistrationStep='04';
            $scll->date_step04=new CDbExpression('now()');
            $scll->count_mailconfirmmessage_sended=1;
            $scll->date_lastmailconfirmmessage_sended=new CDbExpression('now()');
            $scll->save(false);
           
            //$bSucceed=1;
       }

        elseif ($scll->school_Past == '02'  || $scll->school_Past == '03') {
            
            $oldtea = MobaratSchool::model()->findBySql('select * from mobarat_school where mobarat_school_RegistrationStep="04" and school_id='.$id.' and mobarat_year<'.$mobarat['mobarat_year'].' order by mobarat_year desc ');
            $oldpers=Person::model()->findByPk($oldtea->oteacher_personid);
            if (is_null($oldpers->Person_userID))
            {
                $user=  User::insertNew($mobarat['mobarat_year'],'02','12');
            }
            else 
            {
                
                $user = User::model()->findByPk( $oldpers->Person_userID);
            }
            $s = Person::model()->findByPk($scll->oteacher_personid);
            //set user clean
            $query="update person set Person_userID=null where Person_userID=".$user->user_id." and person_id<>".$s->Person_id;
            Yii::app()->getDB()->createCommand($query)->execute();
            //set user clean
 
            
            $s->Person_userID=$user->user_id;
            $sc=  School::model()->findByPk( $id);
    
            

            $subMUN = substr($user['user_mun'], 2);
           
           
            $email = $s['Person_email1'];
            
            
            $msg_st=$this->getConfirmationMessage($s['Person_fname'],$s['Person_lname'],$sc['school_name'],$subMUN,$user['user_password']);

            $clsEmail=new cls_EMail();
            $clsEmailAddress=new cls_EMailAddress($email, $s['Person_fname'] . " " . $s['Person_lname']);

            if($clsEmail->sendEMailWithStatic('Confirmation',$msg_st,$clsEmailAddress)===true)
            {
                echo "<script> alert(\"You will recive an email\")</script>";
            }
            else {
                echo "<script> alert(\"An error occurs when sending the mail\")</script>";
            }
            $s->save(false);
            $scll->mobarat_school_RegistrationStep='04';
            $scll->date_step04=new CDbExpression('now()');
            $scll->count_mailconfirmmessage_sended=1;
            $scll->date_lastmailconfirmmessage_sended=new CDbExpression('now()');
            $scll->save(false);
                       
            
            //$scll->save(false);
            //$bSucceed=1;
        }
       // if($bSucceed==1){
        //    $query="update mobarat_school set mobarat_school_RegistrationStep='04', date_step04=now() where mobarat_year=".$mobarat['mobarat_year']." and school_id = " . $id;
        //    $schls=Yii::app()->getDB()->createCommand($query)->execute();
       // }
    }

       
    public function actionModalOldOteach($id) {
        $mobarat=  Mobarat::getOpenMobaratRecord();
        $scll = MobaratSchool::model()->find('mobarat_year='.$mobarat['mobarat_year'].' and school_id = ' . $id);
        $old = MobaratSchool::model()->findBySql('select * from mobarat_school where school_id='.$id.' and mobarat_year<'.$mobarat['mobarat_year'].' order by mobarat_year desc ');
        $model=Person::model()->findByPk($old->oteacher_personid);
        
        
        $oteach=Personoteacher::model()->findByPk($old->oteacher_id);
        //echo $model->Person_fname;
        echo $this->renderpartial('/person/_view', array('model' => $model, 'oteach' => $oteach));
    
    }
    
    public function actionReportAcceptedSchool() {
        $mobarat=  Mobarat::getOpenMobaratRecord();
               
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
                    ,user_mun

                     from school inner join mobarat_school on mobarat_school.school_id=school.school_id 
                    left join person as ofteach on ofteach.Person_id=mobarat_school.oteacher_personid left join  user on user.user_id=ofteach.Person_userID
                    left join person as manager on manager.Person_id=school_ManagerPersonID
                    left join person_oteacher on mobarat_school.oteacher_id=person_oteacher.oteacher_id
                    where mobarat_school_RegistrationStep='04' and mobarat_year=".$mobarat['mobarat_year'];
        $schoolConfirmed=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            
            
        $this->render('reportAcceptedSchool', array('schoolConfirmed' => $schoolConfirmed));
    }
    
    public function actionExtraProject($id) {
        $mobarat=  Mobarat::getOpenMobaratRecord();
        MobaratSchool::model()->updateAll(array('extraProject' => 1), 'school_id = ' . $id.' and mobarat_year='.$mobarat['mobarat_year']);
    }
    
     public function actionArchive() {
        $bolReset=false;
        $model = new MbSchool;
        $schoolManager = new MbSchoolManager;
        $officialTeacher = new MbOfficialTeacher;
        $user = new MbUser;
        if (isset($_POST['MbSchool']) || isset($_POST['MbSchoolManager']) || isset($_POST['MbOfficialTeacher'])) {
            $model->attributes = $_POST['MbSchool'];
            $schoolManager->attributes = $_POST['MbSchoolManager'];
            $officialTeacher->attributes = $_POST['MbOfficialTeacher'];
           
			 
            $f = new Functions;
            $user->user_mun=$f->getNewMunRegYear(MbUsertype::schoolType,MbUsertype::schoolFlag,$model->school_year);
            $user->user_type = MbUserType::schoolType;
            $user->user_password = $f->getNewPass();	  
            $user->save(FALSE);
              
            if ($model->school_kadda == '')
                $model->school_kadda = 26;
            //print_r($model);die();
            $sql = "insert into mb_school(year,school_name, school_ename,mouha_id, school_kadda,school_city,school_street,
                school_email,school_phone,school_extraphone,school_flag,school_fax,school_pobox,school_user)
                values(20".$model->school_year .",'" . $model->school_name . "','" . $model->school_ename . "',". $model->mouha_id . "," . $model->school_kadda . ",'" .
                    $model->school_city . "','" . $model->school_street . "','" . $model->school_email . "','" .
                    $model->school_phone . "','" . $model->school_extraphone . "',2,'" . $model->school_fax . "','" .
                    $model->school_pobox . "'," . $user->user_id . ")";
            $query = Yii::app()->db->createCommand($sql);
            $query->execute();
            //print_r($schoolManager);die();
            $school = MbSchool::model()->findByAttributes(array('school_user' => $user->user_id));
            $sql2 = "insert into mb_school_manager(smanager_school, smanager_fname, smanager_lname,smanager_ename,smanager_sex,
                smanager_email,smanager_phone,smanager_flag)
                values(" . $school->school_id . ",'" . $schoolManager->smanager_fname . "','" . $schoolManager->smanager_lname . "','" .
                    $schoolManager->smanager_ename . "','" . $schoolManager->smanager_sex . "','" . $schoolManager->smanager_email . "','" .
                    $schoolManager->smanager_phone . "',2)";
            $query2 = Yii::app()->db->createCommand($sql2);
            $query2->execute();
            //print_r($officialTeacher);die();
            $sql3 = "insert into mb_official_teacher(oteacher_school, oteacher_fname, oteacher_lname,oteacher_sex,oteacher_description,
                oteacher_mobile,oteacher_email,oteacher_ename,oteacher_flag,oteacher_user)
                values(" . $school->school_id . ",'" . $officialTeacher->oteacher_fname . "','" . $officialTeacher->oteacher_lname . "','" .
                    $officialTeacher->oteacher_sex . "','" . $officialTeacher->oteacher_description . "','" . $officialTeacher->oteacher_mobile . "','" .
                    $officialTeacher->oteacher_email . "','" . $officialTeacher->oteacher_ename . "',2," . $user->user_id . ")";
            $query3 = Yii::app()->db->createCommand($sql3);
            $query3->execute();
            $bolReset=true;
            //$this->redirect(array('MbSchool/completeReg'));
            //$this->redirect(array('archive'));
        }
                       if($bolReset==true){
                       $model = new MbSchool;
                       $schoolManager = new MbSchoolManager;
                       $officialTeacher = new MbOfficialTeacher;
                       
                       }
        $this->render('archive', array(
            'model' => $model,
            'schoolManager' => $schoolManager,
            'officialTeacher' => $officialTeacher,
        ));
    }
    
    
    
        
    public function actionInviteJudge() {
        $current= Mobarat::getOpenMobaratRecord();
        $this->render('invitejudge', array(
            'mobarat'=>$current));
    }
    
    public function actionReportPersonMainCheck(){
        $current= Mobarat::getOpenMobaratRecord();
        $mainQuery="FROM person ,(select @r :=0)as t
                    where not person_id in (select judge_personid from person_judge where judge_registrationStep='03' and mobarat_year=".($current['mobarat_year']).")
                    and person_fname like '%".$_POST['fname']."%'"
                . " and person_lname like '%".$_POST['lname']."%'";
        if($_POST['fathername']!=''){
            $mainQuery .=" and Person_mname like '%".$_POST['fathername']."%'";
        }
        if($_POST['searchall']=='true'){
            $mainQuery .=" and person_id in (select judge_personid from person_judge)";
        }
        //echo $mainQuery;return;
        $countQuery="select count(person.person_id) ". $mainQuery;
        
        //$count=Yii::app()->getDB()->createCommand($countQuery)->queryScalar();
        
        $query="SELECT @r := @r+1 AS id, person.person_id,Person_fname,Person_mname,person_lname,person_email1"
                . ",Person_email1  ".
                            $mainQuery;//.' limit '.$_POST['lmt'].' offset '.$_POST['oft'];
      
        if($_POST['showall']=='true')
           $limit='all';// ( isset( $_POST['limit'] ) ) ? $_POST['limit'] : 15;
        else
            $limit=15;
        //echo $limit;return;
         
        $page       = ( isset( $_POST['page'] ) ) ? $_POST['page'] : 1;
        $links      =5;// ( isset( $_POST['links'] ) ) ? $_POST['links'] : 7;
        
        /*$para=array('page'=>$page,'showall'=>$_POST['showall'],'prjid'=>$_POST['prjid'],'fname'=>$_POST['fname']
                    ,'lname'=>$_POST['lname'],'school'=>$_POST['school'],'myear'=>$_POST['myear']);
       */
        $para=$_POST;
        $para['page']=$page;
        //$para['showall']=$page;
        $clspaginator=new cls_Paginator($countQuery,$query,$para,CController::createAbsoluteUrl('Admin/reportpersonmaincheck'),'fill_table');
        $pers    = $clspaginator->getData(  $limit ,$page);
          {
             echo $this->renderpartial('/admin/reportpersonmaincheck',array('pers'=>$pers,'clspaginator'=>$clspaginator,'links'=>$links),FALSE,TRUE);
         }        
           
    }
    
    
    public function actionSendJudgeInvitationAll(){
        $current= Mobarat::getOpenMobaratRecord();
//        $query="select person_id, Person_fname ,Person_mname ,Person_lname, Person_userID,Person_email1,Person_sex 
//                    ,(select code_name  from codes where code_kind=102 and code_no=Person_Salutation) as Person_Salutation
//                    FROM person 
//                    where not person_id in (select judge_personid from person_judge where judge_registrationStep='03' and mobarat_year=".($current['mobarat_year']).")"
//                . " and person_fname like '%".$_POST['fname']."%'"
//                . " and person_lname like '%".$_POST['lname']."%'";
                $query="select person_id, Person_fname ,Person_mname ,Person_lname, Person_userID,Person_email1,Person_sex 
                    ,(select code_name  from codes where code_kind=102 and code_no=Person_Salutation) as Person_Salutation
                    ,user_password,user_mun
                    FROM person inner join user on user_id=Person_userID
                    where not person_id in (select judge_personid from person_judge where judge_registrationStep='03' and mobarat_year=".($current['mobarat_year']).")"
                . " and person_fname like '%".$_POST['fname']."%'"
                . " and person_lname like '%".$_POST['lname']."%'";
        //echo "asdasdasdasd";return;
        if($_POST['fathername']!=''){
            $query .=" and Person_mname like '%".$_POST['fathername']."%'";
        }
        if($_POST['searchall']=='true'){
            //$query .=" and person_id in (select judge_personid from person_judge )";
            $query .=" and person_id in (select judge_personid from person_judge where  mobarat_year=". ($current['mobarat_year']-1) ." )";
        } 
       // echo $query;return;
        return $this->sendJudgeInvitationMail($query);
    }
    
    private function sendJudgeInvitationMail($query){
       
        $data="";
        $succeed=true;
       // echo $query;return;
        $current= Mobarat::getOpenMobaratRecord();
        $pers=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        // echo count($pers);return;
       
        //
        // echo 'لقد تم إرسال دعوات للأفراد : ';
        //$qu="select  firstDayJudge, secondDayJudge  FROM mobarat where mobarat_year=".$current['mobarat_year'];
        //$mbrs=Yii::app()->getDB()->createCommand($qu)->queryAll(true);
       //  echo count($mbrs);return;
        foreach ($pers as $per) {
            if(strlen($per['Person_email1'])>0){
                 // echo "ioooioi";
                //echo $per['Person_email1'];return;
                //$data .='<br>,'. $per['person_id'];//.', '.$per['Person_fname'].', '.$per['Person_mname'].', '.$per['Person_lname'];
                  $query="INSERT INTO person_judge(judge_personid,mobarat_year,judge_registrationStep,date_inserted,date_step01,count_mailinvite_sended,date_lastmailinvite_sended)
                    values(". $per['person_id']. ", ". $current["mobarat_year"]." ,'01',now(),now(),1,now())
                    on duplicate key update judge_registrationStep='01';";
                    $cmd = Yii::app()->db->createCommand($query);
                    $cmd->execute();
           
           
 
            
//                if (is_null($per['Person_userID']))
//                {
//                    //echo 'asdasdasd';
//                    $user=  User::insertNew($current['mobarat_year'],'02','12');
//                    $query="UPDATE person SET Person_userID=" . $user->user_id ." WHERE person_id =". $per['person_id'];
//                    $cmd = Yii::app()->db->createCommand($query);
//                     $cmd->execute();
//                    //echo 'zzzz'. $user->user_id.'zzzz';
//                    //echo '<br>'.$query.'<br>';
//                }
//                else 
//                {
//                    $user = User::model()->findByPk( $per['Person_userID']);
//                }
                    

  //echo $data;return;  
              
                //$subMUN = substr($user['user_mun'], 2);
$subMUN = substr($per['user_mun'], 2);
                $email = $per['Person_email1'];
                if(is_null($per['Person_Salutation'])){
                     $salutation='الاستاذ';
                }else{
                     $salutation=$per['Person_Salutation'];
                }
                $sex='03';
                if(!is_null($per['Person_sex'])){
                    $sex=$per['Person_sex'];
                }
              
                $salutation.=(($sex=='02')?"ة":($sex=='03')?"/ة":"");
                //$msg_st=$this->getMessageInviteJudge($per['Person_fname'],$per['Person_lname'],$salutation,$sex,$subMUN,$user['user_password'],$current['mobarat_year'], $current['firstDayJudge'], $current['secondDayJudge']);
                $msg_st=$this->getMessageInviteJudge($per['Person_fname'],$per['Person_lname'],$salutation,$sex,$subMUN,$per['user_password'],$current['mobarat_year'], $current['firstDayJudge'], $current['secondDayJudge']);
                  
                $clsEmail=new cls_EMail();
                $clsEmailAddress=new cls_EMailAddress($email, $per['Person_fname'] . " " . $per['Person_lname']);
                //$data.=$msg_st;
                if($clsEmail->sendEMailWithStatic('مباراة العلوم '. $current["mobarat_year"],$msg_st,$clsEmailAddress)===true)
                {
                    $data .='<br>,'. $per['person_id'];
                   // echo "<script> alert(\"You will recive an email\")</script>";
                   $query="update person_judge set count_mailinvite_sended=count_mailinvite_sended+1,judge_registrationStep='01',date_lastmailinvite_sended=now() where mobarat_year=2019 and judge_personid=". $per['person_id'];
                    $cmd = Yii::app()->db->createCommand($query);
                    $cmd->execute();
                }
                else {
                    //echo "<script> alert(\"An error occurs when sending the mail\")</script>";
                    $succeed=false;
                }
  
            }
            
               
        }
      
        //echo $data;
       // if($succeed==true){
           echo $data;
        //}
       // else{
           // echo -1;
        //}
            
        
           //echo $ids;
    }
    
    public function actionSendJudgeInvitation(){
        
       
        $ids=$_POST['ids'];
         //echo "asdas";return;
        $ids=substr($ids,1);
        $ids=substr($ids,0,strlen($ids)-1);
        $ids= str_replace('][', ', ', $ids);
        
       // echo $ids;
        
        
        /*$query="INSERT INTO person_judge(judge_personid,mobarat_year,judge_registrationStep)
                select person_id, ". $current["mobarat_year"]." ,'01'  from  person where person_id in (".$ids.")
                on duplicate key update judge_registrationStep='01';";
        
        $cmd = Yii::app()->db->createCommand($query);*/
        
        $query="select person_id, Person_fname ,Person_mname ,Person_lname, Person_userID,Person_email1,Person_sex 
                ,(select code_name  from codes where code_kind=102 and code_no=Person_Salutation) as Person_Salutation
                ,user_password,user_mun
                from  person left join user on user_id=Person_userID
                where person_id in (".$ids.")" ;
        
        return $this->sendJudgeInvitationMail($query);
        
    }
    
    private function getMessageInviteJudge($fname,$lname,$salutation,$sex,$subMUN,$password,$mobarat_year,$firstDay,$secondDay){
        $ta3='';
        if ($sex=='02')
            $ta3='ة';
        else if($sex=='03')
            $ta3='/ة';
//        $msg_st="<table dir='rtl' cellpadding='10' style='border:1px solid black;border-collapse:collapse;'>
//                    <th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
//                            <tr ><td ><p align='right'><font color='#4b8df8'>جانب ". $salutation."  <b>" . $fname." ".$lname."</b> المحترم".$ta3.", </font></p></td></tr>
//                            <tr > <td><p align='right'>نشكركم على تعاونكم مع الهيئة الوطنية للعلوم والبحوث لإنجاح رسالتها ودورها الريادي في تحفيز التفكير العلمي وتعميم الاهتمام بالثقافة العلمية، ونضعكم في جو التحضيرات القائمة للسنوية الخامسة عشرة لمباراة العام ".$mobarat_year." </p></td></tr>
//                            <tr > <td><p align='right'>تفتتح فعاليات السنوية السادسة عشرة لمباراة العام ".$mobarat_year."، يوم ".$firstDay."، وتنتهي باحتفال ختامي يوم السبت في 13 نيسان. وتستمر عمليات التحكيم يومي الخميس ".$firstDay." والجمعة " .$secondDay."، طوال اليومين، ويتخللها غداء لأعضاء هيئة التحكيم بين الساعة الواحدة والثانية ظهراً. </p></td></tr>
//                            <tr > <td><p align='right'> نذكركم بإمكانية المساهمة بفترة تحكيم صباحية أو بعد الظهر، أو الفترتين، في اليوم الأول أو في اليوم الثاني أو في اليومين، بحسب وقتكم المتاح. </p></td></tr>
//                            <tr > <td><p align='right'>الرجاء الدخول الى الموقع التالي وتعبئة الاستمارة المطلوبة: </p></td></tr> 
//                             <tr bgcolor='#E0E0E0'><td><p align='right'><font color='#4b8df8'><b>" . Yii::app()->createAbsoluteurl("/site/login"). "</b></font></p></td></tr>
//                            <tr><td><p align='right'><font color='#4b8df8'><b> MUN : " . $subMUN . "</b></font> </p></td></tr>
//                            <tr bgcolor='#E0E0E0'><td><p align='right'>كلمة المرور : <font color='#4b8df8'><b>" . $password . "</b></font></p></td></tr>
//                            <tr><td><p align='right'> نثمنّ مشاركتكم هيئة التحكيم في <b>مباراة العلوم</b>، ونشكر تطوعكم وإسهامكم في هذا العمل النهضوي العلمي الوطني الكبير.</p></td></tr>
//                            <tr > <td><p align='right'>وتفضلوا بقبول كل المحبة والشكر والاحترام. </p></td></tr> 
//                            <tr > <td><p align='right'>منسقة ملف التحكيم في مباراة العلوم </br><b>الدكتورة سيرين طالب</b></p></td></tr> 
//                            <tr > <td><p align='right'>للتواص هاتف   03038463  </br><b>بريد staleb@nasr.org.lb</b></p></td></tr> 
//
//                    </table>";
        
 /*              
$msg_st="<table dir='rtl' cellpadding='10' style='border:1px solid black;border-collapse:collapse;'>
                    <th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
                            <tr ><td ><p align='right'><font color='#4b8df8'>جانب ". $salutation."  <b>" . $fname." ".$lname."</b> المحترم".$ta3.", </font></p></td></tr>
							<tr > <td><p align='left' dir='ltr' >(English Below)</p></td></tr>
                            <tr > <td><p align='right'>نشكركم على تعاونكم مع الهيئة الوطنية للعلوم والبحوث لإنجاح رسالتها ودورها الريادي في تحفيز التفكير العلمي وتعميم الاهتمام بالثقافة العلمية، ونضعكم في جو التحضيرات القائمة للسنوية التاسعة عشر لمباراة العام  ".$mobarat_year." </p></td></tr>
                            <tr > <td><p align='right'>تفتتح فعاليات السنوية  التاسعة عشر لمباراة العام 2022، يوم 31-03-2022، وتستمر عمليات التحكيم يومي الخميس 31-03-2022 والجمعة 01-04-2022، طوال اليومين.</p></td></tr>
                            <tr > <td><p align='right'>نذكركم بإمكانية المساهمة بفترة تحكيم حسب وقتكم المتاح خلال هذين اليومين.  </p></td></tr>
                            <tr > <td><p align='right'>عملية التحكيم ستتم عن بعد عبر الإنترنت عبر برنامج Microsoft Teams حيث سيطلب منكم مشاهدة فيديو مصور مسبقاً من قبل كل فريق مشارك. مدة الفيديو ستكون 7 دقائق كحد أقصى. بالإضافة إلى الفيديو، سيرفق التلاميذ poster يوضح مشروعهم. سوف يكون بإمكانكم طرح الأسئلة على التلاميذ حول مشروعهم إما عبر طباعة السؤال أو إرساله شفهياً عبر برنامج Microsoft Teams وعلى التلاميذ أن يقوموا بالإجابة على اسئلتكم قبل انتهاء فترة التحكيم.</p></td></tr> 
                            <tr > <td><p align='right'>بالإضافة إلى ذلك، سنقوم بإعداد جدول زمني يكون فيه لكل فريق فترة زمنية محددة يمكنك خلالها التحدث مباشرة مع الطلاب لمناقشة أي فكرة أو طرح الأسئلة) إذا كان وقتك متاحًا خلال هذه الفترة الزمنية (.  </p></td></tr>
                            <tr > <td><p align='right'> سوف نقوم لاحقاً بإرسال دليل يساعدكم على استخدام برنامج Miscrosoft Teams لمشاهدة الفيديوهات بالإضافة إلى دليل عن كيفية وضع العلامات على برنامج التحكيم.  </p></td></tr>
                            <tr > <td><p align='right'>  بالنسبة لبعض الأوقات والمهل: </p></td></tr>
                            <tr > <td> <ul> <li><p align='right'> تبدأ فترة التحكيم مع بداية يوم الخميس 31-03-2022  </p></li>
                                  <li><p align='right'> آخر مهلة لطرح الأسئلة هي نهار الجمعة 01-04-2022 الساعة الرابعة بعد الظهر  </p></li>
                                  <li><p align='right'> آخر مهلة لوضع العلامات للمشاريع هي مساء الجمعة 01-04-2022 الساعة 12 منتصف الليل. </p></li></ul></td></tr>
							<tr > <td><p align='right'> الرجاء الدخول الى الموقع التالي وتعبئة الاستمارة المطلوبة حيث سيطلب منكم تحديد ما إذا كنتم ستشاركون في عملية التحكيم هذا العام وتعديل بعض بياناتكم الشخصية حتى نتمكن من توزيع المشاريع حسب اختصاصكم: </p></td></tr>
                            <tr > <td><p align='right'> </p></td></tr>
                            <tr bgcolor='#E0E0E0'><td><p align='right'><font color='#4b8df8'><b>" . Yii::app()->createAbsoluteurl("/site/login"). "</b></font></p></td></tr>
                            <tr><td><p align='right'><font color='#4b8df8'><b> MUN : " . $subMUN . "</b></font> </p></td></tr>
                            <tr bgcolor='#E0E0E0'><td><p align='right'>كلمة المرور : <font color='#4b8df8'><b>" . $password . "</b></font></p></td></tr>
                            <tr><td><p align='right'> نثمنّ مشاركتكم هيئة التحكيم في <b>مباراة العلوم</b>، ونشكر تطوعكم وإسهامكم في هذا العمل النهضوي العلمي الوطني الكبير.</p></td></tr>
                            <tr > <td><p align='right'>وتفضلوا بقبول كل المحبة والشكر والاحترام. </p></td></tr> 
                            <tr > <td><p align='right'>منسقة ملف التحكيم في مباراة العلوم </br><b>الدكتورة سيرين طالب</b></p></td></tr> 
                            <tr > <td><p align='right'>للتواصل هاتف   03038463  </p><p align='right'><b>بريد staleb@nasr.org.lb</b></p></td></tr> 
                            <tr > <td><p align='right'>  إذا وصل هذا البريد عن طريق الخطأ يرجى حذفه. </p></td></tr>


                    </table>";*/
/*							<tr > <td><p align='left' dir='ltr' >We thank you for your cooperation with the National Association for Science and Research (NASR) to make its mission a success and we would like to inform you about the ongoing preparations for the eighteenth year of the ".$mobarat_year." Mobarat El Oloum.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >The eighteenth annual events of the 2021 Mobarat El Oloum will open on 20-05-2021, and the judging processes will continue on Thursday 20-05-2021 and Friday 21-05-2021, throughout the two days.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >We remind you that you can contribute in the judging process according to your available time during any of these two days.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >The judging process will take place remotely via the Internet via Microsoft Teams, where you will be asked to watch a pre-filmed video by each participating team. The duration of the video will be a maximum of 7 minutes. In addition to the video, students will add a poster explaining their project. You will be able to ask questions to students about their project, either by printing the question or sending it orally via Microsoft Teams, and the students must answer your questions before the judging period ends.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >In addition, we will set up a schedule in which each team will have a specific time slot during which you can speak directly with students to discuss any idea or ask questions (if your time is available during this time slot).</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >Later, we will send you a guide to help you use the Microsoft Teams program to watch the videos, as well as a guide on how to access the judging system to put grades.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >Some times and deadlines:</p></td></tr>
							<tr > <td> <ul> <li><p align='left' dir='ltr' >The judging period begins with the beginning of Thursday 20-05-2021 </p></li>
                                  <li><p align='left' dir='ltr' > The last deadline for asking questions is Friday 21-05-2021 at 4 pm </p></li>
                                  <li><p align='left' dir='ltr' > The deadline for marking projects is Friday evening 21-05-2021 at 12 midnight. </p></li></ul></td></tr>
							<tr > <td><p align='left' dir='ltr' >Please go to the following website and fill out the required form, where you will be asked to choose whether you will be able to participate in the judging process this year and to amend some of your personal data so that we can distribute the projects according to your specialization:</p></td></tr>
							<tr bgcolor='#E0E0E0'><td><p align='left' dir='ltr'><font color='#4b8df8'><b>" . Yii::app()->createAbsoluteurl("/site/login"). "</b></font></p></td></tr>
                            <tr><td><p align='left' dir='ltr'><font color='#4b8df8'><b> MUN : " . $subMUN . "</b></font> </p></td></tr>
                            <tr bgcolor='#E0E0E0'><td><p align='left' dir='ltr'>password : <font color='#4b8df8'><b>" . $password . "</b></font></p></td></tr>
							<tr > <td><p align='left' dir='ltr' >We appreciate your participation in the jury of Mobarat El Oloum, and we thank your volunteering and contribution to this mission.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >Please accept all thanks and respect.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >Scientific Committee Coordinator, Dr. Sirine Taleb</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >To contact us at 009613038463</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >Mail: staleb@nasr.org.lb</p></td></tr>
 */
    $msg_st="<table dir='rtl' cellpadding='10' style='border:1px solid black;border-collapse:collapse;'>
                    <th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
                            <tr ><td ><p align='right'><font color='#4b8df8'>نشكركم على تعاونكم مع الهيئة الوطنية للعلوم والبحوث لإنجاح رسالتها ودورها الريادي في تحفيز التفكير العلمي وتعميم الاهتمام بالثقافة العلمية، ونضعكم في جو التحضيرات القائمة للسنوية العشرين لمباراة العام ".$mobarat_year." </font></p></td></tr>
							<tr > <td><p align='left' dir='ltr' >(English Below)</p></td></tr>
                            <tr > <td><p align='right'>تفتتح فعاليات السنوية العشرين لمباراة العام 2023، يوم 2023-03-15، وتستمر عمليات التحكيم أيام الأربعاء 2023-03-15 والخميس 16-03-2023 والجمعة 2023-03-17، طوال الأيام الثلاثة. </p></td></tr>
                            <tr > <td><p align='right'>نذكركم بإمكانية المساهمة بفترة تحكيم حسب وقتكم المتاح خلال هذه الأيام.</p></td></tr>
                            <tr > <td><p align='right'>عملية التحكيم ستتم عن بعد عبر الإنترنت عبر برنامج Microsoft Teams حيث سيطلب منكم مشاهدة فيديو مصور مسبقاً من قبل كل فريق مشارك. مدة الفيديو ستكون 3 دقائق كحد أقصى. بالإضافة إلى الفيديو، سيرفق التلاميذ poster يوضح مشروعهم. سوف يكون بإمكانكم طرح الأسئلة على التلاميذ حول مشروعهم إما عبر طباعة السؤال أو إرساله شفهياً عبر برنامج Microsoft Teams وعلى التلاميذ أن يقوموا بالإجابة على اسئلتكم قبل انتهاء فترة التحكيم.</p></td></tr>
                            <tr > <td><p align='right'>سوف نقوم لاحقاً بإرسال دليل يساعدكم على استخدام برنامج Miscrosoft Teams لمشاهدة الفيديوهات بالإضافة إلى دليل عن كيفية وضع العلامات على برنامج التحكيم.</p></td></tr>
                            <tr > <td><p align='right'>بالنسبة لبعض الأوقات والمهل:</p></td></tr>
                            <tr > <td><ul> <li><p align='right'> تبدأ فترة التحكيم مع بداية يوم الأربعاء 15-03-2023</p></li>
                            <li><p align='right'>آخر مهلة لطرح الأسئلة هي نهار الجمعة 17-03-2023 الساعة التاسعة صباحاً</p></li>
                            <li><p align='right'>آخر مهلة لوضع العلامات للمشاريع هي بعد ظهر الجمعة 17-03-2023 الساعة 2 بعد الظهر.</p></li></ul></td></tr>
                            <tr > <td><p align='right'>الرجاء الدخول الى الموقع التالي وتعبئة الاستمارة المطلوبة حيث سيطلب منكم تحديد ما إذا كنتم ستشاركون في عملية التحكيم هذا العام وتعديل بعض بياناتكم الشخصية حتى نتمكن من توزيع المشاريع حسب اختصاصكم:</p></td></tr>
                            <tr bgcolor='#E0E0E0'><td><p align='right'><font color='#4b8df8'><b>" . Yii::app()->createAbsoluteurl("/site/login"). "</b></font></p></td></tr>
                            <tr><td><p align='right'><font color='#4b8df8'><b> MUN : " . $subMUN . "</b></font> </p></td></tr>
                            <tr bgcolor='#E0E0E0'><td><p align='right'>كلمة المرور : <font color='#4b8df8'><b>" . $password . "</b></font></p></td></tr>
                            <tr > <td><p align='right'>نقدر تلقي ردودكم عبر تعبئة المعلومات على الموقع المذكور بحلول يوم الإثنين 13-03-2023</p></td></tr>
                            <tr><td><p align='right'> نثمنّ مشاركتكم هيئة التحكيم في <b>مباراة العلوم</b>، ونشكر تطوعكم وإسهامكم في هذا العمل النهضوي العلمي الوطني الكبير.</p></td></tr>
                            <tr > <td><p align='right'>وتفضلوا بقبول كل المحبة والشكر والاحترام. </p></td></tr> 
                            <tr > <td><p align='right'>منسقة ملف التحكيم في مباراة العلوم </br><b>الدكتورة سيرين طالب</b></p></td></tr> 
                            <tr > <td><p align='right'>للتواصل هاتف   03038463  </p><p align='right'><b>بريد staleb@nasr.org.lb</b></p></td></tr> 
                            <tr > <td><p align='right'>  إذا وصل هذا البريد عن طريق الخطأ يرجى حذفه. </p></td></tr>


                    
							<tr > <td><p align='left' dir='ltr' >We thank you for your cooperation with the National Association for Science and Research (NASR) to make its mission a success and we would like to inform you about the ongoing preparations for the twentieth year of the 2023 Mobarat El Oloum.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >The twentieth annual events of the 2023 Mobarat El Oloum will open on 15-03-2023, and the judging processes will continue on Wednesday 15-03-2023, Thursday 16-03-2023 and Friday 17-03-2023, throughout the three days.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >We remind you that you can contribute in the judging process according to your available time during any of these three days.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >The judging process will take place remotely via the Internet via Microsoft Teams, where you will be asked to watch a pre-filmed video by each participating team. The duration of the video will be a maximum of 3 minutes. In addition to the video, students will add a poster explaining their project. You will be able to ask questions to students about their project, either by printing the question or sending it orally via Microsoft Teams, and the students must answer your questions before the judging period ends.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >Later, we will send you a guide to help you use the Microsoft Teams program to watch the videos, as well as a guide on how to access the judging system to put grades.</p></td></tr>							
							<tr > <td><p align='left' dir='ltr' >Some times and deadlines:</p></td></tr>
							<tr > <td> <ul> <li><p align='left' dir='ltr' >The judging period begins with the beginning of Wednesday 15-03-2023 </p></li>
                                  <li><p align='left' dir='ltr' > The last deadline for asking questions is Friday 17-03-2023 at 9 am </p></li>
                                  <li><p align='left' dir='ltr' >The deadline for marking projects is Friday 17-03-2023 at 2 pm (afternoon). </p></li></ul></td></tr>
							<tr > <td><p align='left' dir='ltr' >Please go to the following website and fill out the required form, where you will be asked to choose whether you will be able to participate in the judging process this year and to amend some of your personal data so that we can distribute the projects according to your specialization:</p></td></tr>
							<tr bgcolor='#E0E0E0'><td><p align='left' dir='ltr'><font color='#4b8df8'><b>" . Yii::app()->createAbsoluteurl("/site/login"). "</b></font></p></td></tr>
                            <tr><td><p align='left' dir='ltr'><font color='#4b8df8'><b> MUN : " . $subMUN . "</b></font> </p></td></tr>
                            <tr bgcolor='#E0E0E0'><td><p align='left' dir='ltr'>password : <font color='#4b8df8'><b>" . $password . "</b></font></p></td></tr>
							<tr > <td><p align='left' dir='ltr' >We appreciate your participation in the jury of Mobarat El Oloum, and we thank your volunteering and contribution to this mission.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >Please accept all thanks and respect.</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >Scientific Committee Coordinator, Dr. Sirine Taleb</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >To contact us at 009613038463</p></td></tr>
							<tr > <td><p align='left' dir='ltr' >Mail: staleb@nasr.org.lb</p></td></tr>
                 </table>";
        return $msg_st;
    }
    public function actionSendJudgeInvitationInput(){
       
        $current= Mobarat::getOpenMobaratRecord();
        if(isset($_POST['fname']) && $_POST['lname'] && $_POST['email']){
           //   echo  'يرجى تعبئdfdfة كافة الحقول';return;
            //$query="select  firstDayJudge, secondDayJudge  FROM mobarat where mobarat_year=".$current['mobarat_year'];
            //$mbrs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
//           
//            
//                      
              $user=  User::insertNew($current['mobarat_year'],'02','12');
            $query="insert into person(Person_fname,Person_lname,Person_userID,Person_email1)
                        values('".$_POST['fname']."','".$_POST['lname']."',".$user->user_id.",'".$_POST['email']."');
                    set @max=LAST_INSERT_ID();
                    insert into person_judge(judge_personid,mobarat_year,judge_registrationStep,date_inserted,date_step01,count_mailinvite_sended,date_lastmailinvite_sended)
                        values(@max,".$current["mobarat_year"].",'01',now(),now(),1,now());
                    set @judgeid=LAST_INSERT_ID();";
                    /*insert into judge_type(person_id,judge_id,mobarat_year,project_type,type_enable,type_kernel)
                        select @max,@judgeid,".$current["mobarat_year"].",code_no ,0,0
                        from mobarat_code where  mobarat_year=".$current["mobarat_year"]." and code_kind=111 and code_Enable=1;"
                    . "insert into judge_selecting(person_id,judge_id,mobarat_year,select_no,select_enable)
                        select @max,@judgeid,".$current["mobarat_year"].",code_no ,0
                        from mobarat_code where  mobarat_year=".$current["mobarat_year"]." and code_kind=118 and code_Enable=1;";*/
          
            $cmd = Yii::app()->db->createCommand($query);
             
            $cmd->execute();
           while($cmd->pdoStatement->nextRowSet());
            $subMUN = substr($user['user_mun'], 2);
//
            $email = $_POST['email'];
            
//            
          $data ='<br>'.$_POST['fname'].' '.$_POST['lname'];
          // echo $data;return;
            $msg_st=$this->getMessageInviteJudge($_POST['fname'],$_POST['lname'],$_POST['salutation'],'03',$subMUN,$user['user_password'],$current['mobarat_year'], $current['firstDayJudge'], $current['secondDayJudge']);
//           echo $msg_st;return;
//             //
//            //$personID= Yii::app()->db->getLastInsertId();
//             //echo $query;           return;
            $data ='<br>'.$_POST['fname'].' '.$_POST['lname'];
            
            
//            //$data.=$msg_st;
            $clsEmail=new cls_EMail();
            $clsEmailAddress=new cls_EMailAddress($email, $_POST['fname'] . " " . $_POST['lname']);
           //$msg_st='';
            $succeed=true;

            if($clsEmail->sendEMailWithStatic('Confirmation',$msg_st,$clsEmailAddress)===true)
            {
               // echo "<script> alert(\"You will recive an email\")</script>";
            }
            else {
                //echo "<script> alert(\"An error occurs when sending the mail\")</script>";
                $succeed=false;
            }

        /*}
        else{
            echo '<br>'.$query.'<br>';
            $succeed=false;
        }*/
            
           if($succeed==true){
           echo $data;
        }
        else{
            echo -1;
        }  
        }
         else {
             echo  'يرجى تعبئة كافة الحقول';
         }
         return;
    }
    
    private function getMessageOteacherSuite($fname,$lname,$salutation,$sex,$schl_name,$prjs,$mobarat_year,$Day,$hall,$suite){
        $ta3='';
        if($sex=='02'){
            $ta3='ة';
        }if($sex=='03'){
            $ta3='/ة';
            
        }
        $salutation.=$ta3;
        $msg_st="<table dir='rtl' cellpadding='10' style='border:1px solid black;border-collapse:collapse;'>
                    <th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
                            <tr ><td ><p align='right'><font color='#4b8df8'>جانب ". $salutation."  <b>" . $fname." ".$lname."</b> المحترم".$ta3.", </font></p></td></tr>
                            <tr > <td><p align='right'>نشكركم على تسجيل مدرستكم في السنوية الخامسة عشرة بمباراة العلوم ".$mobarat_year."، ونضع بين أيديكم موعد مشاركة مدرستكم على الشكل التالي:  </p></td></tr>
                            <tr > <td><p align='right'>
                                <table border='1' dir='rtl' style='border:0px solid black;border-collapse:collapse;'>
                                    <tr><td width='200'>المدرسة</td><td width='200'>".$schl_name."</td></tr>
                                    <tr><td>المكان</td><td>كلية العلوم - مجمع الجامعة اللبنانية- الحدث</td></tr>
                                    <tr><td>الزمان</td><td>".$Day."</td></tr>
                                    <tr><td>القاعة</td><td>".$hall."</td></tr>
                                    <tr><td>رقم الجناح</td><td>".$suite."</td></tr>
                                </table>
                            </p></td></tr>
                            <tr > <td><p align='right'>نرجو منكم تأكيد المعلومات المسجلة أدناه</p></td></tr>
                             <tr > <td><p align='right'>
                                <table border='1' dir='rtl' cellspacing='5px' style='border:1px solid black;'>
                                   <tr ><td width='150'><b>المشروع</b></td><td width='110'><b>المرحلة</b></td><td width='110'><b>الفئة</b></td><td width='110'><b>الاستاذ المشرف</b></td><td width='110'><b>أسماء الطلاب</b></td></tr>";
        foreach ($prjs as $prj) {
            $msg_st.="<tr><td>".$prj['project_name']."</td><td>".$prj['project_stage']."</td><td>".$prj['project_type']."</td><td>".$prj['teacher']."</td><td>".$prj['stds']."</td></tr>";
             //$msg_st.="<tr><td>".$prj['project_name']."</td><td>".$prj['project_stage']."</td><td>".$prj['project_type']."</td><td>".$prj['Person_fname'].' '.$prj['Person_lname']."</td><td>".$prj['stds']."</td></tr>";
        }
        
        $msg_st.="               </table>
                            </p></td></tr>
                            <tr > <td><p align='right'>كما ونرجو منكم الإطلاع على التفاصيل والتحضيرات المطلوبة قبل وخلال وبعد المعرض على دليل السنوية الخامسة عشرة لمباراة العلوم  ".$mobarat_year." </p></td></tr>
                            <tr > <td><p align='left'>للإستفسار يرجى التواصل على الأرقام التالية:</br>96 49 46 5 961+/ 62 39 59 71 961+</br> قسم التسجيل</br>مباراة العلوم ".$mobarat_year." </p></td></tr>
                            <tr bgcolor='#E0E0E0'> <td><p align='right'>موقع المباراة:  <br>   http://mobarat.nasr.org.lb </p></td></tr>
                    </table>";
        return $msg_st;
    }
    
    public function actionsendOteacherSuite($id){
        $data="";//$_POST['id'];
        $ms= MobaratSchool::model()->findByPk($id);
        $personid=$ms['oteacher_personid'];
        
        $query="select  firstDayJudge, secondDayJudge  FROM mobarat where mobarat_year=".$ms['mobarat_year'];
        $mbrs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        
        
        $query="select Person_fname,Person_lname,Person_sex,Person_Salutation,Person_email1 from person where person_id=".$personid;
        $pers=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $pers=$pers[0];
        
        $query="select school_name from school where school_id=".$ms['school_id'];
        $schl=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        $schl=$schl[0];
        
        $query="select project_name,concat(Person_fname,' ',person_lname ) as teacher
                    ,(select code_name from codes where code_kind=106 and code_no=project_stage) as project_stage
                    ,(select code_name from codes where code_kind=111 and code_no=project_type) as project_type
                    ,(select group_concat( (concat(Person_fname,' ',person_lname) ) SEPARATOR '<br>') from person as std inner join project_student on project_student.person_id=std.Person_id where project_student.project_id=project.project_id ) as stds
                    from project left join project_teacher on project.project_id=project_teacher.project_id
                    left join person on person.person_id=project_teacher.person_id
                     where school_id=".$ms['school_id']." and mobarat_year=".$ms['mobarat_year'];
        $prjs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        
        //$pers= Person::model()->findByPk($personid);
        if(is_null($pers['Person_sex'])){
              $sex='03';
        }else{
            $sex=$pers['Person_sex'];
        }
      
        if(is_null($pers['Person_Salutation'])){
            $sal= 'الاستاذ';
        }else{
            $sal= cls_codes::getCode_Name(102,$pers['Person_Salutation']);
        }
        
        $day='';
        $hall=cls_codes::getCode_Name(120,$ms['halls']);
        if($ms['date_day']=='01'){
            $day=$mbrs[0]['firstDayJudge'];
        }else if($ms['date_day']=='02'){
            $day=$mbrs[0]['secondDayJudge'];
        }
        
        $email = $pers['Person_email1'];
        $msg_st=$this->getMessageOteacherSuite($pers['Person_fname'],$pers['Person_lname'],$sal,$sex,$schl['school_name'],$prjs,$ms['mobarat_year'],$day,$hall,$ms['suite']);
        $data.=$pers['Person_fname'].' '.$pers['Person_lname'];
            $clsEmail=new cls_EMail();
            $clsEmailAddress=new cls_EMailAddress($email, $pers['Person_fname'] . " " . $pers['Person_lname']);
           
            $succeed=true;
        $ms->count_mailsuite_sended+=1;
        $ms->date_lastmailsuite_sended= new CDbExpression('NOW()');
        $ms->last_halls_sended=$ms->halls;
        $ms->last_suite_sended=$ms->suite;
        $ms->last_date_day_sended=$ms->date_day;
        $ms->save(false);
        
            if($clsEmail->sendEMailWithStatic('معلومات المشاركة',$msg_st,$clsEmailAddress)===true)
            {
                //echo "<script> alert(\"You will recive an email\")</script>";
            }
            else {
                //echo "<script> alert(\"An error occurs when sending the mail\")</script>";
                $succeed=false;
            }

            //$data .=$msg_st;
            
           if($succeed==true){
           echo $data;
        }
        else{
            echo -1;
        }  
        
        
        //echo $data;
        return ;
    }
    
    public function actionsendAllOteacherSuite(){
      // if(ERunActions::runBackground()){
        $data="";
        $succeed=true;
       //echo "asdasda";
       // echo $query;return;
        $current= Mobarat::getOpenMobaratRecord();
        $query="select mobarat_school.school_id,mobarat_schoolID, Person_email1
                    ,halls,tbhall.code_name as hall_Letter ,suite,date_day
                    ,Person_fname,Person_lname,Person_Salutation,tbsal.code_name as salutation,Person_sex ,school_name
                    from mobarat_school inner join person on person_id=oteacher_personid
                    left join school on mobarat_school.school_id=school.school_id 
                    left join codes as tbsal on tbsal.code_kind=102 and tbsal.code_no=Person_Salutation
                    left join codes as tbhall on tbhall.code_kind=120 and tbhall.code_no=halls
                    where  mobarat_year=".$current['mobarat_year']." and mobarat_school_RegistrationStep='04' and length(halls)>0 and length(suite)>0 and length(date_day)>0 ;";
        $pers=Yii::app()->getDB()->createCommand($query)->queryAll(true);

        $qu="select  firstDayJudge, secondDayJudge  FROM mobarat where mobarat_year=".$current['mobarat_year'];
        $mbrs=Yii::app()->getDB()->createCommand($qu)->queryAll(true);
        //echo 'yyy'.count($pers).'yyy';return;
        $i=0;
        foreach ($pers as $per) {
            if(strlen($per['Person_email1'])>0)
                {
                $i++;
                 // echo "ioooioi";
                //echo $per['Person_email1'];return;
                $day='';
                if($per['date_day']=='01'){
                    $day=$mbrs[0]['firstDayJudge'];
                }else if($per['date_day']=='02'){
                    $day=$mbrs[0]['secondDayJudge'];
                }
                
                $query="select project_name,concat(Person_fname,' ',person_lname ) as teacher
                    ,(select code_name from codes where code_kind=106 and code_no=project_stage) as project_stage
                    ,(select code_name from codes where code_kind=111 and code_no=project_type) as project_type
                    ,(select group_concat( (concat(Person_fname,' ',person_lname) ) SEPARATOR '<br>') from person as std inner join project_student on project_student.person_id=std.Person_id where project_student.project_id=project.project_id ) as stds
                    from project left join project_teacher on project.project_id=project_teacher.project_id
                    left join person on person.person_id=project_teacher.person_id
                     where school_id=".$per['school_id']." and mobarat_year=".$current['mobarat_year'];
                $prjs=Yii::app()->getDB()->createCommand($query)->queryAll(true);

                //$pers= Person::model()->findByPk($personid);
                $sex='';$sal='';
                if(is_null($per['Person_sex'])){
                      $sex='03';
                }else{
                    $sex=$per['Person_sex'];
                }

                if(is_null($per['Person_Salutation'])){
                    $sal= 'الاستاذ';
                } else {
                     $sal= $per['salutation'];
                }
        
                $data.="</br>".$i.' '.$per['Person_fname'].' '.$per['Person_lname'];
                $email = $per['Person_email1'];
                $msg_st=$this->getMessageOteacherSuite($per['Person_fname'],$per['Person_lname'],$sal,$sex,$per['school_name'],$prjs,$current['mobarat_year'],$day,$per['hall_Letter'],$per['suite']);

            $clsEmail=new cls_EMail();
            $clsEmailAddress=new cls_EMailAddress($email, $per['Person_fname'] . " " . $per['Person_lname']);
           
            $succeed=true;
            
            $qrTS="update mobarat_school set count_mailsuite_sended=count_mailsuite_sended+1, last_halls_sended=halls, last_suite_sended=suite,last_date_day_sended=date_day,date_lastmailsuite_sended=now() where mobarat_schoolID=".$per['mobarat_schoolID'];
            Yii::app()->getDB()->createCommand($qrTS)->execute();
            
            if($clsEmail->sendEMailWithStatic('معلومات المشاركة',$msg_st,$clsEmailAddress)==true)
            {
                //echo "<script> alert(\"You will recive an email\")</script>";
            }
            else {
                //echo "<script> alert(\"An error occurs when sending the mail\")</script>";
                //$succeed=false;
            }

           // $data .='<br>'.$msg_st;
           
           
            }
            
                
        }
       
        echo $data;
        if($succeed==true){
          // echo $data;
        }
        else{
            echo -1;
            
        }
            
        
           //echo $ids;
    }
  //  else{
  //      echo "progressing";
  //  }
   // echo "ok";
       // }
}