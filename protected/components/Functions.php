<?php

class Functions {

    private $count;
	
    public function getIsUserRoleForProject($projectID){
    	$role=false;
    	$sId = MbUser::model()->findAll('user_mun=11' . Yii::app()->user->name);
		if (count($sId)>0){
			$id = $sId[0]['user_id'];
			if($sId[0]['user_type']==1){
				$role=true;
			}
			elseif($sId[0]['user_type']==2){
				//echo "2";
				$critiria = new CDbCriteria;
        		$critiria->alias = 't';
        		$critiria->select = 'project_id';
        		$critiria->join = 'JOIN mb_school ON mb_school.school_id = t.project_school';
        		$critiria->condition = 'mb_school.school_user=' . $id . ' AND t.project_id=' . $projectID;
				
				$result = MbProject::model()->findAll($critiria);
				
				if(count($result)>0 ){
					//if ($result[0]['count']>0){
						$role=true;
					//}
					
				}		
			}elseif($sId[0]['user_type']==3){
				
				
				$critiria = new CDbCriteria;
        		$critiria->alias = 't';
        		$critiria->select = 't.student_role ';
				$critiria->join = 'JOIN mb_user ON mb_user.user_id = t.student_user';
				$critiria->join .= ' JOIN mb_project_registration ON mb_project_registration.pregistration_user = mb_user.user_id';
        		//$critiria->join = 'JOIN mb_project_registration ON mb_project_registration.pregistration_project = t.project_id';
        		
        		//$critiria->join .= ' JOIN mb_student on mb_user.user_id = mb_student.student_user';
        		$critiria->condition = 'mb_user.user_id=' . $id . ' AND mb_project_registration.pregistration_project=' . $projectID;
				
				$result = MbStudent::model()->findAll($critiria);
				
				if(count($result)>0 && $result[0]['student_role']==true){
					$role=true;
				}	
			}elseif($sId[0]['user_type']==4){
				$critiria = new CDbCriteria;
        		$critiria->alias = 't';
        		$critiria->select = 't.project_school ';
        		$critiria->join = 'JOIN mb_project_registration ON mb_project_registration.pregistration_project = t.project_id';
        		$critiria->join .= ' JOIN mb_user ON mb_project_registration.pregistration_user = mb_user.user_id';
        		$critiria->join .= ' JOIN mb_teacher on mb_user.user_id = mb_teacher.teacher_user';
        		$critiria->condition = 'mb_user.user_id=' . $id  . ' AND t.project_id=' . $projectID;
				
				$result = MbProject::model()->findAll($critiria);
				
				if(count($result)>0){
					$role=true;
				}	
			}
        	
		}
      

        return $role;
    }

