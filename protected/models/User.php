<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $user_mun
 * @property string $user_password
 * @property string $user_type
 * @property integer $user_oldID
 *
 * The followings are the available model relations:
 * @property Person[] $people
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_mun, user_password, user_type', 'required'),
			array('user_oldID', 'numerical', 'integerOnly'=>true),
			array('user_mun, user_password', 'length', 'max'=>50),
			array('user_type', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, user_mun, user_password, user_type, user_oldID', 'safe', 'on'=>'search'),
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
			'people' => array(self::HAS_MANY, 'Person', 'Person_userID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'user_mun' => 'User Mun',
			'user_password' => 'User Password',
			'user_type' => 'User Type',
			'user_oldID' => 'User Old',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_mun',$this->user_mun,true);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('user_type',$this->user_type,true);
		$criteria->compare('user_oldID',$this->user_oldID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
    public static function getNewMun($yr,$userType,$userFlag){
        /*$mobarat=  Mobarat::getOpenMobaratRecord();
        $year = $mobarat['mobarat_year'];
        $yr=  substr($yr, 2);*/
        return User::getNewMunRegYear($userType,$userFlag,$yr);

    }
    
    public static function getNewPass($yr){
		//$password = $yr . '11' . $minute = date('i');
                $password='';
                for ($counter=0;$counter<10;$counter++)
                    $password.= mt_rand (0, 9);
		return $password;
	}
        
    public static function insertNew($yr,$userType,$userFlag)
    {
        $user = new User;
        $yr=  substr($yr, 2);
        $user->user_mun=User::getNewMun($yr,$userType,$userFlag);
        $user->user_type = $userType;
        $user->user_password = User::getNewPass($yr);
        $user->save();
        return $user;
    }

    public static function getNewMunRegYear($userType,$userFlag,$RegYear){
        //Get Missed ID
        
        $Filter='11' . $userFlag . $RegYear;
        
        $rs=Yii::app()->getDB()->createCommand("SELECT convert( SUBSTRING(t1.user_mun,7) ,UNSIGNED INTEGER)+1 AS ID
                                                    FROM user as t1
                                                        left join user as t2 on 
                                                               t1.user_mun+1=t2.user_mun
                                                    where t1.user_mun like '" . $Filter ."%' 
                                                        AND t2.user_mun is null
                                                    order by t1.user_mun limit 1")->queryAll(true);
                                                    
        if(count($rs)>0)
        {
            $maxn=$rs[0]['ID'];
            
        }
       
                                                    
        else {
            $query= "select max(substring(user_mun,7)) as m from user "
                    ." where user_type = '" . $userType."'";
                    
            $maxn=Yii::app()->getDB()->createCommand($query)->queryScalar();
            if($maxn==false)
                $maxn =0;
            
             $maxn++;
             
             echo "<script>alert(".$maxn.")</script>";
             /*
            $criteria = new CDbCriteria;
            $criteria->select = 'max(substring(t.user_mun,7)) as max';
            $criteria->condition = "t.user_type = '" . $userType."'";
            $maxmun = User::model()->find($criteria);

            $maxn = $maxmun[0]['max'];
        
            $maxn++;*/
        }
            
        $strMax=$maxn;
        while (strlen($strMax)<3) {
            $strMax='0'.$strMax;
        }
  
        $mun = $Filter . $strMax;
        return $mun; 
    }
    public static function isOfTeacherParticipant($yr,$userID){
        $query= "select count(user.user_id) as co from user inner join person on user_id=person_userid 
                    inner join person_oteacher on person_oteacher.oteacher_personid=person.Person_id 
                    where mobarat_year=".$yr." and user_id=" . $userID;
                    
        $co=Yii::app()->getDB()->createCommand($query)->queryScalar();
        if($co>0)
            return true;
        return false;
    }
    public static function isTeacherParticipant($yr,$userID){
        $query= "select count(user.user_id) as co from user inner join person on user_id=person_userid 
                    inner join person_teacher on teacher_personid=person.Person_id
                    where mobarat_year=".$yr." and user_id=" . $userID;
                    
        $co=Yii::app()->getDB()->createCommand($query)->queryScalar();
        if($co>0)
            return true;
        return false;
    }
    public static function isJudgeParticipant($yr,$userID){
        $query= "select count(user.user_id) as co from user inner join person on user_id=person_userid 
                    inner join person_judge on judge_personid=person.Person_id
                    where mobarat_year=".$yr." and user_id=" . $userID;
                    
        $co=Yii::app()->getDB()->createCommand($query)->queryScalar();
       
        if($co>0)
            return true;
        return false;
    }
    public static function isStudentParticipant($yr,$userID){
        $query= "select count(user.user_id) as co from user inner join person on user_id=person_userid 
                    inner join person_student on student_personid=person.Person_id 
                    where mobarat_year=".$yr." and user_id=" . $userID;
                    
        $co=Yii::app()->getDB()->createCommand($query)->queryScalar();
        if($co>0)
            return true;
        return false;
    }
    public static function isParticipant($yr,$userID){
        if(User::isOfTeacherParticipant($yr,$userID) 
                || User::isTeacherParticipant($yr,$userID)
                || User::isStudentParticipant($yr,$userID)
                || User::isJudgeParticipant($yr,$userID))
            return true;
        return false;
    }
    
    public static function getPageTree($userID){
        $tr=array();
        $query='select upg_id,upg_page_id,pg_name,upg_allow,pg_code_no,upg_order '
                . ' from page inner join user_page on page.pg_id=user_page.upg_page_id '
                . ' where upg_user_id= '.$userID
                . ' and length(pg_code_no)=2 order by pg_code_no ';
        $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        foreach($rs as $rtemp){
            $tr[]= self::getPageTreeItems($userID,$rtemp);
        }
        return $tr;
    }
    

    
    private static function getPageTreeItems($userID,$r){
        if(!$r)
            return ;
        $arr=array();
        $query="select upg_id,upg_page_id,pg_name,upg_allow,pg_code_no,upg_order "
                . " from page inner join user_page on page.pg_id=user_page.upg_page_id "
                . " where upg_user_id= ".$userID." and pg_code_no like '".$r['pg_code_no']."%'"
                . " and length(pg_code_no)=". (strlen($r['pg_code_no'])+2) ." order by pg_code_no ";
        $rs=Yii::app()->getDB()->createCommand($query)->queryAll(true);
        foreach($rs as $rtemp){
            $arr[]= self::getPageTreeItems($userID,$rtemp);
        }
        $path='User/pageadddelete';
        $t=time();
         if ($r['upg_allow'] == 0) {
                                    $cl = "red";
                                    $clt = "+"; 
                                } else {
                                    $cl = "green";
                                    $clt = "-";
                                }
        //$txt=CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ">' . $r['pg_name'] . '</button>', array($path)
        //                                            , array('update' => '#sp'.$r['upg_id'], 'data' => array('upg_id' => $r['upg_id'],'code_enable'=>$r['upg_allow'])
         //                                               )); 
//        $txt=CHtml::ajaxButton($clt, array($path)
//                                                , array( 'data' => array('upg_id' => $r['upg_id'],'upg_allow'=>$r['upg_allow'])
//                                                    ,'success'=>'function(data){$("#tp'.$r['upg_id'].'").html(data);}')
//                                                    ,array('class' => 'demo-loading-btn btn ' .$cl,'id'=>'btajax_'.$r['upg_id'].$t
//                                        )
//                                                    ).'  '.$r['pg_name'];
                                
         $txt=CHtml::checkBox('ch['.$r['upg_id'].']',$r['upg_allow'],array('value'=>1,'uncheckValue'=>0)).' '.$r['pg_name'];
        if(count($arr)>0){
            $res=array('children'=>$arr,'text'=>$txt,'expanded'=>'true','hasChildren'=>'true'
                //,'htmlOptions'=>array('class'=>'caret')
                );
        }else{
            $res=array('text'=>$txt,'hasChildren'=>'false'
                 //,'htmlOptions'=>array('class'=>'nested')
                );
        }
        return $res;
    }
}
