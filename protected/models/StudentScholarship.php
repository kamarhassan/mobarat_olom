<?php

/**
 * This is the model class for table "student_scholarship".
 *
 * The followings are the available columns in table 'student_scholarship':
 * @property integer $student_scholarship_id
 * @property integer $student_id
 * @property integer $person_id
 * @property integer $mobarat_year
 * @property integer $giveup
 * @property string $giveup_why
 * @property string $id_attachment
 * @property string $phone_house
 * @property string $phone_guardian
 * @property string $nomination_number
 * @property string $Grade_attachment
 * @property string $university
 * @property integer $agree_lot
 * @property string $Major
 * @property string $notes
 * @property integer $assue_information
 *
 * The followings are the available model relations:
 * @property Mobarat $mobaratYear
 * @property Person $person
 * @property Personstudent $student
 */
class StudentScholarship extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'student_scholarship';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, person_id, mobarat_year,  agree_lot, assue_information', 'numerical', 'integerOnly'=>true),
                        array('giveup','boolean'),
			array('giveup_why, notes', 'length', 'max'=>200),
			array('id_attachment, phone_house, phone_guardian, Grade_attachment, Major', 'length', 'max'=>45),
			array('nomination_number', 'length', 'max'=>15),
			array('university', 'length', 'max'=>2),
                        array('student_class', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('student_scholarship_id, student_id, person_id, mobarat_year, giveup, giveup_why, id_attachment, phone_house, phone_guardian, nomination_number, Grade_attachment, university, agree_lot, Major, notes, assue_information,class', 'safe', 'on'=>'search'),
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
			'mobaratYear' => array(self::BELONGS_TO, 'Mobarat', 'mobarat_year'),
			'person' => array(self::BELONGS_TO, 'Person', 'person_id'),
			'student' => array(self::BELONGS_TO, 'Personstudent', 'student_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'student_scholarship_id' => 'Student Scholarship',
			'student_id' => 'Student',
			'person_id' => 'Person',
			'mobarat_year' => 'Mobarat Year',
			'giveup' => 'أتنازل عن حقي في المنحة',
			'giveup_why' => 'في حال التنازل عن المنحة يرجى ايضاح الاسباب الموجبة',
			'id_attachment' => 'مرفق الهوية',
			'phone_house' => 'هاتف المنزل',
			'phone_guardian' => 'هاتف ولي الامر',
			'nomination_number' => 'رقم الترشيح في الامتحانات الرسمية',
			'Grade_attachment' => 'مرفق العلامات الدراسية خلال كل المرحلة الثانوية',
			'university' => 'الجامعة',
			'agree_lot' => 'إذا رست القرعة على جامعة أخرى غير التي اخترتها اعلاه، هل تقبل بها',
			'Major' => 'الاختصاص الجامعي المطلوب',
			'notes' => 'معلومات اضافية',
			'assue_information' => 'موافق',
                        'student_class'=>'الصف في العام الدراسي',
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

		$criteria->compare('student_scholarship_id',$this->student_scholarship_id);
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('person_id',$this->person_id);
		$criteria->compare('mobarat_year',$this->mobarat_year);
		$criteria->compare('giveup',$this->giveup);
		$criteria->compare('giveup_why',$this->giveup_why,true);
		$criteria->compare('id_attachment',$this->id_attachment,true);
		$criteria->compare('phone_house',$this->phone_house,true);
		$criteria->compare('phone_guardian',$this->phone_guardian,true);
		$criteria->compare('nomination_number',$this->nomination_number,true);
		$criteria->compare('Grade_attachment',$this->Grade_attachment,true);
		$criteria->compare('university',$this->university,true);
		$criteria->compare('agree_lot',$this->agree_lot);
		$criteria->compare('Major',$this->Major,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('assue_information',$this->assue_information);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StudentScholarship the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
    public static function insert_ifnot_exists($mobaratyear,$studentid,$personid){
        $exists=  StudentScholarship::model()->exists('mobarat_year='.$mobaratyear.
                           ' and student_id='.$studentid.
                           ' and person_id='.$personid);
            if($exists == false){
                $sql = "insert into student_scholarship(mobarat_year,person_id, student_id)
                    values(".$mobaratyear .",'" . $personid . "','" . $studentid . "')";
                $query = Yii::app()->db->createCommand($sql);
                $query->execute();
            }
        
    }
}
