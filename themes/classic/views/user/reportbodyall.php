<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-bar-chart"></i>تقرير</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body">
                <?php  echo $clspaginator->summary (); $t=time();   ?>
                <div class="table-scrollable">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="25">تعديل</th>
                                <th>الاسم</th>
                                <th>الشهرة</th>
                                <td>MUN</td>
                                <th>كلمة المرور</th>
                                <th>email1</th>
                                <th>email2</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $eo = 0;
                            foreach ($usrs->data as $p) {

                                $eo++;
                                if ($eo % 2 == 0)
                                    $cl = "even";
                                else
                                    $cl = "odd";
                                ?>
                                <tr <?php if ($cl == "even") {
                                    ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >
                                    <td><?php  
                                    /* for permission*/
                                            if($p['user_type']=='01')
                                                 echo CHtml::link('<button type="button"  class="btn green icon-edit"></button>'
                                                                    , array('User/edit/'.$p['user_id'])
                                                                    , array('id'=>'__lk_ds_'.$t.$p['user_id'],'name'=>'__lk_ds_'.$t.$p['user_id'])); 
                                     
                                    
                                        ?>
                                    
                                    </td>

                                    <td><?php echo $p['Person_fname']; ?></td>
                                    <td><?php echo $p['Person_lname']; ?></td>
                                        <?php /*$subMUN = substr($p['user_mun'], 2);*/ ?>
                                    <td><?php echo $p['user_mun']; ?></td>
                                    <td><?php echo $p['user_password']; ?></td>
                                    <td><?php echo $p['Person_email1']; ?></td>
                                    <td><?php echo $p['Person_email2']; ?></td>



                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php echo  $clspaginator->createLinks( $links, 'pagination pagination-sm' );  ?> 
            </div>
        </div>
    </div>
</div>