<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $project_id
 * @property integer $mobarat_year
 * @property integer $school_id
 * @property string $project_name
 * @property string $project_type
 * @property string $project_stage
 * @property string $project_path
 * @property string $project_prize
 * @property string $project_description
 * @property string $project_goal
 * @property string $project_tools
 * @property string $project_steps
 * @property string $project_attachment
 * @property integer $project_oldid
 *
 * The followings are the available model relations:
 * @property Mobarat $mobaratYear
 * @property School $school
 * @property ProjectStudent[] $projectStudents
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mobarat_year, school_id, project_name,project_name_en, project_type, project_stage', 'required'),
			array('mobarat_year, school_id, project_oldid', 'numerical', 'integerOnly'=>true),
			array('project_name,project_name_en', 'length', 'max'=>250),
                        array('project_name_en', 'CRegularExpressionValidator', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => '{attribute} يجب أن يكون باللغة الإنكليزية'),
                        array('project_name', 'CRegularExpressionValidator', 'pattern' => '/^[\s\p{Arabic}\ـ\-\َ\ً\ٌ\ُ\ٍ\ِ\(\)]+$/u', 'message' => '{attribute} باللغة العربية'),
			array('project_type, project_stage, project_path, project_prize', 'length', 'max'=>2),
			array('project_tools', 'length', 'max'=>5000),
			array('project_attachment', 'length', 'max'=>50),
			array('project_description, project_goal, project_steps', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('project_id, mobarat_year, school_id, project_name,project_name_en, project_type, project_stage, project_path, project_prize, project_description, project_goal, project_tools, project_steps, project_attachment, project_oldid', 'safe', 'on'=>'search'),
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
			'mobaratYear' => array(self::BELONGS_TO, 'Mobarat', 'mobarat_year'),
			'school' => array(self::BELONGS_TO, 'School', 'school_id'),
			'projectStudents' => array(self::HAS_MANY, 'ProjectStudent', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'project_id' => 'Project',
			'mobarat_year' => 'Mobarat Year',
			'school_id' => 'School',
			'project_name' => 'إسم المشروع بالعربي',
                        'project_name_en'=>'إسم المشروع بالأجنبي',
			'project_type' => 'الفئة',
			'project_stage' => 'المرحلة',
			'project_path' => 'مسار البحث',
			'project_prize' => 'الجائزة',
			'project_description' => 'الوصف',
			'project_goal' => 'الهدف',
			'project_tools' => 'الأدوات',
			'project_steps' => 'الخطوات',
			'project_attachment' => 'مرفقات',
			'project_oldid' => 'Project Oldid',
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

		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('mobarat_year',$this->mobarat_year);
		$criteria->compare('school_id',$this->school_id);
		$criteria->compare('project_name',$this->project_name,true);
		$criteria->compare('project_type',$this->project_type,true);
		$criteria->compare('project_stage',$this->project_stage,true);
		$criteria->compare('project_path',$this->project_path,true);
		$criteria->compare('project_prize',$this->project_prize,true);
		$criteria->compare('project_description',$this->project_description,true);
		$criteria->compare('project_goal',$this->project_goal,true);
		$criteria->compare('project_tools',$this->project_tools,true);
		$criteria->compare('project_steps',$this->project_steps,true);
		$criteria->compare('project_attachment',$this->project_attachment,true);
		$criteria->compare('project_oldid',$this->project_oldid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getCountAllProject($my) {
            return Project::model()->count('mobarat_year=' . $my);
        }
        
        public function projectStats($my){
            $query= "select (select count(project_type) from project where code_no=project_type and mobarat_year=".$my.")  as co"
                    . ",code_name as tname from codes where code_kind=111";
                    
           $mbrs=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);
           
               return $mbrs;
        }
        
    public static function getCountProjectSchool($yr,$sclID) {
        return Project::model()->count('mobarat_year=' . $yr .' and school_id='.$sclID);
    }
    
    public static function getProjectTypeSchool($yr,$sclID) {
        $query="select group_concat( (select code_name from codes where code_kind=111 and code_no=project_type) SEPARATOR '\n') from project where project.school_id=".$sclID." and project.mobarat_year=".$yr;
        $mbrs=Yii::app()->getDB()->createCommand($query)->queryScalar();
        if($mbrs!=false)
            return $mbrs;
        else
           return '';
       
    }
    
    public static function getProgress($prj){
        $progress=45;
        if($prj['project_description'] != NULL && strlen(trim($prj['project_description']))>0)
            $progress+=11;
        if($prj['project_goal'] != NULL && strlen(trim($prj['project_goal']))>0)
            $progress+=11;
        if($prj['project_tools'] != NULL && strlen(trim($prj['project_tools']))>0)
            $progress+=11;
        if($prj['project_steps'] != NULL && strlen(trim($prj['project_steps']))>0)
            $progress+=11;
        if($prj['project_attachment'] != NULL && strlen(trim($prj['project_attachment']))>0)
            $progress+=11;
        return $progress;
    }
    
    public static function calculateGrade($prjid){
        $query= "SELECT project_judge.project_id,rated,grade,project_judge.judge_id,type_kernel,type_enable FROM project_judge
                    inner join project on project.project_id=project_judge.project_id
                    inner join judge_type on project_judge.judge_id=judge_type.judge_id and project.project_type= judge_type.project_type
                    where rated=1 and project_judge.project_id=".$prjid;
                    
        $prjs=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);
        $total=0;
        $totalKernel=0;
        $ct=0;
        $ctkernel=0;
        $coef=0;
        
        foreach ($prjs as $prj){
            if($prj['type_kernel']==1){
                $ctkernel++;
                $totalKernel+=$prj['grade'];
            }else{
                $ct++;
                $total+=$prj['grade'];
            }
        }
        $coef=$ct;
        if($coef>4)
            $coef=4;
        $tcoef=0;
        $avg=0;
        if($ct>0)
            $tcoef+=$total/$ct*$coef/10;
        if($ctkernel>0)
            $tcoef+=$totalKernel/$ctkernel*(1-$coef/10);
        if(($ct+$ctkernel)>0)
            $avg=($total+$totalKernel)/($ct+$ctkernel);
            
        
        $sql="update project set date_grade_lastupdate=now(), total_grade=".$avg.", total_grade_coef=".$tcoef.",total_judge=".$ct.",total_judgekernel=".$ctkernel." where project_id=".$prjid;
                   
        $query = Yii::app()->db->createCommand($sql);
        $success=$query->execute();
        
        
    }
    
    public static function calculateGradeAll(){
        $query= "SELECT project_id
                    FROM project
                    where mobarat_year=2021
                     and  project_id in (select project_id from project_judge where mobarat_year=2021 and rated=1)";
                    
        $prjs=Yii::app()->getDB()->createCommand($query)->queryAll(TRUE);
       
        
        foreach ($prjs as $prj){
            Project::calculateGrade($prj['project_id']);
        }
       
        
        
    }
    
}
