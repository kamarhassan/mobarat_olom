<?php

/**
 * This is the model class for table "person_student".
 *
 * The followings are the available columns in table 'person_student':
 * @property integer $Student_id
 * @property integer $student_personid
 * @property integer $mobarat_year
 * @property string $student_class
 * @property integer $student_CanModifyProject
 * @property integer $student_oldID
 *
 * The followings are the available model relations:
 * @property Person $studentPerson
 * @property Mobarat $mobaratYear
 */
class Personstudent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'person_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_personid, mobarat_year', 'required'),
			array('student_personid, mobarat_year, student_CanModifyProject, student_oldID', 'numerical', 'integerOnly'=>true),
			array('student_class', 'length', 'max'=>2),
                        array('date_inserted','default','value'=>new CDbExpression('now()'),'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Student_id, student_personid, mobarat_year, student_class, student_CanModifyProject, student_oldID,confirmation_code,isConfirmed', 'safe', 'on'=>'search'),
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
			'studentPerson' => array(self::BELONGS_TO, 'Person', 'student_personid'),
			'mobaratYear' => array(self::BELONGS_TO, 'Mobarat', 'mobarat_year'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Student_id' => 'Student',
			'student_personid' => 'Student Personid',
			'mobarat_year' => 'Mobarat Year',
			'student_class' => 'الصف ',
			'student_CanModifyProject' => 'Student Can Modify Project',
			'student_oldID' => 'Student Old',
                        'isConfirmed'=>'تم التأكيد',
                        'confirmation_code'=>'رمز التأكيد'
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

		$criteria->compare('Student_id',$this->Student_id);
		$criteria->compare('student_personid',$this->student_personid);
		$criteria->compare('mobarat_year',$this->mobarat_year);
		$criteria->compare('student_class',$this->student_class,true);
		$criteria->compare('student_CanModifyProject',$this->student_CanModifyProject);
		$criteria->compare('student_oldID',$this->student_oldID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Personstudent the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
        public static  function getCountAllStudent($my) {
            $query='SELECT  count(person.person_id) as ct
                    FROM person inner join person_student on person_student.student_personid=person.Person_id
                    inner join  project_student on project_student.person_id=person.Person_id
                    inner join project on project.project_id=project_student.project_id and person_student.mobarat_year=project.mobarat_year 
                    inner join school on school.school_id=person_student.school_id
                    where person_student.mobarat_year='. $my;
            return Yii::app()->getDB()->createCommand($query)->queryScalar();
             //return Personstudent::model()->count('mobarat_year=' . $my);
        }
        public static  function getCountAllStudentForSchool($my,$schlid) {
            $query='SELECT  count(person.person_id) as ct
                    FROM person inner join person_student on person_student.student_personid=person.Person_id
                    inner join  project_student on project_student.person_id=person.Person_id
                    inner join project on project.project_id=project_student.project_id and person_student.mobarat_year=project.mobarat_year 
                    inner join school on school.school_id=person_student.school_id
                    where person_student.mobarat_year='. $my.' and school.school_id='.$schlid;
            return Yii::app()->getDB()->createCommand($query)->queryScalar();
            //return Personstudent::model()->count('school_id ='.$schlid.' and mobarat_year=' . $my);
        }
}
