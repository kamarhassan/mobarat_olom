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
                    List All Students
                </p>
            </div>
            <div class="table-scrollable">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>حذف</th>
                            <td>MUN</td>
                            <td>Student ID</td>
                            <td>year</td>
                            <td>Project ID</td>
                            <td>School ID</td>
                            <th>الإسم</th>
                            <th>الجنس</th>
                            <th>البريد الإلكتروني</th>
                            <th> الصف</th>
                            <th>الهاتف</th>
                            <th>تاريخ الولادة</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $eo = 0;
                        foreach ($model as $p) {

                            $eo++;
                            if ($eo % 2 == 0)
                                $cl = "even";
                            else
                                $cl = "odd";
                            ?>
                            <tr <?php if ($cl == "even") {
                                ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >
                                    <?php
                                     $user = MbUser::model()->findAll('user_id= ' . $p->student_user); 
                                     
                                     $subMUN = substr($user[0]['user_mun'], 2);
									 $projreg = MbProjectRegistration::model()->findAll('pregistration_user= '.$user[0]['user_id']);
									 if(count($projreg)>0){
									 	$project = MbProject::model()->findAll('project_id= '.$projreg[0]['pregistration_project']);
									 }else{
									 	$project=null;
									 }
                                     
								?>
                                <td>
                                    <?php echo CHtml::ajaxLink('<button type="button"  class="btn red">
          <i class="icon-remove"></i>
        </button>', array('MbAdmin/DeleteStudent'), array('data' => array('id' => $p->student_id)), array('confirm' => 'متأكد من حذف المدرسة؟')); ?>



                                </td>

                                <td><?php echo $subMUN; ?></td>
                                 <td><?php echo $p->student_id; ?></td>
                                 <td><?php echo $p->year; ?></td>
                                <td><?php //
                                		if(count($projreg)>0){
                                			echo $projreg[0]['pregistration_project']; 
										}
                                	?></td>
                                <td><?php //echo $project[0]['project_school'];
                                			if(isset($project) && count($project)>0){
                                				echo $project[0]['project_school'];
											}
                                		?>
                                </td>
                                <td>  <?php echo $p->student_fname . " " . $p->student_lname; ?> </td>
                                <td><?php echo $p->student_sex; ?></td>
                                <td><?php echo $p->student_email; ?></td>
                                <?php if ($p->student_class == null) { ?>
                                    <td></td>
                                    <?php
                                } else {
                                    ?>
                                    <td><?php echo $p->studentClass->class_name; ?></td>
                                <?php } ?>
                                <td><?php echo $p->student_phone; ?></td>
                                <td><?php echo $p->student_birthdate; ?></td>



                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>