	public function getProjectRegistrationProgress($projectID){
		$progress=34;
		//$projData = mbProjectDetail::model()->loadModel($projectID);
		$projData=MbProjectDetail::model()->findByAttributes(array('pdetail_project' => $projectID));
		if ($projData->pdetail_help != NULL)
             $progress += 11;
        if ($projData->pdetail_description != NULL)
             $progress += 11;
        if ($projData->pdetail_goal != NULL)
             $progress += 11;
        if ($projData->pdetail_tools != NULL)
             $progress += 11;
        if ($projData->pdetail_steps != NULL)
             $progress += 11;
        if ($projData->pdetail_attachment != NULL)
             $progress += 11;
		return $progress;
	}
	public function getSchoolRegistrationProgress(){
		$progress=0;
		$projectProgress=0;
		$pas=100.00;
		$schoolID=$this->getSchoolId();
		$year=$this->getYear();
		
		
    
        $projects = MbProject::model()->findAll('project_school=' . $schoolID . ' AND year=' . $year );
		if(count($projects)>0){
			$pas=$pas/count($projects)/3;
			foreach ($projects as $proj) {
				
				
				$projectID=$proj->project_id;
				$projectProgress=$this->getProjectRegistrationProgress($projectID);
				$progress=$progress+$pas*$projectProgress/100.0;
				
				
				$critiria = new CDbCriteria;
        		$critiria->alias = 't';
        		$critiria->select = 'count(*) as count';
        		$critiria->join = 'JOIN mb_project ON t.pregistration_project = mb_project.project_id';
        		$critiria->join .= ' JOIN mb_user ON t.pregistration_user = mb_user.user_id';
        		$critiria->join .= ' JOIN mb_teacher on mb_user.user_id = mb_teacher.teacher_user';
        		$critiria->condition = 'mb_project.project_id ='. $projectID .' and mb_project.project_school=' . $schoolID . ' AND mb_teacher.year=' . $year . ' AND mb_user.user_type=4 AND (mb_teacher.teacher_flag=1 OR mb_teacher.teacher_flag=0)';

        		$result = MbProjectRegistration::model()->findAll($critiria);
				
				if(($result[0]->count)>0){
					$progress=$progress+$pas;
				}
				
				$critiria = new CDbCriteria;
		        $critiria->alias = 't';
		        $critiria->select = 'count(*) as count';
		        $critiria->join = 'JOIN mb_project ON t.pregistration_project = mb_project.project_id';
		        $critiria->join .= ' JOIN mb_user ON t.pregistration_user = mb_user.user_id';
		        $critiria->join .= ' JOIN mb_student on mb_user.user_id = mb_student.student_user';
		        $critiria->condition = 'mb_project.project_id ='. $projectID .' and mb_project.project_school=' . $schoolID . ' AND mb_student.year=' . $year . ' AND mb_user.user_type=3 AND (mb_student.student_flag=1 OR mb_student.student_flag=0)';
		
		        $result = MbProjectRegistration::model()->findAll($critiria);
		
		        if(($result[0]->count)>0){
					$progress=$progress+$pas;
				}
				
			} 
		}
       return intval($progress);
        
    }
	/*public function getLastOfficialTeacher($schoolid){
		$criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->select = 'max(oteacher_id) as max';
        $criteria->condition = 't.oteacher_school=' . $schoolid ;
		
        $max = MbOfficialTeacher::model()->findAll($criteria);
        $t = MbOfficialTeacher::model()->findByAttributes(array('oteacher_id' => $max[0]['max']));
        //$t = MbOfficialTeacher::model()->findAll('oteacher_id ='. $max[0]['max']);
		
		return $t;
	}*/
    public function getCountMotawasetProject(){ //school id
    $n = new Functions;
        $sanawi = MbProject::model()->findAll('project_school=' . $n->getSchoolId() . ' AND year=' . $n->getYear() . ' AND project_stage=1');
       return $nb = count($sanawi);
        
    }
    /*
	public function getNewPass(){
		$password = $this->getRegYear() . '11' . $minute = date('i');
		return $password;
	}
    */
    /*
	public function getNewMun($userType,$userFlag){
	    return $this->getNewMunRegYear($userType,$userFlag,$this->getRegYear());

	}

    public function getNewMunRegYear($userType,$userFlag,$RegYear){
        //Get Missed ID
        
        $Filter=MbUsertype::lebanonCoutry . $userFlag . $RegYear;
        
        $rs=Yii::app()->getDB()->createCommand("SELECT convert( SUBSTRING(t1.user_mun,7) ,UNSIGNED INTEGER)+1 AS ID
                                                    FROM mb_user as t1
                                                        left join mb_user as t2 on 
                                                               t1.user_mun+1=t2.user_mun
                                                    where t1.user_mun like '" . $Filter ."%' 
                                                        AND t2.user_mun is null
                                                    order by t1.user_mun limit 1")->queryAll(true);
                                                    
       if(count($rs)>0)
        {
            $maxn=$rs[0]['ID'];
            
        }
       
                                                    
        else {
            
            $criteria = new CDbCriteria;
            $criteria->select = 'max(substring(t.user_mun,7)) as max';
            $criteria->condition = 't.user_type = ' . $userType;
            $maxmun = MbUser::model()->find($criteria);

            $maxn = $maxmun['max'];
        
            $maxn++;
        }
            
        $strMax=$maxn;
        while (strlen($strMax)<3) {
            $strMax='0'.$strMax;
        }
  
        $mun = $Filter . $strMax;
        return $mun;
                    
        
      
    }
*/
    
    public function getCountSanawiProject(){ //school id
    $n = new Functions;
        $sanawi = MbProject::model()->findAll('project_school=' . $n->getSchoolId() . ' AND year=' . $n->getYear() . ' AND project_stage=2');
       return $nb = count($sanawi);
        
    }
    
    public function isExtraProject(){
         $n = new Functions;
         $school = MbSchool::model()->findAll('school_id=' . $n->getSchoolId());
         if($school[0]['extraProject']==0)
         return false;
         
         return true;
    }
    
    public function isGoldTrophy(){
        $n = new Functions;
        $lastYear = $n->getYear() - 1;
        $trophy = MbProject::model()->findAll('project_school=' . $n->getSchoolId() . ' AND prize=1 AND year=' . $lastYear);
         if(count($trophy)==0)
            return false;
        return true;
    }
    
    public function numberProjects(){
        $n = new Functions;
        $trophy = MbProject::model()->findAll('project_school=' . $n->getSchoolId() . ' AND prize=1 AND year=' . $lastYear);

    }

