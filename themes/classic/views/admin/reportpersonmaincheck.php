<script language="javascript">
    
    function InitPage(){
        //var id='10302';
        //var temp=pers_selected.replace(/][/g,",");
        var temp=pers_selected.substring(1);
        temp=temp.substring(0,temp.length -1);
        var ids=temp.split("][");
        for(var i=0;i<ids.length;i++){
            //alert(ids[i]);
            var che = document.getElementById('check_' + ids[i]);
            if (che){
                  che.checked=true;
            }
        }
        /*
        alert(temp);
        if(pers_selected.indexOf(id)>0){
            var che = document.getElementById('check_10302');
            if (che){
                  che.checked=true;
            }
        }*/
    }
    
</script>
<div >
   

    <?php  echo $clspaginator->summary ();    ?>
    <table class="table table-bordered" > 
        <thead>
            <tr>
                <th>إختيار</th>
                <th>الرقم</th>
                <th>الاسم</th>
                <th>الاب</th>
                <th>الشهرة</th>
                 <th>البريد الالكتروني</th>
            </tr>
        </thead >
        <tbody>
            <?php
            $eo = 0;
            $oddOrEven="even";

            foreach ($pers->data as $per) {
                $eo++;
                if ($eo % 2 == 0)
                    $oddOrEven = "even";
                else
                    $oddOrEven = "odd";
                ?>
                <tr  <?php if ($oddOrEven == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
                    <td>
                        <?php 
                        echo CHtml::checkBox('check_',false,array('id'=>'check_'.$per['person_id'],'class' => 'check_','onclick' =>"ch_check(this);")); 
                        
                        ?>
                    </td>
                    <td><?php echo $per['person_id']; ?></td>
                    <td><?php echo $per['Person_fname']; ?></td>
                    <td><?php echo $per['Person_mname']; ?></td>
                    <td><?php echo $per['person_lname']; ?></td>
                    <td><?php echo $per['person_email1']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div id="tytyty"></div>
    
    <?php 
    ?>

<?php 

echo  $clspaginator->createLinks( $links, 'pagination pagination-sm' ); 
//echo CHtml::checkBox('check_',false,array('id'=>'check_','onclick' =>"ch_check(this);")); 
 //Yii::app()->clientScript->registerScript('sciddsd','$(document).ready(function(){$("#check_").click();});',CClientScript::POS_LOAD);
?> 
  <script language="javascript">
       InitPage();
      </script>
      
