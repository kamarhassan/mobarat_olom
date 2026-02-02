<?php

/**
 * This is the model class for table "mobarat_school".
 *
 * The followings are the available columns in table 'mobarat_school':
 * @property integer $mobarat_schoolID
 * @property integer $mobarat_year
 * @property integer $school_id
 * @property integer $oteacher_id
 * @property integer $oteacher_personid
 * @property integer $extraProject
 * @property string $mobarat_school_RegistrationStep
 * @property string $confirmation_code
 *
 * The followings are the available model relations:
 * @property Person $oteacherPerson
 * @property Mobarat $mobaratYear
 * @property School $school
 * @property Personoteacher $oteacher
 */
class MobaratSchool extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        private $_SchoolName=null;
        private $_ShowDuplicateOnly=false;
        private $_OteacherName=null;
        private $_ProjectType=null;
       // private $_school_level=null;
	public function tableName()
	{
		return 'mobarat_school';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mobarat_year, school_id', 'required'),
			array('mobarat_year, school_id, oteacher_id, oteacher_personid, extraProject,suite,presence_assurance,is_present,count_mailconfirmcode_sended,count_mailconfirmmessage_sended', 'numerical', 'integerOnly'=>true),
			array('mobarat_school_RegistrationStep,school_Past,halls,date_day', 'length', 'max'=>2),
			array('confirmation_code', 'length', 'max'=>20),
                        array('date_step01,date_step02,date_step03,date_step04,date_lastmailconfirmcode_sended,date_lastmailconfirmmessage_sended','date'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('schoolName,mobarat_schoolID, mobarat_year, school_id, oteacher_id, oteacher_personid, extraProject, mobarat_school_RegistrationStep, confirmation_code,school_Past,halls,suite,date_day,presence_assurance,is_present,date_step01,date_step02,date_step03,date_step04,date_lastmailconfirmcode_sended,date_lastmailconfirmmessage_sended,count_mailconfirmcode_sended,count_mailconfirmmessage_sended', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'oteacherPerson' => array(self::BELONGS_TO, 'Person', 'oteacher_personid'),
			'mobaratYear' => array(self::BELONGS_TO, 'Mobarat', 'mobarat_year'),
			'school' => array(self::BELONGS_TO, 'School', 'school_id'),
			'oteacher' => array(self::BELONGS_TO, 'Personoteacher', 'oteacher_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mobarat_schoolID' => 'Mobarat School',
			'mobarat_year' => 'Mobarat Year',
			'school_id' => 'School',
			'oteacher_id' => 'Oteacher',
			'oteacher_personid' => 'Oteacher Personid',
			'extraProject' => 'Extra Project',
			'mobarat_school_RegistrationStep' => 'Mobarat School Registration Step',
			'confirmation_code' => 'Confirmation Code',
                        'halls' => 'القاعة',
			'suite' => 'الجناح',
                        'date_day'=>'اليوم',
                        'school_Past'=>'ماضي المدرسة',
                        'presence_assurance'=>'تأكيد الحضور',
                        'is_present'=>'حضور فعلي',
		);
	}
        
        public function getSchoolName(){
            if($this->_SchoolName===null && $this->school !== null){
                $this->_SchoolName= $this->school->school_name;
            }
            return $this->_SchoolName;
        }
        
        public function setSchoolName($value){
          
            $this->_SchoolName=$value;
        }
        
        public function getOteacherName(){
            if($this->_OteacherName===null && $this->oteacherPerson !== null){
                $this->_OteacherName='';
                if($this->oteacherPerson->Person_fname!=null)
                    $this->_OteacherName.= $this->oteacherPerson->Person_fname;
                if($this->oteacherPerson->Person_lname!=null)
                    $this->_OteacherName.=' '. $this->oteacherPerson->Person_lname;
            }
            return $this->_OteacherName;
        }
        
        public function setOteacherName($value){
          
            $this->_OteacherName=$value;
        }
        /*
        public function getschool_level(){
            if($this->_school_level===null && $this->school !== null){
                $this->_school_level= $this->school->school_level;
            }
            return $this->_school_level;
        }
        
        public function setschool_level($value){
          
            $this->_school_level=$value;
        }
         * */
         
        public function getShowDuplicateOnly(){
            return $this->_ShowDuplicateOnly;
        }
        
        public function setShowDuplicateOnly($value){
          
            $this->_ShowDuplicateOnly=$value;
        }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
        
        public function getProjectType(){
            return $this->_ProjectType;
        }
        
        public function setProjectType($value){
          
            $this->_ProjectType=$value;
        }
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                
                $criteria->with='school';
		$criteria->compare('mobarat_schoolID',$this->mobarat_schoolID);
		$criteria->compare('t.mobarat_year',$this->mobarat_year);
		$criteria->compare('school_id',$this->school_id);
		$criteria->compare('oteacher_id',$this->oteacher_id);
		$criteria->compare('oteacher_personid',$this->oteacher_personid);
		$criteria->compare('extraProject',$this->extraProject);
		$criteria->compare('mobarat_school_RegistrationStep',$this->mobarat_school_RegistrationStep,true);
		$criteria->compare('school_Past',$this->school_Past,true);
                $criteria->compare('confirmation_code',$this->confirmation_code,true);
                
                $criteria->compare('presence_assurance',$this->presence_assurance);
                $criteria->compare('is_present',$this->is_present);
                if($this->ShowDuplicateOnly==true){
                     $criteria->join = 'JOIN ( SELECT halls,suite FROM mobarat_school '
                             . '                where mobarat_year='. $this->mobarat_year. ' group by halls,suite having count(suite)>1) as ttt '
                             . '                on ttt.suite=t.suite and ttt.halls=t.halls';
                }else{
                    $criteria->compare('date_day',$this->date_day,true);
                    $criteria->compare('halls',$this->halls,true);
                    //$criteria->compare('school_name',$this->schoolName,true);
                    if(strlen($this->schoolName)>0){
                        $criteria->addCondition("school_name like '%". $this->schoolName ."%' " );
                    }
                    if(strlen($this->ProjectType)>0){
                         $criteria->join = "JOIN   project on project.school_id=t.school_id and project.mobarat_year=t.mobarat_year and  project.project_type='".$this->ProjectType. "'";
                    }
                }
                
               
                $sort=new CSort();
                $sort->attributes=array('schoolName'=>array('asc'=>'school.school_name','desc'=>'school.school_name desc'));

		/*return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort
		));*/
                return new CActiveDataProvider('MobaratSchool', array(
			'criteria'=>$criteria,
                        'sort'=>$sort
		));
	}
        public static function hasDuplicateSuite($my){
            $query="SELECT suite FROM mobarat_school where mobarat_school_RegistrationStep='04' and mobarat_year=".$my." group by halls,suite having count(suite)>1";

            $suite=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);
            if(count($suite)>0){
               // echo $suite[0][''];
                return true;
            }else{
                return false;
            }
        }
        public function getCountRegisterProject(){
            return  Project::getCountProjectSchool($this->mobarat_year,$this->school_id);
        }
        
        public function getRegisterProjectType(){
            return  Project::getProjectTypeSchool($this->mobarat_year,$this->school_id);
        }
        public function getInputField($fieldName){
            return @CActiveForm::textField($this,$fieldName,array( 'class' => 'form-control',"name"=>"MobaratSchool[".$this->mobarat_schoolID."][".$fieldName."]"));
        }
        
        public function getComboFieldHalls($fieldName){
            $records =Mobarat::getCodeEnable(120);// cls_codes::getCodes_ByCodeKind(111);
            $list = CHtml::listData($records, 'code_no', 'code_name');
            return @CActiveForm::dropDownList($this, $fieldName, $list, array('empty' => 'اختر القاعة', 'class' => 'form-control',"name"=>"MobaratSchool[".$this->mobarat_schoolID."][".$fieldName."]"));      
        }
        
        public function getComboFieldDay($fieldName){
            $records =Mobarat::getCodeEnable2(118,2);// cls_codes::getCodes_ByCodeKind(111);
            $list = CHtml::listData($records, 'code_no', 'code_name');
            return @CActiveForm::dropDownList($this, $fieldName, $list, array('empty' => 'اختر اليوم', 'class' => 'form-control',"name"=>"MobaratSchool[".$this->mobarat_schoolID."][".$fieldName."]"));      
        }
        
        public function getCheckBox($fieldName){
            return @CActiveForm::checkBox($this, $fieldName, array( 'class' => 'form-control',"name"=>"MobaratSchool[".$this->mobarat_schoolID."][".$fieldName."]"));      
        }
        
        public function getMail(){
            //return 123;
            return CHtml::ajaxLink('<button type="button" class="btn green"><i class=\'icon-mail-reply\'></i></button>'
                                                , array('Admin/sendOteacherSuite' ), array(
                                                   /*'update' => '#modalBody',
                                                    'complete' => 'function() {$("#basic").modal();}',*/
                                                     'success'=>'function(data) {'
                                                        . 'if(data==-1){alert("حصل خطأ أثناء إرسال البريد!");}'
                                                        . 'else {$("#Result_SendInvite").html($("#Result_SendInvite").text() + data);}}'
                                                    ,'data' => array('id' => $this->mobarat_schoolID)),
                                                    array('id' =>$this->mobarat_schoolID,'confirm' => 'هل أنت متأكد من إرسال البريد? المعلومات يجب أن يتم حفظها')
                    );
        }
        
        public function getSchoolLevelName($code_no){
            return cls_codes::getCode_Name(106, $code_no);// cls_codes::getCodes_ByCodeKind(111);
           
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MobaratSchool the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function InsertNew($my,$sid,$oid,$opid,$stp,$spast)
        {
            $columDate='date_step01';
            if($stp=='02')
                $columDate='date_step02';
           
            $query='insert into mobarat_school(mobarat_year,school_id,oteacher_id,oteacher_personid,mobarat_school_RegistrationStep,school_Past,'.$columDate.') '
                    . 'values('.$my.', '.$sid.', '.$oid.', '.$opid.', "'.$stp.'", "'.$spast.'",now()) on duplicate key update oteacher_id='.$oid.',oteacher_personid= '.$opid.',mobarat_school_RegistrationStep="'.$stp.'",school_Past="'.$spast.'",'.$columDate.'=now()';
  
            $schls=Yii::app()->getDB()->createCommand($query)->execute();
            return $schls;
        }
        public static function getCoutingConfirmedPublicSchool($my) {
            return MobaratSchool::getCoutingSchool($my,'04','01');
        }
        
        public static function getCoutingConfirmedPrivateSchool($my) {
            return MobaratSchool::getCoutingSchool($my,'04','02');
        }
        
        public static function getCoutingSchool($my,$step,$scty)
        {
            $query="select count(mobarat_school.school_id) as co from mobarat_school inner join school on school.school_id=mobarat_school.school_id "
                    ." where  school_type='".$scty."'"
                    ." and mobarat_school_RegistrationStep='".$step."'"
                    ." and mobarat_year=".$my." ;";

            $mbrs=Yii::app()->getDB()->createCommand($query)->queryScalar();
            if($mbrs!=false)
                return $mbrs;
            else
               return 0;
        }
        
        public function getCoutingConfirmedSchoolNew($my){
            $query= "select count(sn.school_id) as co from mobarat_school as sn "
                    ." where not (sn.school_id in (select so.school_id from mobarat_school as so where so.mobarat_school_RegistrationStep='04' and so.mobarat_year=".($my-1).")) "
                    ." and   sn.mobarat_school_RegistrationStep='04' and sn.mobarat_year=".$my." ;";
           $mbrs=Yii::app()->getDB()->createCommand($query)->queryScalar();
            if($mbrs!=false)
                return $mbrs;
            else
               return 0;
        }
        
        public function getCoutingConfirmedSchoolNewPure($my){
            $query= "select count(sn.school_id) as co from mobarat_school as sn "
                    ." where not (sn.school_id in (select so.school_id from mobarat_school as so where so.mobarat_school_RegistrationStep='04' and so.mobarat_year!=".($my).")) "
                    ." and   sn.mobarat_school_RegistrationStep='04' and sn.mobarat_year=".$my." ;";
           $mbrs=Yii::app()->getDB()->createCommand($query)->queryScalar();
            if($mbrs!=false)
                return $mbrs;
            else
               return 0;
        }
        
        public function getCoutingConfirmedSchoolOld($my){
            $query= "select count(sn.school_id) as co from mobarat_school as sn "
                    ." where (sn.school_id in (select so.school_id from mobarat_school as so where so.mobarat_school_RegistrationStep='04' and so.mobarat_year<".($my).")) "
                    ." and   sn.mobarat_school_RegistrationStep='04' and sn.mobarat_year=".$my." ;";
           $mbrs=Yii::app()->getDB()->createCommand($query)->queryScalar();
            if($mbrs!=false)
                return $mbrs;
            else
               return 0;
        }
        public static function getPendingSchools($my){
            $query="select school.school_id,school_name,school_street,school_place,school_phone,school_Past ,concat(ifnull(ma.Person_fname,'') , ' ' , ifnull(ma.Person_lname,'')) as manager
                        ,concat(ifnull(ot.Person_fname,'') , ' ' , ifnull(ot.Person_lname,'')) as ofteacher,ot.Person_CellPhone,ot.Person_email1
                        ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,3)) as moha
                        ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,6) and length(code_no)=6) as kada
                        ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,9) and length(code_no)=9) as city
                        from school inner join mobarat_school on mobarat_school.school_id=school.school_id 
                        inner join person as ma on school_ManagerPersonID=ma.Person_id
                        inner join person as ot on oteacher_personid=ot.Person_id
                        where mobarat_school_RegistrationStep='02' and mobarat_year=".$my." ;";
            $mbrs=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);
            return $mbrs;
        }
        public static function getWaitingconfirmcodeschools($my){
            $query="select school.school_id,school_name,school_street,school_place,school_phone,school_Past, oteacher_personid ,concat(ifnull(ma.Person_fname,'') , ' ' , ifnull(ma.Person_lname,'')) as manager
                       
                        ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,3)) as moha
                        ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,6) and length(code_no)=6) as kada
                        ,(select code_name from codes where code_kind=105 and code_no= substring(school_place,1,9) and length(code_no)=9) as city
                        from school inner join mobarat_school on mobarat_school.school_id=school.school_id 
                        inner join person as ma on school_ManagerPersonID=ma.Person_id
                        where not oteacher_personid is null and mobarat_school_RegistrationStep='01' and mobarat_year=".$my." ;";
            $mbrs=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);
            return $mbrs;
        }
        public static function getCountingSchoolByStep($my,$ty)
        {
            $query="select count(school_id) as co from mobarat_school where mobarat_school_RegistrationStep='". $ty."' and mobarat_year=".$my;

            $mbrs=Yii::app()->getDB()->createCommand($query)->queryScalar();
            if($mbrs!=false)
                return $mbrs;
            else
               return 0;
        }
        public static function getCoutingPendingSchool($my) {
            return MobaratSchool::getCountingSchoolByStep($my,'02');
          
        }

        public static function getCoutingConfirmedSchool($my) {
            return MobaratSchool::getCountingSchoolByStep($my,'04');
        }
        
        public static function relateSchoolToHalls($my,$bAll){
            $query='update mobarat_school set halls=null,suite=null,date_day=null where mobarat_school_RegistrationStep="04" and mobarat_year='.$my;
            if($bAll==false){
                $query.=' and (halls is null or suite is null or date_day is null or length(date_day)=0 or length(halls)=0)';
            }
            Yii::app()->getDB()->createCommand($query)->execute();

            $query="select code_no from mobarat_code where code_kind=118 and length(code_no)=2 and mobarat_year=".$my." ;";
            $days=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);
            
            $query="select hall_code_no, suite_total,suite2_desc from  mobarat_halls where mobarat_year=".$my." ;";
            $halls=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);


            /*$query="SELECT mobarat_schoolID,school.school_id,school_level
                    FROM  school inner join mobarat_school on school.school_id=mobarat_school.school_id
                    where (school_level='01' or school_level='02') and mobarat_school_RegistrationStep='04' and mobarat_year=".$my." ;";
            $mschls=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);*/
            //echo $bAll."; ";
            $b2=MobaratSchool::relate($bAll,true,$my,$days,$halls);
            
            $b1=MobaratSchool::relate($bAll,false,$my,$days,$halls);
            //return;
            //return;
            /*$query="SELECT mobarat_schoolID,school.school_id,school_level
                    FROM  school inner join mobarat_school on school.school_id=mobarat_school.school_id
                    where (school_level='03' ) and mobarat_school_RegistrationStep='04' and mobarat_year=".$my." ;";
            $mschls=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);*/
            
            
            //return;
            //return;
            $msg='';
            if($b1==false){
                 $msg='هناك نقص في أجنحة المشاريع عدد واحد';
            }if($b2==false){
                if($b1==true)
                    $msg.='<br>';
                 $msg.='هناك نقص في أجنحة المشاريع عدد إثنان';
            }
           
            return $msg;
            //$mschls->saveall();
            
            
            
        }
        private static function relate($bAll,$blist2,$my,$days,$halls){
            
            $daycounter=0;
            $hallcounter=0;
            $suite1counter=0;
            //echo $bAll."; ";
            //echo "sdsd";return;
            $query1="SELECT mobarat_schoolID,school.school_id,school_level
                    FROM  school inner join mobarat_school on school.school_id=mobarat_school.school_id
                    where presence_assurance=1 and  mobarat_school_RegistrationStep='04' and mobarat_year=".$my;

            $list= Mobarat::getListSuite2desc($halls[$hallcounter]['suite2_desc']);
           // echo implode(", ",$list);return;
            //echo implode(", ", $list);return;
            // return false;
            
            $query1.=" and (select count(project_id) from project where mobarat_year=".$my." and project.school_id=school.school_id)=";
            if($blist2==false){
                //$query1=$query. " and (school_level='01' or school_level='02')";
                $query1.="1 ";
                $list= Mobarat::getListSuite1($list, $halls[$hallcounter]['suite_total']);
            }else{
                //$query1=$query. " and (school_level='03')";
                $query1.="2 ";
               
            }
            //return count($list);
            if(count($list)>0 && strlen(trim($list[0]))>0){
                if($bAll==false){
                    $query1=$query1.' and (halls is null or suite is null or date_day is null )';

                    //echo implode(", ",$list);
                    //return;
                }
                $query1.=' order by mobarat_schoolID';
                Mobarat::getListSuiteEmpty($list,$my,$days[$daycounter]['code_no'],$halls[$hallcounter]['hall_code_no']);
                $mschls=Yii::app()->getDB()->createCommand($query1)->queryAll(TRUE);

                if(MobaratSchool::checkcounter($bAll,$blist2,$my,$daycounter,$hallcounter,$suite1counter,$days,$halls,$list)==true){
                    for($i=0;$i<count($mschls);$i++){
                        $suiteno=$days[$daycounter]['code_no']*1000+$list[$suite1counter];
                        $query="update mobarat_school set halls='".$halls[$hallcounter]['hall_code_no']."',suite=".$suiteno.",date_day='".$days[$daycounter]['code_no']."' where mobarat_schoolID=".$mschls[$i]['mobarat_schoolID'];
                        Yii::app()->getDB()->createCommand($query)->execute();
                        $suite1counter++;
                        if(MobaratSchool::checkcounter($bAll,$blist2,$my,$daycounter,$hallcounter,$suite1counter,$days,$halls,$list)==false){
                            return false;
                        }
                    }   
                }
                return true; 
                
                 
            }else{
                return false;
            }
            
        }
        private static function checkcounter($bAll,$blist2=false,$my,&$daycounter,&$hallcounter,&$suite1counter,&$days,&$halls,&$list){
            //echo $bAll."; ".implode(", ", $list);return;
            $repeat=false;
            do{
                if($suite1counter==count($list)){
                    $suite1counter=0;
                    $hallcounter++;
                    if($hallcounter==count($halls)){
                        $hallcounter=0;
                        $daycounter++;
                        if($daycounter==count($days)){
                            return false;
                        }
                    }
                    $list2= Mobarat::getListSuite2desc($halls[$hallcounter]['suite2_desc']);
                    if($blist2==true){
                        $list=$list2;
                    }else{
                        $list= Mobarat::getListSuite1($list2, $halls[$hallcounter]['suite_total']);
                    }
                    //if($bAll==false){
                        //echo"vvbvbv";
                    
                        if(count($list)>0 && strlen(trim($list[0]))>0){
                           Mobarat::getListSuiteEmpty($list,$my,$days[$daycounter]['code_no'],$halls[$hallcounter]['hall_code_no']);
                            if(count($list)==0)
                                $repeat=true;

                        }else
                            return false;
                    //}
                }    
            }while($repeat==true);
            
            return true;
        }
}