    /*public function getYear() {
        //$year = Years::model()->findAll('type=1');
        
        $year = Mobarat::model()->findAll('openForRegistration=true');
        if(count($year)>0)
            return $year[0]['mobarat_year'];
        else
            return '0';
        return Mobarat::getMaxYear();
    }*/
    
    
    
    
/*
    public function getRegYear() {
        $year = Years::model()->findAll('type=2');
        return $year[0]['year'];
    }
    
  */     

    /*public function getMaxNumberOfProject() {
        $year = Years::model()->findAll('type=3');
        return $year[0]['year'];
    }*/

    public function getOldSchool() {
        $sql = MbSchool::model()->findAll('school_flag=2');
        return ($sql);
    }

    //count projects of school
    /*
    public function getCountProjectSchool() {
        $n = new Functions();
        $sId = MbProject::model()->findAll('project_school=' . $n->getSchoolId() . ' AND year=' . $n->getYear());

        return count($sId);
    }
     * 
     */


    //count pending schools
    /*public function getCoutingPendingSchool() {
        $n = new Functions;
        $penSchool = MbSchool::model()->findAll('(school_flag!=1 AND school_flag!=6 AND school_flag!=2 AND school_flag!=8)');// and year=' . $n->getYear());
        return count($penSchool);
    }*/

    //count confirmed schools
    /*
    public function getCoutingConfirmedSchool() {
        $n = new Functions;
        $ConSchool = MbSchool::model()->findAll('school_flag=1');// and year=' . $n->getYear());
        return count($ConSchool);
    }*/
    
     //count confirmed Private schools
    /*
    public function getCoutingConfirmedPrivateSchool() {
        $n = new Functions;
        $ConSchool = MbSchool::model()->findAll('school_flag=1 and description="خاص"');// and year=' . $n->getYear());
        return count($ConSchool);
    }
    */
     //count confirmed Public schools
    /*
    public function getCoutingConfirmedPublicSchool() {
        $n = new Functions;
        $ConSchool = MbSchool::model()->findAll('school_flag=1 and description="رسمي"');// and year=' . $n->getYear());
        return count($ConSchool);
    }*/
    /*
    public function getCoutingConfirmedSchoolPrecedentYear(){
        $criteria = new CDbCriteria;
        //$criteria->select = 'count(distinct school_id) as count';
        $criteria->select = 'distinct school_id';
        $criteria->alias = 't';
        //$criteria->with = 'mb_project';
       
        $criteria->join = 'JOIN mb_project on t.school_id=mb_project.project_school';
        $criteria->condition = 'school_flag=1 and mb_project.year=t.year-1' ;
        $maxmun = MbSchool::model()->findAll($criteria);
        
        return count($maxmun);

       
    }
    
     public function getCoutingConfirmedSchoolOldYear(){
        $criteria = new CDbCriteria;
        //$criteria->select = 'count(distinct school_id) as count';
        $criteria->select = 'distinct school_id';
        $criteria->alias = 't';
        //$criteria->with = 'mb_project';
       
        $criteria->join = 'JOIN mb_project on t.school_id=mb_project.project_school';
        $criteria->condition = 'school_flag=1 ' ;
        $maxmun = MbSchool::model()->findAll($criteria);
        
        return count($maxmun);

       
    }*/
/*
    public function getCoutingConfirmedSchoolNew(){
               
        return $this->getCoutingConfirmedSchool() -  $this->getCoutingConfirmedSchoolOldYear();

       
    }*/
    
    public function getCoutingProject($ptype_id){
        
       $criteria = new CDbCriteria;
        //$criteria->select = 'count(distinct school_id) as count';
        $criteria->select = ' ptype_id';
        $criteria->alias = 't';
        //$criteria->with = 'mb_project';
       
        $criteria->join = 'JOIN mb_project on  mb_project.project_type=t.ptype_id';
        $criteria->condition = 'year= ' . $this->getYear() . ' and ptype_id='. $ptype_id;
        $maxmun = MbProjectType::model()->findAll($criteria);
        
        return count($maxmun);

       //return 0;
    }

