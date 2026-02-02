<?php

/**
 * This is the model class for table "person_teacher".
 *
 * The followings are the available columns in table 'person_teacher':
 * @property integer $teacher_id
 * @property integer $mobarat_year
 * @property integer $teacher_personid
 * @property string $teacher_levelStudy
 * @property integer $teacher_Oldid
 *
 * The followings are the available model relations:
 * @property Person $teacherPerson
 * @property Mobarat $mobaratYear
 */
class Personteacher extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'person_teacher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teacher_personid', 'required'),
			array('mobarat_year, teacher_personid, teacher_Oldid,school_id', 'numerical', 'integerOnly'=>true),
			array('teacher_levelStudy', 'length', 'max'=>100),
                        array('date_inserted','default','value'=>new CDbExpression('now()'),'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('teacher_id, mobarat_year, teacher_personid, teacher_levelStudy, teacher_Oldid,school_id', 'safe', 'on'=>'search'),
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
			'teacherPerson' => array(self::BELONGS_TO, 'Person', 'teacher_personid'),
			'mobaratYear' => array(self::BELONGS_TO, 'Mobarat', 'mobarat_year'),
                        'school_id' => array(self::BELONGS_TO, 'School', 'school_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'teacher_id' => 'Teacher',
			'mobarat_year' => 'Mobarat Year',
			'teacher_personid' => 'Teacher Personid',
			'teacher_levelStudy' => 'المستوى العلمي',
			'teacher_Oldid' => 'Teacher Oldid',
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

		$criteria->compare('teacher_id',$this->teacher_id);
		$criteria->compare('mobarat_year',$this->mobarat_year);
		$criteria->compare('teacher_personid',$this->teacher_personid);
		$criteria->compare('teacher_levelStudy',$this->teacher_levelStudy,true);
		$criteria->compare('teacher_Oldid',$this->teacher_Oldid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Personteacher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getCountAllTeacher($my) {
            return Personteacher::model()->count('not  school_id is null and mobarat_year=' . $my);
        }
        
        public static  function getCountAllTeacherForSchool($my,$schlid) {
            return Personteacher::model()->count('school_id ='.$schlid.' and mobarat_year=' . $my);
        }
}
