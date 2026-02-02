<div class="col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption"><i class="icon-bar-chart"></i>تقرير</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="note note-success">
                <p>
                    List All Teachers
                </p>
            </div>
            <div class="table-scrollable">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>حذف</th>
                            
                            <td>MUN</td>
                            <td>Teacher ID</td>
                            <td>Project ID</td>
                            <td>School ID</td>
                            <th>الإسم</th>
                            <th>الجنس</th>
                            <td>البريد الإلكتروني</td>
                            <th>الدرجة</th>
                            <th>الهاتف</th>

                        </tr>
                    </thead>
                    <tbody>
                    	
                        <?php
                        $eo = 0;
                        foreach ($model as $p) 
                        {
//$p=$model[count($model)-1];
                            $eo++;
							$registrationProject="";
							$subMUN="";
							$projectschool="";
                            if ($eo % 2 == 0)
                                $cl = "even";
                            else
                                $cl = "odd";
                            ?>
                            <tr <?php if ($cl == "even") {
                                ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >
                                    <?php 
										
                                  
                                   
                                    ?>
                                    <?php 
                                    	$user = MbUser::model()->findAll('user_id= ' . $p->teacher_user); 
                                       	if (count($user>0)){
                                    	   	$subMUN = substr($user[0]['user_mun'], 2); 
											$projreg = MbProjectRegistration::model()->findAll('pregistration_user= '.$user[0]['user_id']);
                                    		if(count($projreg)>0){
                                    			$registrationProject=$projreg[0]['pregistration_project']; 
												$project = MbProject::model()->findAll('project_id= '.$projreg[0]['pregistration_project']);
												if(count($project))
													$projectschool=$project[0]['project_school'];
                                    		}
                                    	}
											
                                    ?>

                                <td>
                                    <?php echo CHtml::ajaxLink('<button type="button"  class="btn red">
          <i class="icon-remove"></i>
        </button>', array('MbAdmin/DeleteTeacher'), array('data' => array('id' => $p->teacher_id)), array('confirm' => 'متأكد من حذف الاستاذ؟')); ?>



                                </td>
                                <td><?php echo $subMUN; 
                                	?>
                                	
                                </td>
                                  <td><?php echo $p->teacher_id; ?></td>
                                <td><?php echo $registrationProject;//echo $projreg[0]['pregistration_project']; 
                                	?></td>
                                <td><?php echo $projectschool;//echo $project[0]['project_school'];
                                ?>
                                </td>
                                <td>  <?php echo $p->teacher_fname . " " . $p->teacher_lname; 
                                	?> </td>
                                <td><?php echo $p->teacher_sex; ?></td>
                                <td><?php echo $p->teacher_email; ?></td>
                                <td><?php echo $p->teacher_levelstudy; ?></td>
                                <td><?php echo $p->teacher_phone; ?></td>




                            </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>