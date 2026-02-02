<?php

/**
 * This is the model class for table "judge_type".
 *
 * The followings are the available columns in table 'judge_type':
 * @property integer $judetype_id
 * @property integer $person_id
 * @property integer $judge_id
 * @property integer $mobarat_year
 * @property string $project_type
 * @property integer $type_enable
 * @property integer $type_kernel
 *
 * The followings are the available model relations:
 * @property PersonJudge $judge
 * @property Mobarat $mobaratYear
 */
class JudgeType extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'judge_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('person_id, judge_id, mobarat_year, type_enable, type_kernel', 'numerical', 'integerOnly'=>true),
			array('project_type', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('judetype_id, person_id, judge_id, mobarat_year, project_type, type_enable, type_kernel', 'safe', 'on'=>'search'),
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
			'judge' => array(self::BELONGS_TO, 'PersonJudge', 'judge_id'),
			'mobaratYear' => array(self::BELONGS_TO, 'Mobarat', 'mobarat_year'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'judetype_id' => 'Judetype',
			'person_id' => 'Person',
			'judge_id' => 'Judge',
			'mobarat_year' => 'Mobarat Year',
			'project_type' => 'Project Type',
			'type_enable' => 'Type Enable',
			'type_kernel' => 'Type Kernel',
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

		$criteria->compare('judetype_id',$this->judetype_id);
		$criteria->compare('person_id',$this->person_id);
		$criteria->compare('judge_id',$this->judge_id);
		$criteria->compare('mobarat_year',$this->mobarat_year);
		$criteria->compare('project_type',$this->project_type,true);
		$criteria->compare('type_enable',$this->type_enable);
		$criteria->compare('type_kernel',$this->type_kernel);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JudgeType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
