<?php

foreach ($project as $p) {
            ?>
            <div class="dd" id="nestable_list_1">
                <ol class="dd-list">
                    <li class="dd-item" data-id="2">
                        <div class="dd-handle" style="background-color:#5B98F3;color: white;">MUN</div>
                        <ol class="dd-list">
                            <li class="dd-item" data-id="3">
                                <div class="dd-handle"><?php echo Yii::app()->user->name; ?></div>
                            </li>
                        </ol>
                    </li>
                     <li class="dd-item" data-id="2">
                        <div class="dd-handle" style="background-color:#5B98F3;color: white;">رقم المشروع</div>
                        <ol class="dd-list">
                            <li class="dd-item" data-id="3">
                                <div class="dd-handle"><?php echo $p['project_id']; ?></div>
                            </li>
                        </ol>
                    </li>
                    <li class="dd-item" data-id="2">
                        <div class="dd-handle" style="background-color:#5B98F3;color: white;">اسم المشروع</div>
                        <ol class="dd-list">
                            <li class="dd-item" data-id="3">
                                <div class="dd-handle"><?php echo $p['project_name']; ?></div>
                            </li>
                        </ol>
                    </li>
                    <li class="dd-item" data-id="2">
                        <div class="dd-handle" style="background-color:#5B98F3;color: white;">معلومات المشروع</div>
                        <ol class="dd-list">
                            <li class="dd-item" data-id="3">
                                <div class="dd-handle">المرحلة: <?php echo $p['project_stage']; ?></div>
                            </li>
                            <li class="dd-item" data-id="3">
                                <div class="dd-handle">الفئة: <?php echo $p['project_type']; ?></div>
                            </li>

                       
                            <li class="dd-item" data-id="3">
                               
                                <div class="dd-handle">المسار: <?php echo $p['project_path']; ?></div>
                            </li>

                            <li class="dd-item" data-id="3">
                                <div class="dd-handle" style="height: 100%" >الهدف: <?php echo $p['project_goal']; ?></div>
                            </li>
                            <li class="dd-item" data-id="3">
                                <div class="dd-handle" style="height: 100%">أدوات التنفيذ: <?php echo $p['project_tools']; ?></div>
                            </li>
                            <li class="dd-item" data-id="3">
                                <div class="dd-handle" style="height: 100%">خطوات المشروع: <?php echo $p['project_steps']; ?></div>
                            </li>
                            <li class="dd-item" data-id="3">
                                <div class="dd-handle">ملحقات : <?php echo $p['project_attachment']; ?></div>
                            </li>
                        <?php } ?>
                    </ol>
                </li>
                <li class="dd-item" data-id="2">
                    <div class="dd-handle" style="background-color:#5B98F3;color: white;">معلومات الأستاذ</div>
                    <ol class="dd-list">
                       
                        <?php if(count($teacher)>0) {?>
                            <li class="dd-item" data-id="2">
                                <div class="dd-handle" style="background-color: #0088cc;color: white;">الأستاذ المشرف:</div>
                                <ol class="dd-list">
                                   
                                    <li class="dd-item" data-id="3">
                                        <div class="dd-handle">الاسم: <?php echo $teacher[0]['Person_fname'] . " " . $teacher[0]['Person_lname']; ?></div>
                                    </li>
                                    <li class="dd-item" data-id="3">
                                        <div class="dd-handle">رقم الهاتف: <?php echo $teacher[0]['Person_CellPhone']; ?></div>
                                    </li>
                                    <li class="dd-item" data-id="3">
                                        <div class="dd-handle">البريد الإلكتروني: <?php echo $teacher[0]['Person_email1']; ?></div>
                                    </li>
                                </ol>
                            </li>
                        <?php }?>
                        
                    </ol>
                </li>

                <li class="dd-item" data-id="2">
                    <div class="dd-handle" style="background-color:#5B98F3;color: white;">معلومات الطلاب</div>
                    <ol class="dd-list">
                        <?php
                        foreach ($stds as $std) {
                           
                            ?>
                            <li class="dd-item" data-id="2">
                                <div class="dd-handle" style="background-color: #5B98F3;color: white;">الطالب</div>
                                <ol class="dd-list">
                                    
                                    <li class="dd-item" data-id="3">
                                        <div class="dd-handle">الاسم: <?php echo $std['Person_fname'] . " " . $std['Person_lname']; ?></div>
                                    </li>
                                   
                                    <li class="dd-item" data-id="3">
                                        <div class="dd-handle">رقم الهاتف: <?php echo $std['Person_CellPhone']; ?></div>
                                    </li>
                                    <li class="dd-item" data-id="3">
                                        <div class="dd-handle">البريد الإلكتروني: <?php echo $std['Person_email1']; ?></div>
                                    </li>
                                </ol>
                            </li>
                        <?php } ?>
                    </ol>
                </li>
        </div>


