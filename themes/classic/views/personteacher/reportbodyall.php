
<div id="Result">
    
</div>
<div >
    
<?php  echo $clspaginator->summary ();    ?>
<table class="table table-bordered" > 
                      <thead>
                        <tr>
                            <th>تعديل</th>
                            <th>MUN</th>
                            <th>الرقم</th>
                            <th>الاسم</th>
                            <th>الاب</th>
                            <th>الشهرة</th>
                             <th>البريد الالكتروني</th>
                            <th>السنة</th>
                            <th>المدرسة</th>
                            <th>هاتف</th>
                            <th>خليوي</th>
                        </tr>
                    </thead >
                    <tbody>
                    
                  

    <?php
    $eo = 0;
    $oddOrEven="even";

    foreach ($teachs->data as $teach) {
        $eo++;
        if ($eo % 2 == 0)
            $oddOrEven = "even";
        else
            $oddOrEven = "odd";
        ?>
        <tr  <?php if ($oddOrEven == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
            <td><a href="<?php echo $this->createAbsoluteUrl('Person/Update/' . $teach['person_id']); ?>" target="_blank" class="btn green icon-edit"></a> </td>
            <td><?php echo $teach['mun']; ?></td>
            <td><?php echo $teach['person_id']; ?></td>
            <td><?php echo $teach['Person_fname']; ?></td>
            <td><?php echo $teach['Person_mname']; ?></td>

            <td><?php echo $teach['person_lname']; ?></td>
            <td><?php echo $teach['person_email1']; ?></td>
            <td><?php echo $teach['mobarat_year']; ?></td>
            <td><?php echo $teach['school_name']; ?></td>
            <td><?php echo $teach['Person_Phone']; ?></td>
            <td><?php echo $teach['Person_CellPhone']; ?></td>

        </tr>
    <?php } ?>
</tbody>
</table>
    </div>
<div id="tytyty"></div>
    
    <?php 
    ?>

<?php 



//echo $this->renderPartial('__oldstudent',array('stds'=>$teachs));

                              

echo  $clspaginator->createLinks( $links, 'pagination pagination-sm' ); 
?> 

