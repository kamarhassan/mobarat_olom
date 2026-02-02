
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
                <th>رقم المشروع</th>
                <th>المشروع</th>
            </tr>
        </thead >
        <tbody>
            <?php
            $eo = 0;
            $oddOrEven="even";

            foreach ($stds->data as $std) {
                $eo++;
                if ($eo % 2 == 0)
                    $oddOrEven = "even";
                else
                    $oddOrEven = "odd";
                ?>
                <tr  <?php if ($oddOrEven == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
                    <td><a href="<?php echo $this->createAbsoluteUrl('Person/Update/' . $std['person_id']); ?>" target="_blank" class="btn green icon-edit"></a> </td>
                    <td><?php echo $std['mun']; ?></td>
                    <td><?php echo $std['person_id']; ?></td>
                    <td><?php echo $std['Person_fname']; ?></td>
                    <td><?php echo $std['Person_mname']; ?></td>
                    <td><?php echo $std['person_lname']; ?></td>
                    <td><?php echo $std['person_email1']; ?></td>
                    <td><?php echo $std['mobarat_year']; ?></td>
                    <td><?php echo $std['school_name']; ?></td>
                    <td><?php echo $std['project_id']; ?></td>
                    <td><?php echo $std['project_name']; ?></td>
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
?> 
