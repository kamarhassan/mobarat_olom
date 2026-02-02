<?php

/**
 * This is the model class for table "person_oteacher".
 *
 * The followings are the available columns in table 'person_oteacher':
 * @property integer $oteacher_id
 * @property integer $mobarat_year
 * @property integer $oteacher_personid
 * @property string $oteacher_description
 * @property integer $oteacher_Oldid
 *
 * The followings are the available model relations:
 * @property MobaratSchool[] $mobaratSchools
 * @property Person $oteacherPerson
 * @property Mobarat $mobaratYear
 */
class Personoteacher extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'person_oteacher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('oteacher_personid,oteacher_description', 'required'),
			array('mobarat_year, oteacher_personid, oteacher_Oldid', 'numerical', 'integerOnly'=>true),
			array('oteacher_description', 'length', 'max'=>100),
                        array('date_inserted','default','value'=>new CDbExpression('now()'),'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('oteacher_id, mobarat_year, oteacher_personid, oteacher_description, oteacher_Oldid', 'safe', 'on'=>'search'),
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
			'mobaratSchools' => array(self::HAS_MANY, 'MobaratSchool', 'oteacher_id'),
			'oteacherPerson' => array(self::BELONGS_TO, 'Person', 'oteacher_personid'),
			'mobaratYear' => array(self::BELONGS_TO, 'Mobarat', 'mobarat_year'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'oteacher_id' => 'Oteacher',
			'mobarat_year' => 'Mobarat Year',
			'oteacher_personid' => 'Oteacher Personid',
			'oteacher_description' => 'الوصف',
			'oteacher_Oldid' => 'Oteacher Oldid',
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

		$criteria->compare('oteacher_id',$this->oteacher_id);
		$criteria->compare('mobarat_year',$this->mobarat_year);
		$criteria->compare('oteacher_personid',$this->oteacher_personid);
		$criteria->compare('oteacher_description',$this->oteacher_description,true);
		$criteria->compare('oteacher_Oldid',$this->oteacher_Oldid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Personoteacher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getLastOfficialTeacher($schoolid){
	        
            $query='select Person_id,Person_fname,Person_mname,Person_lname,Person_email1, o.oteacher_id,o.mobarat_year '
                . ' from mobarat_school as m inner join person_oteacher as o on m.oteacher_id=o.oteacher_id '
                . ' inner join person on person.Person_id =o.oteacher_personid '
                . ' where school_id=' . $schoolid
                . ' order by o.mobarat_year desc '
                . ' limit 1 ';
            $oteachs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            if (count($oteachs)>0)
                return $oteachs[0];
            return null;

	}
        
        public static function getOfficialTeacher($schoolid){
	        
            $query="select  Person_id,Person_fname,Person_mname,Person_lname,Person_email1, GROUP_CONCAT(DISTINCT o.mobarat_year  SEPARATOR ', ') as years "
                . " from mobarat_school as m inner join person_oteacher as o on m.oteacher_id=o.oteacher_id  "
                . " inner join person on person.Person_id =o.oteacher_personid  "
                . " where school_id=" . $schoolid
                . " group by Person_id ";
            $oteachs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
            if (count($oteachs)>0)
                return $oteachs;
            return null;

	}
        

}
