<?php

/**
 * This is the model class for table "mb_message_detail".
 *
 * The followings are the available columns in table 'mb_message_detail':
 * @property integer $mdetail_id
 * @property integer $mdetail_message
 * @property integer $mdetail_sender
 * @property integer $mdetail_receiver
 *
 * The followings are the available model relations:
 * @property MbUser $mdetailReceiver
 * @property MbMessage $mdetailMessage
 * @property MbUser $mdetailSender
 */
class MbMessageDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MbMessageDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mb_message_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mdetail_message, mdetail_sender, mdetail_receiver', 'required'),
			array('mdetail_message, mdetail_sender, mdetail_receiver', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mdetail_id, mdetail_message, mdetail_sender, mdetail_receiver', 'safe', 'on'=>'search'),
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
			'mdetailReceiver' => array(self::BELONGS_TO, 'MbUser', 'mdetail_receiver'),
			'mdetailMessage' => array(self::BELONGS_TO, 'MbMessage', 'mdetail_message'),
			'mdetailSender' => array(self::BELONGS_TO, 'MbUser', 'mdetail_sender'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mdetail_id' => 'Mdetail',
			'mdetail_message' => 'Mdetail Message',
			'mdetail_sender' => 'Mdetail Sender',
			'mdetail_receiver' => 'Mdetail Receiver',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('mdetail_id',$this->mdetail_id);
		$criteria->compare('mdetail_message',$this->mdetail_message);
		$criteria->compare('mdetail_sender',$this->mdetail_sender);
		$criteria->compare('mdetail_receiver',$this->mdetail_receiver);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}