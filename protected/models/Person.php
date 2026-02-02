<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property integer $Person_id
 * @property string $Person_fname
 * @property string $Person_mname
 * @property string $Person_lname
 * @property string $Person_sex
 * @property string $Person_Salutation
 * @property string $Person_birthdate
 * @property string $Person_Address
 * @property string $Person_email1
 * @property string $Person_email2
 * @property string $Person_Phone
 * @property string $Person_CellPhone
 * @property integer $Person_whatsapp
 * @property string $Person_pic
 * @property integer $Person_userID
 * @property string $person_efname
 * @property string $person_emname
 * @property string $person_elname
 * @property integer $person_oldID
 *
 * The followings are the available model relations:
 * @property MobaratSchool[] $mobaratSchools
 * @property User $personUser
 * @property Personoteacher[] $Personoteachers
 * @property Personstudent[] $Personstudents
 * @property Personteacher[] $Personteachers
 * @property School[] $schools
 */
abstract class enm_PersonType{
    const OTEACHER=0;
    const MANAGER=1;
    const TEACHER=2;
    const STUDENT=3;
    const JUDGE=4;
    const MEMBER=5;
    const OLD_OTEACHER=100;
    const OLD_MANAGER=101;
}
class Person extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('Person_fname, Person_lname,Person_email1', 'required', 'message' => 'إملأ {attribute}'),
			array('Person_whatsapp, Person_userID, person_oldID', 'numerical', 'integerOnly'=>true),
                        array('person_efname, person_emname, person_elname', 'CRegularExpressionValidator', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => '{attribute} يجب أن يكون باللغة الإنكليزية'),
                        array('Person_fname, Person_mname, Person_lname', 'CRegularExpressionValidator', 'pattern' => '/^[\s\p{Arabic}\ـ\-\َ\ً\ٌ\ُ\ٍ\ِ\(\)]+$/u', 'message' => '{attribute} باللغة العربية'),
			array('Person_fname, Person_mname, Person_lname, Person_Address, person_efname, person_emname, person_elname', 'length', 'max'=>100),
			array('Person_sex, Person_Salutation', 'length', 'max'=>2),
                        array('person_description', 'length', 'max'=>100),
			array('Person_email1, Person_email2, Person_Phone, Person_CellPhone, Person_pic', 'length', 'max'=>50),
                        array('Person_email1, Person_email2', 'email', 'message' => 'الرجاء كتابة {attribute} الطالب  بالشكل الصحيح'),
                        array('Person_Phone, Person_CellPhone', 'CRegularExpressionValidator', 'pattern'=>'/^[0-9]{8,16}+$/', 'message' => '{attribute} يجب أن يكون أرقام فقط'),
			array('Person_birthdate', 'safe'),
                       
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Person_id, Person_fname, Person_mname, Person_lname, Person_sex, Person_Salutation, Person_birthdate, Person_Address, Person_email1, Person_email2, Person_Phone, Person_CellPhone, Person_whatsapp, Person_pic, Person_userID, person_efname, person_emname, person_elname, person_oldID', 'safe', 'on'=>'search'),
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
			'mobaratSchools' => array(self::HAS_MANY, 'MobaratSchool', 'oteacher_personid'),
			'personUser' => array(self::BELONGS_TO, 'User', 'Person_userID'),
			'Personoteachers' => array(self::HAS_MANY, 'Personoteacher', 'oteacher_personid'),
			'Personstudents' => array(self::HAS_MANY, 'Personstudent', 'student_personid'),
			'Personteachers' => array(self::HAS_MANY, 'Personteacher', 'teacher_personid'),
			'schools' => array(self::HAS_MANY, 'School', 'school_ManagerPersonID'),
		);
	}
        public static function requireStudent()
        {
            return array('Person_fname','Person_mname','Person_lname','Person_email1','person_efname','person_emname','person_elname','Person_CellPhone','Person_sex','Person_Salutation');
        }
        public static function requireOTeacher()
        {
            return array('Person_fname','Person_lname','Person_email1','person_efname','person_elname','Person_CellPhone','Person_sex','Person_Salutation');
        }
        
        public static function requireManager()
        {
            return array('Person_fname','Person_lname','person_efname','person_elname','Person_CellPhone','Person_sex','Person_Salutation');
        }
        
         public static function requireJudge()
        {
            return array('Person_fname','Person_lname','Person_email1','Person_CellPhone','Person_sex','Person_Salutation');
        }
        
        public static function requireOldOTeacher()
        {
            return array('Person_fname','Person_lname','Person_email1');
        }
        
        public static function requireOldManager()
        {
            return array();
        }
        
       /* public static function isRequiredForOTeacher($fieldName)
        {
            return in_array ($fieldName,Person::requireOTeacher());
        }*/
        
         public static function isRequiredFor($enmPersonType,$fieldName)
        {
            // return false;
            $arr=null;
            switch($enmPersonType)
            {
                case enm_PersonType::OTEACHER:
                case enm_PersonType::TEACHER:
                //case enm_PersonType::TEACHER:
                    $arr= Person::requireOTeacher();
                    break;
                case enm_PersonType::MANAGER:
                    $arr= Person::requireManager();
                    break;
                case enm_PersonType::JUDGE:
                    $arr= Person::requireJudge();
                    break;
                case enm_PersonType::STUDENT:
                    $arr= Person::requireStudent();
                    break;
                case enm_PersonType::OLD_OTEACHER:
                    $arr= Person::requireOldOTeacher();
                    break;
                case enm_PersonType::OLD_MANAGER:
                    $arr= Person::requireOldManager();
                    break;

            }
            //return true;
            return in_array ($fieldName,$arr);
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Person_id' => 'الرقم',
			'Person_fname' => 'الإسم',
			'Person_mname' => 'إسم الاب',
			'Person_lname' => 'الشهرة',
			'Person_sex' => 'الجنس',
			'Person_Salutation' => 'المخاطبة',
			'Person_birthdate' => 'تاريخ الميلاد',
			'Person_Address' => 'العنوان',
			'Person_email1' => 'البريد الالكتروني',
			'Person_email2' => 'البريد الالكتروني 2',
			'Person_Phone' => 'الهاتف',
			'Person_CellPhone' => 'الخليوي',
			'Person_whatsapp' => 'Whatsapp',
			'Person_pic' => 'الصورة',
			'Person_userID' => 'المستخدم',
			'person_efname' => 'Name',
			'person_emname' => 'Father Name',
			'person_elname' => 'Last Name',
			'person_oldID' => 'Person Old',
                        'person_description'=> 'معلومات إضافية',
		);
	}
        
        public function validatePerson($enmPersonType)
        {
            $bolValid=$this->validate();
            $arr=null;
            switch($enmPersonType)
            {
                case enm_PersonType::OTEACHER:
                case enm_PersonType::TEACHER: 
                    $arr= Person::requireOTeacher();
                    break;
                case enm_PersonType::MANAGER:
                    $arr= Person::requireManager();
                    break;
                 case enm_PersonType::JUDGE:
                    $arr= Person::requireJudge();
                    break;
                case enm_PersonType::STUDENT:
                    $arr= Person::requireStudent();
                    break;
                case enm_PersonType::OLD_OTEACHER:
                    $arr= Person::requireOldOTeacher();
                    //echo "sdfsdfsd";
                    break;
                case enm_PersonType::OLD_MANAGER:
                    $arr= Person::requireOldManager();
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Person_id',$this->Person_id);
		$criteria->compare('Person_fname',$this->Person_fname,true);
		$criteria->compare('Person_mname',$this->Person_mname,true);
		$criteria->compare('Person_lname',$this->Person_lname,true);
		$criteria->compare('Person_sex',$this->Person_sex,true);
		$criteria->compare('Person_Salutation',$this->Person_Salutation,true);
		$criteria->compare('Person_birthdate',$this->Person_birthdate,true);
		$criteria->compare('Person_Address',$this->Person_Address,true);
		$criteria->compare('Person_email1',$this->Person_email1,true);
		$criteria->compare('Person_email2',$this->Person_email2,true);
		$criteria->compare('Person_Phone',$this->Person_Phone,true);
		$criteria->compare('Person_CellPhone',$this->Person_CellPhone,true);
		$criteria->compare('Person_whatsapp',$this->Person_whatsapp);
		$criteria->compare('Person_pic',$this->Person_pic,true);
		$criteria->compare('Person_userID',$this->Person_userID);
		$criteria->compare('person_efname',$this->person_efname,true);
		$criteria->compare('person_emname',$this->person_emname,true);
		$criteria->compare('person_elname',$this->person_elname,true);
		$criteria->compare('person_oldID',$this->person_oldID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Person the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public static function getSalutationAndNameByUserID($uid){
            $query="select concat(ifnull((select code_name from codes where code_no =person_Salutation and code_kind=102),''),' '
                        ,Person_fname, ' ' , Person_lname) as sal  from person where Person_userID=".$uid;
            $p=Yii::app()->getDB()->createCommand($query)->queryScalar();
            if($p!=False)
                return $p;
            return "";
        }
        public static function getClsPerson()
        {
            $mobarat=  Mobarat::getOpenMobaratRecord();
            $head=" Person_id, CONCAT(ifnull(Person_fname,'') , ' ' ,ifnull( Person_mname,'') , ' ' , ifnull(Person_lname,'')) as name "
                    .",person_pic,user_type,user_id from person inner join user on user_id=person_userid ";
            $foot=" where user_id=" . Yii::app()->user->id;
            $query="SELECT 'a' as ut,1 as od,".$head.$foot." and user_type='01' "
                    ." union SELECT 'o' as ut,2 as od,".$head
                    . " inner join person_oteacher on person_oteacher.oteacher_personid=person_id and mobarat_year=".$mobarat['mobarat_year']
                    . $foot
                    . " union SELECT 't' as ut,3 as od,".$head
                    . " inner join person_teacher on person_teacher.teacher_personid=person_id and mobarat_year=".$mobarat['mobarat_year']
                    . $foot
                    . " union SELECT 's' as ut,4 as od,".$head
                    . " inner join person_student on person_student.student_personid=person_id and mobarat_year=".$mobarat['mobarat_year']
                    . $foot
                    . " union SELECT 'j' as ut,5 as od,".$head
                    . " inner join person_judge on person_judge.judge_personid=person_id and mobarat_year=".$mobarat['mobarat_year']
                    . $foot
                    . " order by od   limit 1";
            /*$query="select Person_id, CONCAT(ifnull(Person_fname,'') , ' ' ,ifnull( Person_mname,'') , ' ' , ifnull(Person_lname,'')) as name "
                    .",person_pic,user_type,user_id from person inner join user on user_id=person_userid "
                    . " where user_id=" . Yii::app()->user->id
                    . " order by Person_id desc  limit 1";*/
            $p=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            if (count($p)==1)
            {
                $clsPerson=new cls_Person();
                $clsPerson->person_id=$p[0]['Person_id'];
                $clsPerson->name=$p[0]['name'];
                $clsPerson->pic=$p[0]['person_pic'];
                $clsPerson->user_id=$p[0]['user_id'];
                $clsPerson->user_type=$p[0]['user_type'];
                $clsPerson->type=$p[0]['ut'];
                return $clsPerson;
            }
            return null;
               
        }
}
