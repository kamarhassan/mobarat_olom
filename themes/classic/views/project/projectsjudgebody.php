<script language="javascript">
    
    function InitPage(){
        //var id='10302';
        //var temp=pers_selected.replace(/][/g,",");
       /* var temp=pers_selected.substring(1);
        temp=temp.substring(0,temp.length -1);
        var ids=temp.split("][");
        for(var i=0;i<ids.length;i++){
            //alert(ids[i]);
            var che = document.getElementById('check_' + ids[i]);
            if (che){
                  che.checked=true;
            }
        }*/

    }
    
</script>
<?php 
    $baseUrl = Yii::app()->theme->baseUrl; 
   
    echo $clspaginator->summary ();
            $t=time();
?>

<div class="row">


    <div class="col-md-12">
        <div class="portlet box blue">
           
            <div class="portlet-body">
              
                <div class="table-scrollable">
                    <table class="table table-bordered">
                        <thead>
                            <tr  >
                               
                                <th>تحديد</th>
                                <th>طباعة</th>
                                <th>المدرسة</th>
                                <th>اسم المشروع</th>
                                <th>الجناح</th>
                                <th>الفئة</th>
                                <th>المرحلة</th>
                                <th>عدد الحكام</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $eo = 0;
							$oddOrEven="even";
							/*$fun=new Functions;
							$progress=0;*/
							

                            foreach ($project->data as $p) {
                                
				
                                $eo++;
                                if ($eo % 2 == 0)
                                    $oddOrEven = "even";
                                else
                                    $oddOrEven = "odd";
                                //$projData = MbProjectDetail::model()->findByAttributes(array('pdetail_project' => $p->project_id));
                                ?>
                                <tr  <?php if ($oddOrEven == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
                                   
                                 
                                    <td><?php 
                                    
                                if ($p['checked'] == 1) {
                                    $cl = "red";
                                    $clt = "حذف"; 
                                } else {
                                    $cl = "green";
                                    $clt = "إضافة";
                                }
                                $path = "Project/projectjudgeadddelete";
                                ?>


                                <div <?php echo "id=\"tp". $p['project_id'] ."\""
                                ?>>
                                <?php
                                //echo $p['project_id'];
                                /*echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                                , array('update' => '#tp'.$p['project_id'], 'data' => array('project_id' => $p['project_id'],'judge_id'=>$judge_id,'checked'=>$p['checked']))
                                                    ,array('confirm'=>'Are You Sure?')
                                                    ); */
                                echo CHtml::ajaxButton($clt, array($path)
                                                , array( 'data' => array('project_id' => $p['project_id'],'judge_id'=>$judge_id,'checked'=>$p['checked'])
                                                    ,'success'=>'function(data){$("#tp'.$p['project_id'].'").html(data);}')
                                                    ,array('class' => 'demo-loading-btn btn ' .$cl,'id'=>'btajax_'.$p['project_id'].$t
                                        )
                                                    ); ?>
                                </div>
                        
                        </td>
                        <td>
                            <a href="<?php echo $this->createAbsoluteUrl('Project/projectprintforjudge/'. $p['project_id'] ); ?>" target="_blank"  class="btn green icon-print"></a> 
                        </td>
                                    <td><?php echo $p['school_name']; ?></td>
                                    
                                    <td><?php echo $p['project_name']; ?></td>
                                    <td><?php echo $p['halls'].$p['suite']; ?></td>
                                    <td><?php echo $p['project_type']; ?></td>
                                    <td><?php echo $p['project_stage']; ?></td>

                                    <td><?php echo $p['judcount']; ?></td>
                                   

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>


                </div>

            </div>
        </div>
    </div>
</div>
<?php 

echo  $clspaginator->createLinks( $links, 'pagination pagination-sm' ); 
?> 
<!--
<script src="<?php echo $baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script language="javascript">
       //InitPage();
      </script>
-->
