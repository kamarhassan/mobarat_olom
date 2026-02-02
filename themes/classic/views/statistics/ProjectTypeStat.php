 <div class = " portlet box blue">
            <div class = "portlet-title">
                <div class = "caption"><i class = "icon-reorder"></i>إحصائيات المشاريع </div>

            </div>
        <div class = "portlet-body">
                <ul class="list-group">
<?php
        foreach ($Projects as $prj) {
?>
         

                    <li class="list-group-item">
                    <?php echo $prj['tname'] ; ?>
                        <span class="badge badge-success">
                            <?php echo $prj['co']; ?>
                        </span>
                    </li>
<?php
         }
?>
                    
                    </ul>
            </div>
        </div >

