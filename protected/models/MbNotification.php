<?php

/**
 * This is the model class for table "mb_notification".
 *
 * The followings are the available columns in table 'mb_notification':
 * @property integer $notification_id
 * @property integer $sender_id
 * @property string $notification_time
 * @property string $notification_date
 * @property string $notification_content
 *
 * The followings are the available model relations:
 * @property NotificationReceived[] $notificationReceiveds
 */
class MbNotification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mb_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender_id, notification_time, notification_date, notification_content', 'required'),
			array('sender_id', 'numerical', 'integerOnly'=>true),
			array('notification_content', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('notification_id, sender_id, notification_time, notification_date, notification_content', 'safe', 'on'=>'search'),
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
			'notificationReceiveds' => array(self::HAS_MANY, 'NotificationReceived', 'notification_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'notification_id' => 'Notification',
			'sender_id' => 'Sender',
			'notification_time' => 'Notification Time',
			'notification_date' => 'Notification Date',
			'notification_content' => 'Notification Content',
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

		$criteria->compare('notification_id',$this->notification_id);
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('notification_time',$this->notification_time,true);
		$criteria->compare('notification_date',$this->notification_date,true);
		$criteria->compare('notification_content',$this->notification_content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MbNotification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
    private static function insertNotification($msg)
    {
        $notification = new MbNotification;

        date_default_timezone_set('Asia/Beirut');
        $notification->sender_id = 1;
        $notification->notification_time = date('H:i:s');
        $notification->notification_date = date('Y-m-d');
        $notification->notification_content =$msg ;
        $notification->save();
        return $notification->notification_id;
    }
    
    private static function insertNotificationRec($nid,$usrid)
    {
        $notificationRec = new NotificationReceived;
        $notificationRec->notification_id = $nid;
        $notificationRec->user_id = $usrid;
        $notificationRec->flag = 0;
        $notificationRec->save();
    }
    
    public static function sendNotificationToUser($usrid,$msg)
    {
        $nid=  MbNotification::insertNotification($msg);
        MbNotification::insertNotificationRec($nid,$usrid);
        
    }
    
    public static function sendNotificationByuserType($usrType,$msg)
    {
        $nid=  MbNotification::insertNotification($msg);
        $userRec = User::model()->findAll("user_type = '".$usrType."'");

        foreach ($userRec as $ur) {
             MbNotification::insertNotificationRec($nid,$ur->user_id);
        }
    }
    
    public static function sendNotificationByProjectID($pid,$msg)
    {
        $nid= MbNotification::insertNotification($msg);
        
        
        $query="select person_userID from project_teacher inner join person "
                . "  on project_teacher.person_id=person.Person_id "
                . "     where project_id=".$pid;
        $userRec=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        foreach ($userRec as $ur) {
             MbNotification::insertNotificationRec($nid,$ur['person_userID']);
        }
        
        $query="select person_userID from project_student inner join person "
                . " on project_student.person_id=person.Person_id "
                . " where project_id=".$pid;
        $userRec=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        foreach ($userRec as $ur) {
             MbNotification::insertNotificationRec($nid,$ur['person_userID']);
        }

    }
}
