<?php
$baseUrl = Yii::app()->theme->baseUrl;

?>

<h3 class="page-title">
    صفحة إعدادات لسنة <?php
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
    echo cls_Designer::getPagesLink($this, $pgs,$mobarat,$clsPerson, 3,0,'0202',$counter,$row);
?>