<?php
$baseUrl = Yii::app()->theme->baseUrl;

?>

<h3 class="page-title">
    صفحة التحكيم لسنة <?php
    $clsPerson=Yii::app()->session['clsPerson'] ;
    echo $mobarat['mobarat_year'];
    //$n = new Functions;
   // echo $n->getYear();
    ?>
</h3>

<?php 
    $counter=0;
    $row='';

//    echo $clsPerson->person_id;
    echo cls_Designer::getPagesLink($this, $pgs,$mobarat,$clsPerson, 3,0,'07',$counter,$row);
?>
<br><br>
<div class = "row ui-sortable" id = "sortable_portlets">
    <div class = "col-md-5 column sortable">
        <!--BEGIN Portlet PORTLET-->

        <!--END Portlet PORTLET-->
        <!--BEGIN Portlet PORTLET-->
        <div class = " portlet box blue">
            <div class = "portlet-title">
                <div class = "caption"><i class = "icon-reorder"></i>إحصائيات عامة </div>

            </div>
            <div class = "portlet-body">


                <ul class="list-group">

                    <li class="list-group-item">
                        عدد الحكام الذين تمت دعوتهم
                        <span class="badge badge-info">
                            <?php   echo Personjudge::model()->getCountAllInviteJudge($mobarat['mobarat_year']); ?>
                        </span>


                    </li>
                    <li class="list-group-item">
                        عدد الحكام المنتظرين
                        <span class="badge badge-warning">
                            <?php   echo Personjudge::model()->getCountWaitedJudge($mobarat['mobarat_year']); ?>
                        </span>


                    </li>

                    <li class="list-group-item">
                        عدد الحكام الموافقين
                        <span class="badge badge-success">
                           <?php   echo Personjudge::model()->getCountAcceptedJudge($mobarat['mobarat_year']); ?>
                        </span>


                    </li>
                 
                  
                    <li class="list-group-item">
                        عدد الحكام المعتذرين
                        <span class="badge badge-danger">
                             <?php   echo Personjudge::model()->getCountRejectedJudge($mobarat['mobarat_year']); ?>
                           
                        </span>
                    </li>
                   
                </ul>
            </div>
        </div>
    </div>
    <!--END Portlet PORTLET-->

</div>


