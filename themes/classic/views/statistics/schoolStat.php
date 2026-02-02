 <div class = " portlet box blue">
            <div class = "portlet-title">
                <div class = "caption"><i class = "icon-reorder"></i>إحصائيات المدارس </div>

            </div>
        <div class = "portlet-body">
                <ul class="list-group">
       

                   <li class="list-group-item">
                        
                        عدد المدارس المؤكدة  رسمي
                        <span class="badge badge-info">
                            <?php echo MobaratSchool::getCoutingConfirmedPublicSchool($mobarat['mobarat_year']); 
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                         عدد المدارس المؤكدة   خاص
                        <span class="badge badge-info">
                            <?php echo MobaratSchool::getCoutingConfirmedPrivateSchool($mobarat['mobarat_year']); 
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                         عدد المدارس المؤكدة التي لم تشارك السنة الماضية
                        <span class="badge badge-info">
                            <?php echo MobaratSchool::getCoutingConfirmedSchoolNew($mobarat['mobarat_year']); 
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                         عدد المدارس المؤكدة التي لم تشارك سابقا مطلقا
                        <span class="badge badge-info">
                            <?php echo MobaratSchool::getCoutingConfirmedSchoolNewPure($mobarat['mobarat_year']); 
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item">
                         عدد المدارس المؤكدة التي  شاركت سابقا
                        <span class="badge badge-info">
                            <?php echo MobaratSchool::getCoutingConfirmedSchoolOld($mobarat['mobarat_year']);
                            //echo $n->getCoutingConfirmedSchoolPrecedentYear($mobarat['mobarat_year']); 
                            ?>
                        </span>
                    </li>

                    
                    </ul>
            </div>
        </div >

