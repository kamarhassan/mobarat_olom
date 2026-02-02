<?php

/**
 * This is the model class for table "person_judge".
 *
 * The followings are the available columns in table 'person_judge':
 * @property integer $judge_id
 * @property integer $judge_personid
 * @property integer $mobarat_year
 * @property string $judge_speciality1
 * @property string $judge_speciality2
 * @property string $judge_degree1
 * @property string $judge_degree2
 * @property string $judge_institute
 * @property string $judge_job
 * @property string $judge_stage
 * @property string $judge_registrationStep
 * @property string $confirmation_code
 * @property integer $is_confirmed
 *
 * The followings are the available model relations:
 * @property Person $judgePerson
 * @property Mobarat $mobaratYear
 */
class Personjudge extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'person_judge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('judge_personid, mobarat_year, is_confirmed', 'numerical', 'integerOnly'=>true),
			array('judge_speciality1, judge_speciality2, judge_degree1, judge_degree2, judge_stage, judge_registrationStep', 'length', 'max'=>2),
			array('judge_institute, judge_job', 'length', 'max'=>45),
			array('confirmation_code', 'length', 'max'=>20),
                        array('date_inserted','default','value'=>new CDbExpression('now()'),'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('judge_id, judge_personid, mobarat_year, judge_speciality1, judge_speciality2, judge_degree1, judge_degree2, judge_institute, judge_job, judge_stage, judge_registrationStep, confirmation_code, is_confirmed', 'safe', 'on'=>'search'),
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
			'judgePerson' => array(self::BELONGS_TO, 'Person', 'judge_personid'),
			'mobaratYear' => array(self::BELONGS_TO, 'Mobarat', 'mobarat_year'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'judge_id' => 'Judge',
			'judge_personid' => 'Judge Personid',
			'mobarat_year' => 'Mobarat Year',
			'judge_speciality1' => 'الاختصاص 1',
			'judge_speciality2' => 'الاختصاص 2',
			'judge_degree1' => 'الدرجة العلمية 1',
			'judge_degree2' => 'الدرجة العلمية 2',
			'judge_institute' => 'المؤسسة',
			'judge_job' => 'الوظيفة',
			'judge_stage' => 'مرحلة التحكيم',
			'judge_registrationStep' => 'Judge Registration Step',
			'confirmation_code' => 'Confirmation Code',
			'is_confirmed' => 'Is Confirmed',
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

		$criteria->compare('judge_id',$this->judge_id);
		$criteria->compare('judge_personid',$this->judge_personid);
		$criteria->compare('mobarat_year',$this->mobarat_year);
		$criteria->compare('judge_speciality1',$this->judge_speciality1,true);
		$criteria->compare('judge_speciality2',$this->judge_speciality2,true);
		$criteria->compare('judge_degree1',$this->judge_degree1,true);
		$criteria->compare('judge_degree2',$this->judge_degree2,true);
		$criteria->compare('judge_institute',$this->judge_institute,true);
		$criteria->compare('judge_job',$this->judge_job,true);
		$criteria->compare('judge_stage',$this->judge_stage,true);
		$criteria->compare('judge_registrationStep',$this->judge_registrationStep,true);
		$criteria->compare('confirmation_code',$this->confirmation_code,true);
		$criteria->compare('is_confirmed',$this->is_confirmed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Personjudge the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getCountAllInviteJudge($my) {
             return Personjudge::model()->count('mobarat_year=' . $my);
        }
         public function getCountWaitedJudge($my) {
             return Personjudge::model()->count('mobarat_year=' . $my.' and judge_registrationStep="01"');
        }
        public function getCountAcceptedJudge($my) {
             return Personjudge::model()->count('mobarat_year=' . $my.' and judge_registrationStep="03"');
        }
        
        public function getCountRejectedJudge($my) {
             return Personjudge::model()->count('mobarat_year=' . $my.' and judge_registrationStep="02"');
        }
}
