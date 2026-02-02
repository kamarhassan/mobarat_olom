<?php

/**
 * This is the model class for table "school".
 *
 * The followings are the available columns in table 'school':
 * @property integer $school_id
 * @property string $school_name
 * @property string $school_ename
 * @property string $school_place
 * @property string $school_street
 * @property string $school_email
 * @property string $school_phone
 * @property string $school_extraphone
 * @property string $school_fax
 * @property string $school_pobox
 * @property string $school_level
 * @property string $school_type
 * @property integer $school_oldID
 * @property integer $school_ManagerPersonID
 *
 * The followings are the available model relations:
 * @property MobaratSchool[] $mobaratSchools
 * @property Person $schoolManagerPerson
 */
abstract class enm_SchoolType{
    const SCHOOL=0;
    const OLD_SCHOOL=100;
}
class School extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'school';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('school_name, school_street, school_email,school_level, school_type, school_phone,school_country', 'required'),
			array('school_oldID, school_ManagerPersonID', 'numerical', 'integerOnly'=>true),
			array('school_name', 'length', 'max'=>250),
                        array('school_phone, school_extraphone, school_fax', 'CRegularExpressionValidator', 'pattern'=>'/^[0-9]{8,16}+$/', 'message' => '{attribute} يجب أن يكون أرقام فقط'),
			array('school_ename', 'length', 'max'=>100),
			array('school_place', 'length', 'max'=>16),
                        array('school_ename', 'CRegularExpressionValidator', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => '{attribute} يجب أن يكون باللغة الإنكليزية'),
                        array('school_name,school_street', 'CRegularExpressionValidator', 'pattern' => '/^[\s\p{Arabic}\ـ\-\َ\ً\ٌ\ُ\ٍ\ِ\(\)]+$/u', 'message' => '{attribute} باللغة العربية'),
                        array('school_country', 'length', 'max'=>3),
			array('school_street, school_email, school_phone, school_extraphone, school_fax, school_pobox', 'length', 'max'=>50),
			array('school_email', 'email', 'message' => 'الرجاء كتابة {attribute} المدرسة  بالشكل الصحيح'),
                        array('school_level, school_type', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('school_id, school_name, school_ename, school_place, school_street, school_email, school_phone, school_extraphone, school_fax, school_pobox, school_level, school_type, school_oldID, school_ManagerPersonID', 'safe', 'on'=>'search'),
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
			'mobaratSchools' => array(self::HAS_MANY, 'MobaratSchool', 'school_id'),
			'schoolManagerPerson' => array(self::BELONGS_TO, 'Person', 'school_ManagerPersonID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'school_id' => 'رقم المدرسة',
			'school_name' => 'إسم المدرسة بالعربية',
			'school_ename' => 'إسم المدرسة بالانكليزية',
			'school_place' => 'العنوان',
			'school_street' => 'الشارع',
			'school_email' => 'بريد الكتروني',
			'school_phone' => 'هاتف أول',
			'school_extraphone' => 'هاتف ثاني',
			'school_fax' => 'فاكس',
			'school_pobox' => 'صندوق بريد',
			'school_level' => 'المرحلة',
			'school_type' => 'النوع',
			'school_oldID' => 'School Old',
			'school_ManagerPersonID' => 'رقم المدير',
                        'school_country'=>'الدولة',
		);
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
         public static function requireSchool()
        {
            return array('school_name', 'school_street', 'school_email','school_level', 'school_type', 'school_phone','school_country','school_place');
        }
        
        public static function requireOldSchool()
        {
            return array('school_name','school_country');
        }
        
        public static function isRequiredFor($enmSchoolType,$fieldName)
        {
            // return false;
            $arr=null;
            switch($enmSchoolType)
            {
                case enm_SchoolType::SCHOOL:
               
                    $arr= School::requireSchool();
                    break;
                case enm_SchoolType::OLD_SCHOOL:
                    $arr= School::requireOldSchool();
                    break;
               
            }
            //return true;
            return in_array ($fieldName,$arr);
        }
         public function validateSchool($enmSchoolType)
        {
            $bolValid=$this->validate();
            $arr=null;
             switch($enmSchoolType)
            {
                case enm_SchoolType::SCHOOL:
               
                    $arr= School::requireSchool();
                    break;
                case enm_SchoolType::OLD_SCHOOL:
                    $arr= School::requireOldSchool();
                    break;
               
            }
           
           // echo count($arr);
            // echo $bolValid;
            foreach ($arr as $attr){ 
            if(trim($this[$attr])=="")
            {
                 
                $this->addError($attr,'يجب ادخال ' . $this->getAttributeLabel($attr));
                $bolValid=false;
            }//echo $attr;
            
            }
                //echo $bolValid;
                return $bolValid;
            
        }

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('school_id',$this->school_id);
		$criteria->compare('school_name',$this->school_name,true);
		$criteria->compare('school_ename',$this->school_ename,true);
		$criteria->compare('school_place',$this->school_place,true);
		$criteria->compare('school_street',$this->school_street,true);
		$criteria->compare('school_email',$this->school_email,true);
		$criteria->compare('school_phone',$this->school_phone,true);
		$criteria->compare('school_extraphone',$this->school_extraphone,true);
		$criteria->compare('school_fax',$this->school_fax,true);
		$criteria->compare('school_pobox',$this->school_pobox,true);
		$criteria->compare('school_level',$this->school_level,true);
		$criteria->compare('school_type',$this->school_type,true);
		$criteria->compare('school_oldID',$this->school_oldID);
		$criteria->compare('school_ManagerPersonID',$this->school_ManagerPersonID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return School the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getUnregisteredSchool($mobaratYear)
        {
            $query='select school_id,school_name '
                    . ' from school '
                    . 'where not school_name is null and length(school_name)>0 '
                    . ' and not school_id in (select mobarat_school.school_id from mobarat_school where mobarat_school_RegistrationStep <> "01" and  mobarat_year='.$mobaratYear .')';
            $schls=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            return $schls;
        }
        
       
        
    
    public static function getSchoolRegistrationProgress($schoolID){
        $progress=0;
        $projectProgress=0;
        $pas=100.00;
        //   return $progress;
        $current= Mobarat::getOpenMobaratRecord();
        $year=$current['mobarat_year'];
		
		
 
        $projects = Project::model()->findAll('school_id=' . $schoolID . ' AND mobarat_year=' . $year );
		if(count($projects)>0){
			$pas=$pas/count($projects)/3;
			foreach ($projects as $proj) {
				
				
                            $projectID=$proj->project_id;
                            $projectProgress= Project::getProgress($proj);//->getProjectRegistrationProgress($projectID);
                            $progress=$progress+$pas*$projectProgress/100.0;
				
                            $teac=ProjectTeacher::model()->findAll('project_id='.$projectID);
                            if(count($teac))
                                $progress=$progress+$pas;
                            
                            $std= ProjectStudent::model()->findAll('project_id='.$projectID);
                            if(count($std))
                                $progress=$progress+$pas;
                            
			/*	$critiria = new CDbCriteria;
        		$critiria->alias = 't';
        		$critiria->select = 'count(*) as count';
        		$critiria->join = 'JOIN mb_project ON t.pregistration_project = mb_project.project_id';
        		$critiria->join .= ' JOIN mb_user ON t.pregistration_user = mb_user.user_id';
        		$critiria->join .= ' JOIN mb_teacher on mb_user.user_id = mb_teacher.teacher_user';
        		$critiria->condition = 'mb_project.project_id ='. $projectID .' and mb_project.project_school=' . $schoolID . ' AND mb_teacher.year=' . $year . ' AND mb_user.user_type=4 AND (mb_teacher.teacher_flag=1 OR mb_teacher.teacher_flag=0)';

        		$result = MbProjectRegistration::model()->findAll($critiria);
				
				if(($result[0]->count)>0){
					$progress=$progress+$pas;
				}
				
				$critiria = new CDbCriteria;
		        $critiria->alias = 't';
		        $critiria->select = 'count(*) as count';
		        $critiria->join = 'JOIN mb_project ON t.pregistration_project = mb_project.project_id';
		        $critiria->join .= ' JOIN mb_user ON t.pregistration_user = mb_user.user_id';
		        $critiria->join .= ' JOIN mb_student on mb_user.user_id = mb_student.student_user';
		        $critiria->condition = 'mb_project.project_id ='. $projectID .' and mb_project.project_school=' . $schoolID . ' AND mb_student.year=' . $year . ' AND mb_user.user_type=3 AND (mb_student.student_flag=1 OR mb_student.student_flag=0)';
		
		        $result = MbProjectRegistration::model()->findAll($critiria);
		
		        if(($result[0]->count)>0){
					$progress=$progress+$pas;
				}*/
				
			} 
		}
       return intval($progress);
        
    }

     public static function sendConfirmCode($id,$prsID){
        $currentMobarat =  Mobarat::getOpenMobaratRecord();
        //$oTeach=  Personoteacher::getLastOfficialTeacher($id);
        $oTeach=Person::model()->findByPk( $prsID);
        if ($oTeach == null)
            return false;
        $moba_schl=  MobaratSchool::model()->findAll('mobarat_school_RegistrationStep="01" and school_id= ' . $id . ' and mobarat_year=' .$currentMobarat['mobarat_year']);


         if(count($moba_schl)>0){
             $moba_schl=$moba_schl[0];
           //$oTeach= Person::model()->findByPk($moba_schl[0]['oteacher_personid']);
            //echo count($oTeach);return;
            $email = $oTeach['Person_email1'];
            $code=$moba_schl['confirmation_code'];
            $msg_st = "<table cellpadding='10' dir='rtl' style='border:1px solid black;border-collapse:collapse;'>
                        <th align='right' bgcolor='#701584'><img src='http://mobarat.nasr.org.lb/themes/classic/assets/img/logo.png'></br></th>
                     <tr ><td> <p align='right'>جانب الأستاذ  المحترم" . " " . $oTeach['Person_fname'] . " " . $oTeach['Person_lname'] . "  </p></td></tr>
                     <tr  bgcolor='#E0E0E0'><td direction='rtl'><p align='right'>  لقد طلبتم تسجيل مدرستكم في مباراة العلوم" . " " . $currentMobarat['mobarat_year'] . "</p></td></tr>
                     <tr><td><p align='right'><font color='#4b8df8'> لتأكيد هذا الطلب </p></td></tr>
                     <tr bgcolor='#E0E0E0'><td><p align='right'><font color='#4b8df8'><b>" . Yii::app()->createAbsoluteurl("/School/activationForm"). "/" . $id . "</b></font></p></td></tr>
                     <tr><td><p align='right'>رمز التأكيد " . " : " . $code . "</p></td></tr>
                     </table>";
            //echo $msg_st;return;
            $subject = 'Activation Letter - Mobarat ' . $currentMobarat['mobarat_year'];
            $emailAddressTo=new cls_EMailAddress($email, $oTeach['Person_fname'] . " " . $oTeach['Person_lname']);

            $clsEMail=new cls_EMail;
            //echo $clsEMail->sendEMailWithStatic($subject,$msg_st,$emailAddressTo);
            if(is_null($moba_schl->count_mailconfirmcode_sended))
                $moba_schl->count_mailconfirmcode_sended=0;
            $moba_schl->count_mailconfirmcode_sended +=1;
            $moba_schl->date_lastmailconfirmcode_sended=new CDbExpression('now()');
            $moba_schl->save(false);
            
            if($clsEMail->sendEMailWithStatic($subject,$msg_st,$emailAddressTo)){
                return true;
                  //echo "<script>alert(\"true\")</script>";
            }else{
                return false;
                  //echo "<script>alert(\"false\")</script>";
            }
            
         }
        return false;
    }
        
}
