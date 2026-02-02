<?php

/**
 * This is the model class for table "mobarat".
 *
 * The followings are the available columns in table 'mobarat':
 * @property integer $mobarat_year
 * @property integer $openForRegistration
 * @property string $last_register_school
 * @property string $last_register_project
 * @property string $last_register_teacher_student
 * @property string $last_update
 *
 * The followings are the available model relations:
 * @property MobaratSchool[] $mobaratSchools
 * @property Personoteacher[] $Personoteachers
 * @property Personstudent[] $Personstudents
 * @property Personteacher[] $Personteachers
 */
class Mobarat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mobarat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */ 
        //'firstDayJudge, secondDayJudge , ceremonyDay,morningFrom , morningTo , eveningFrom, eveningTo , ceremonyFrom, ceremonyTo' 
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mobarat_year', 'required'),
			array('mobarat_year, openForRegistration,maxNoOfSchool,MaxNoOfProject,StudentNbForProject,TeacherNbForProject,judgeprojectcount,enablejudgeday', 'numerical', 'integerOnly'=>true),
			array('last_register_school, last_register_project,MaxNoOfProject,maxNoOfSchool,judgeprojectcount, last_register_teacher_student, last_update, last_update_judge, firstDayJudge, secondDayJudge , ceremonyDay,morningFrom , morningTo , eveningFrom, eveningTo , ceremonyFrom, ceremonyTo,enablejudgedaycode_no,openforupdate_fromdate,openforupdate_todate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
                        array('phone_trouble', 'CRegularExpressionValidator', 'pattern'=>'/^[0-9]{8,16}+$/', 'message' => '{attribute} يجب أن يكون أرقام فقط'),
			array('mobarat_year, phone_trouble, openForRegistration,MaxNoOfProject, last_register_school, last_register_project, last_register_teacher_student, last_update,StudentNbForProject,TeacherNbForProject,last_update_judge, firstDayJudge, secondDayJudge , ceremonyDay,morningFrom , morningTo , eveningFrom, eveningTo , ceremonyFrom, ceremonyTo,openforupdate_fromdate,openforupdate_todate', 'safe', 'on'=>'search'),
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
			'mobaratSchools' => array(self::HAS_MANY, 'MobaratSchool', 'mobarat_year'),
			'Personoteachers' => array(self::HAS_MANY, 'Personoteacher', 'mobarat_year'),
			'Personstudents' => array(self::HAS_MANY, 'Personstudent', 'mobarat_year'),
			'Personteachers' => array(self::HAS_MANY, 'Personteacher', 'mobarat_year'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
       
	public function attributeLabels()
	{
		return array(
			'mobarat_year' => 'العام',
			'openForRegistration' => 'السنة الحالية',
			'last_register_school' => 'اخر مهلة لتسجيل المدارس',
			'last_register_project' => 'اخر مهلة لتسجيل المشاريع',
			'last_register_teacher_student' => 'اخر مهلة لتسجيل الاساتذة والطلاب',
			'last_update' => 'اخر مهلة للتعديل',
                        'MaxNoOfProject'=>'العدد الاقصى للمشاريع',
                        'phone_trouble' => 'الهاتف المعتمد في حال حدوث مشاكل',
                        'StudentNbForProject'=>'العدد الاقصى للطلاب في المشروع',
                        'TeacherNbForProject'=>'عدد الاساتذة المشرفين على المشروع',
                        'last_update_judge'=>'اخر مهلة لتعديل الحكام',
                        'firstDayJudge'=>'يوم التحكيم الاول',
                        'secondDayJudge'=>'يوم التحكيم الثاني',
                        'ceremonyDay'=>'الحفل الختامي',
                        'morningFrom'=>'الفترة الصباحية من',
                        'morningTo'=>'الفترة الصباحية حتى',
                        'eveningFrom'=>'الفترة المسائية من',
                        'eveningTo'=>'الفترة المسائية حتى',
                        'ceremonyFrom'=>'الحفل الختامي من',
                        'ceremonyTo'=>'الحفل الختامي حتى',
                        'judgeprojectcount'=>'عدد المشاريع المتاحة للحكم من فئة واحدة',
                        'enablejudgeday'=>'تفعيل يوم التحكيم',
                        'enablejudgedaycode_no'=>'اليوم المفعل للتحكيم',
                        'openforupdate_fromdate'=>'من تاريخ',
                        'openforupdate_todate'=>'إلى تاريخ',
                        'maxNoOfSchool'=>'العدد الاقصى للمدارس',

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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('mobarat_year',$this->mobarat_year);
		$criteria->compare('openForRegistration',$this->openForRegistration);
                $criteria->compare('MaxNoOfProject',$this->MaxNoOfProject);
		$criteria->compare('last_register_school',$this->last_register_school,true);
		$criteria->compare('last_register_project',$this->last_register_project,true);
		$criteria->compare('last_register_teacher_student',$this->last_register_teacher_student,true);
		$criteria->compare('last_update',$this->last_update,true);
                $criteria->compare('last_update_judge',$this->last_update_judge,true);
                $criteria->compare('firstDayJudge',$this->firstDayJudge,true);
		$criteria->compare('secondDayJudge',$this->secondDayJudge,true);
                $criteria->compare('ceremonyDay',$this->ceremonyDay,true);
                
                $criteria->compare('morningFrom',$this->morningFrom,true);
		$criteria->compare('morningTo',$this->morningTo,true);
                $criteria->compare('eveningFrom',$this->eveningFrom,true);
                $criteria->compare('eveningTo',$this->eveningTo,true);
		$criteria->compare('ceremonyFrom',$this->ceremonyFrom,true);
                $criteria->compare('ceremonyTo',$this->ceremonyTo,true);
                
                $criteria->compare('openforupdate_fromdate',$this->openforupdate_fromdate,true);
		$criteria->compare('openforupdate_todate',$this->openforupdate_todate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mobarat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getMaxYear()
        { 
            $query="select max(mobarat_year) as max1 FROM mobarat ";
            $maxmun=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            $maxYear = $maxmun[0]['max1'];
            return $maxYear;//$maxYear;
           
        }
        
        public static function isOpenDate($mbr){
            //return true;
            if(!is_null($mbr['openforupdate_fromdate']) && !is_null($mbr['openforupdate_todate'])){
                $d = new DateTime();
                $date = $d->format('Y-m-d');
                if (strtotime($date) >= strtotime($mbr['openforupdate_fromdate']) && strtotime($date) <= strtotime($mbr['openforupdate_todate'])) {
                    return true;
                }
            }
            return false;
        }
        
        public static function isOpenForProject($mbr){
            $d = new DateTime();
            $date = $d->format('Y-m-d');
            if (strtotime($date) < strtotime($mbr['last_register_project'])) {
                return true;
            }
            return Mobarat::isOpenDate($mbr);
        }
        
        public static function isOpenForRegisterTeacherStudent($mbr){
            $d = new DateTime();
            $date = $d->format('Y-m-d');
            if (strtotime($date) < strtotime($mbr['last_register_teacher_student'])) {
                return true;
            }
             return Mobarat::isOpenDate($mbr);
        }
        
        public static function isOpenForRegisterSchool($mbr){
            $d = new DateTime();
            $date = $d->format('Y-m-d');
            if (strtotime($date) < strtotime($mbr['last_register_school'])) {
                return true;
            }
             return false;
        }
        
        public static function isOpenForUpdate($mbr){
            $d = new DateTime();
            $date = $d->format('Y-m-d');
            if (strtotime($date) < strtotime($mbr['last_update'])) {
                return true;
            }
             return Mobarat::isOpenDate($mbr);
        }
        
        public static function showMessgaeForUpdate($mbr){
            $d = new DateTime();
            $date = $d->format('Y-m-d');
            if ((strtotime($date) >= strtotime($mbr['last_update'])
                    || strtotime($date) >= strtotime($mbr['last_register_project'])
                    || strtotime($date) >= strtotime($mbr['last_register_teacher_student']))
                    && strtotime($date) < strtotime($mbr['openforupdate_fromdate'])){
                return true;
            }
            return false;
        }
        
        public static function getOpenMobaratRecord()
        {
            $query="select  mobarat_year, openForRegistration,MaxNoOfProject,maxNoOfSchool"
                    . ", last_register_school, last_register_project, last_register_teacher_student"
                    . ",last_update ,phone_trouble,StudentNbForProject,TeacherNbForProject"
                    . ", last_update_judge, enablejudgeday, enablejudgedaycode_no"
                    . ", openforupdate_fromdate, openforupdate_todate, firstDayJudge, secondDayJudge  FROM mobarat where openForRegistration=true";
            $cmd=Yii::app()->getDB()->createCommand($query);
            
            $mbrs=$cmd->queryAll(true);
                //while($cmd->pdoStatement->nextRowSet());
            if(count($mbrs)>0)
                return $mbrs[0];
            else
                return null;
            
          // return Mobarat::model()->find('openForRegistration=true');
        }
        
//        public static function getPhoneTrouble()
//        {
//            
//            $query="select  phone_trouble  FROM mobarat where openForRegistration=true ";
//            $mbrs=Yii::app()->getDB()->createCommand($query)->queryScalar();
//            if($mbrs!=false)
//                return $mbrs;
//            else
//               return 0;
//        }
        
        public static function getSchoolCount($my){
            $query="select count(school_id) from mobarat_school where mobarat_year=".$my." and mobarat_school_RegistrationStep <>'03'";
            $mbrs=Yii::app()->getDB()->createCommand($query)->queryScalar();
            if($mbrs!=false)
                return $mbrs;
            else
               return 0;
        }
        
        public static function getCodeEnable($code_kind){
            $cur=Mobarat::getOpenMobaratRecord();
            $query="SELECT codes.* FROM codes inner join mobarat_code on mobarat_code.code_kind=codes.code_kind and   mobarat_code.code_no=codes.code_no
                    where mobarat_code.code_kind=".$code_kind." and mobarat_code.code_enable=1 and mobarat_year=".$cur['mobarat_year'].";";
            $codes=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            return $codes;
        }
        
         public static function getCodeEnable2($code_kind,$codelen){
            $cur=Mobarat::getOpenMobaratRecord();
            $query="SELECT codes.* FROM codes inner join mobarat_code on mobarat_code.code_kind=codes.code_kind and   mobarat_code.code_no=codes.code_no
                    where length(codes.code_no)=".$codelen." and mobarat_code.code_kind=".$code_kind." and mobarat_code.code_enable=1 and mobarat_year=".$cur['mobarat_year'].";";
            $codes=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            return $codes;
        }
        
        public static function validateSuite2desc($suite2desc,$total){
            $ss=split(";",$suite2desc);
            //$list=array();
            foreach ($ss as $s){
                if(is_numeric($s)){
                    if($s>$total){
                        return false;
                    }
                }
                else{
                    $cc=split("-",$s);
                    if(count($cc)>2){
                        return false;
                    }elseif(count($cc)==1){
                        if($cc[0]>$total){
                            return false;
                        }
                    }elseif(is_numeric($cc[0]) && is_numeric($cc[1])){
                        if($cc[0]>$cc[1]||$cc[0]>$total||$cc[1]>$total){
                            return false;
                        }
                    }else{
                        return false;
                    }
                }
            }
            return true;
        }
        
        public static function getListSuite2desc($suite2desc){
            $ss=split(";",$suite2desc);
            $list=array();
            
            foreach ($ss as $s){
                if(is_numeric($s)){
                    $list[] =$s;
                }
                else{
                    $cc=split("-",$s);
                    if(count($cc)==1){
                        $list[] =$cc[0];
                    }else{
                        for($i=$cc[0];$i<=$cc[1];$i++){
                            $list[] =$i;
                        }
                    }
                }
            }
            return $list;
        }
        
        public static function getListSuiteEmpty(&$suite,$my,$day,$halls){
            //echo "asd";
            //echo implode(",",$suite);return;
            $query="SELECT substring(suite,2) as suite
                    FROM   mobarat_school 
                    where  mobarat_school_RegistrationStep='04' and mobarat_year=". $my."  
                    and date_day='".$day."' and halls='".$halls."' 
                    and substring(suite,2) in (".implode(",",$suite).")";
            //echo $query;
            $currentSuite=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);
            for($i=0;$i<count($currentSuite);$i++){
                $val=(int)$currentSuite[$i]['suite'];
                //echo $val;
                if(in_array($val, $suite)){
                    //echo  $val.", ";
                    $index=array_search($val, $suite);
                    unset($suite[$index]);
                    $suite=array_values($suite);
                }
            } 
        }
        
        public static function getListSuite1($list2,$total){
            $list=array();
            for($i=1;$i<=$total;$i++){
                if(!in_array($i, $list2)){
                    $list[]=$i;
                }
            }
            //return $list;
            if(count($list2)>0&& strlen(trim($list2[0]))>0)
                return array_merge( $list,$list2);
            else {
                return $list;
            }
        }
        
    
}
