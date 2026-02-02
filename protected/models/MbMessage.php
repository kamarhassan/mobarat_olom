<?php

/**
 * This is the model class for table "mb_message".
 *
 * The followings are the available columns in table 'mb_message':
 * @property integer $message_id
 * @property string $message_subject
 * @property string $message_content
 * @property string $message_date
 *
 * The followings are the available model relations:
 * @property MbMessageDetail[] $mbMessageDetails
 */
class MbMessage extends CActiveRecord {

    public $to;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MbMessage the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'mb_message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('message_subject, message_content,to', 'required', 'message' => 'إملأ {attribute}'),
            array('message_subject', 'length', 'max' => 100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('message_id, message_subject, message_content, message_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'mbMessageDetails' => array(self::HAS_MANY, 'MbMessageDetail', 'mdetail_message'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'message_id' => 'Message',
            'to' => 'إلى',
            'message_subject' => 'موضوع الرسالة',
            'message_content' => 'محتوى الرسالة',
            'message_date' => 'Message Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('message_id', $this->message_id);
        $criteria->compare('message_subject', $this->message_subject, true);
        $criteria->compare('message_content', $this->message_content, true);
        $criteria->compare('message_date', $this->message_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public static function sendMessage($fromUser,$toUser,$subject,$desc){
        $model = new MbMessage;
        $detail = new MbMessageDetail;
        $model->message_subject = $subject;
        $model->message_content = $desc;
        $model->message_date = date("Y-m-d H:i:s");
        $model->to = 0;
        if ($model->save()) {
            $detail->mdetail_message = $model->message_id;
            $detail->mdetail_receiver = $toUser;
            $detail->mdetail_sender = $fromUser;
            $detail->message_read_flag = 0;
            $detail->save();
        }
    }

}
