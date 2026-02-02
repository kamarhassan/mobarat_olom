<?php

/**
 * This is the model class for table "project_teacher".
 *
 * The followings are the available columns in table 'project_teacher':
 * @property integer $project_teacher_id
 * @property integer $project_id
 * @property integer $teacher_id
 * @property integer $person_id
 * @property integer $oldid
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property Personteacher $teacher
 * @property Person $person
 */
class ProjectTeacher extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project_teacher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, teacher_id, person_id, oldid', 'numerical', 'integerOnly'=>true),
                        array('date_inserted','default','value'=>new CDbExpression('now()'),'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('project_teacher_id, project_id, teacher_id, person_id, oldid', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'teacher' => array(self::BELONGS_TO, 'Personteacher', 'teacher_id'),
			'person' => array(self::BELONGS_TO, 'Person', 'person_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'project_teacher_id' => 'Project Teacher',
			'project_id' => 'Project',
			'teacher_id' => 'Teacher',
			'person_id' => 'Person',
			'oldid' => 'Oldid',
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

		$criteria->compare('project_teacher_id',$this->project_teacher_id);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('teacher_id',$this->teacher_id);
		$criteria->compare('person_id',$this->person_id);
		$criteria->compare('oldid',$this->oldid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProjectTeacher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