    //count teacher of school
    /*
    public function getCountTeacherSchool() {

        $n = new Functions();

        $critiria = new CDbCriteria;
        $critiria->alias = 't';
        $critiria->select = 'count(*) as count';
        $critiria->join = 'JOIN mb_project ON t.pregistration_project = mb_project.project_id';
        $critiria->join .= ' JOIN mb_user ON t.pregistration_user = mb_user.user_id';
        $critiria->join .= ' JOIN mb_teacher on mb_user.user_id = mb_teacher.teacher_user';
        $critiria->condition = 'mb_project.project_school=' . $n->getSchoolId() . ' AND mb_teacher.year=' . $n->getYear() . ' AND mb_user.user_type=4 AND (mb_teacher.teacher_flag=1 OR mb_teacher.teacher_flag=0)';

        $result = MbProjectRegistration::model()->findAll($critiria);

        foreach ($result as $h) {
            return $h->count;
        }
    }

    //count student of school
    public function getCountStudentSchool() {

        $n = new Functions();

        $critiria = new CDbCriteria;
        $critiria->alias = 't';
        $critiria->select = 'count(*) as count';
        $critiria->join = 'JOIN mb_project ON t.pregistration_project = mb_project.project_id';
        $critiria->join .= ' JOIN mb_user ON t.pregistration_user = mb_user.user_id';
        $critiria->join .= ' JOIN mb_student on mb_user.user_id = mb_student.student_user';
        $critiria->condition = 'mb_project.project_school=' . $n->getSchoolId() . ' AND mb_student.year=' . $n->getYear() . ' AND mb_user.user_type=3 AND (mb_student.student_flag=1 OR mb_student.student_flag=0)';

        $result = MbProjectRegistration::model()->findAll($critiria);

        foreach ($result as $h) {
            return $h->count;
        }
    }
*/
    public function getSchoolName() {
        $sId = MbUser::model()->findAll('user_mun=11' . Yii::app()->user->name);
        $id = $sId[0]['user_id'];
        $cProj = MbSchool::model()->findAll('school_user=' . $id);

        return $cProj[0]['school_name'];
    }

    public function getMUN($id) {
        $us = MbUser::model()->findAll('user_id=' . $id);
        return $us[0]['user_mun'];
    }

    public function getSchoolId() {
    	$schoolID=0;
        $sId = MbUser::model()->findAll('user_mun=11' . Yii::app()->user->name);
		if (count($sId)>0){
			$id = $sId[0]['user_id'];
			if($sId[0]['user_type']==2){
				$cProj = MbSchool::model()->findAll('school_user=' . $id);
				if(count($cProj)>0){
					$schoolID=$cProj[0]['school_id'];
				}	
			}elseif($sId[0]['user_type']==3){
				
				
				$critiria = new CDbCriteria;
        		$critiria->alias = 't';
        		$critiria->select = 't.project_school ';
        		$critiria->join = 'JOIN mb_project_registration ON mb_project_registration.pregistration_project = t.project_id';
        		$critiria->join .= ' JOIN mb_user ON mb_project_registration.pregistration_user = mb_user.user_id';
        		$critiria->join .= ' JOIN mb_student on mb_user.user_id = mb_student.student_user';
        		$critiria->condition = 'mb_user.user_id=' . $id . ' AND mb_student.year=' . $this->getYear();
				
				$result = MbProject::model()->findAll($critiria);
				
				if(count($result)>0){
					$schoolID=$result[0]['project_school'];
				}	
			}elseif($sId[0]['user_type']==4){
				$critiria = new CDbCriteria;
        		$critiria->alias = 't';
        		$critiria->select = 't.project_school ';
        		$critiria->join = 'JOIN mb_project_registration ON mb_project_registration.pregistration_project = t.project_id';
        		$critiria->join .= ' JOIN mb_user ON mb_project_registration.pregistration_user = mb_user.user_id';
        		$critiria->join .= ' JOIN mb_teacher on mb_user.user_id = mb_teacher.teacher_user';
        		$critiria->condition = 'mb_user.user_id=' . $id . ' AND mb_teacher.year=' . $this->getYear();
				
				$result = MbProject::model()->findAll($critiria);
				
				if(count($result)>0){
					$schoolID=$result[0]['project_school'];
				}	
			}
        	
		}
      

        return $schoolID;
    }

    public static function getInfo($condition, $id) {
        $student = MbStudent::model()->findAll($condition . '=' . $id);
        return $student;
    }

    public static function getProjectReg($condition, $id) {
        $projet = MbProjectRegistration::model()->findAll($condition . '=' . $id);
        return $projet;
    }

    public static function getProject($condition, $id) {
        $projet = MbProject::model()->findAll($condition . '=' . $id);
        return $projet;
    }

    public static function getProjectDetail($condition, $id) {
        $projet = MbProjectDetail::model()->findAll($condition . '=' . $id);
        return $projet;
    }

    //get n umber of all projects
    /*
    public function getCountAllProject() {
        $n = new Functions;
        $pro = MbProject::model()->findAll('year=' . $n->getYear());
        return count($pro);
    }
*/
    //get number of teachers
    /*
    public function getCountAllTeacher() {
        $n = new Functions;
        $teach = MbTeacher::model()->findAll('(teacher_flag=1 OR teacher_flag=0) and year=' . $n->getYear());
        return count($teach);
    }*/

    //get number of student
    /*
    public function getCountAllStudent() {
        $n = new Functions;
        $std = MbStudent::model()->findAll('(student_flag=1 OR student_flag=0) and year=' . $n->getYear());
        return count($std);
    }
*/


    public function alert() {
        $message = "hiiii";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

}

?>
