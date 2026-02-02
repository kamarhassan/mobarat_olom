<?php ?>
<div class="col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption"><i class="icon-bar-chart"></i>تقرير بالمشاريع</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body">
           
            <div class="table-scrollable">
                <table class="table table-bordered">
                    
                    <th>تعديل</th>
                    <th>إسم المشروع</th>
                    <th>الفئة</th>
                    <th>المرحلة</th>
                    <th>معلومات اضافية</th>
                    <th>الاهداف</th>
                    <th>الادوات</th>
                    <th>المسار</th>
                        <?php
                        $eo = 0;
                        foreach ($project as $p) {
                            $eo++;
                            if ($eo % 2 == 0)
                                $cl = "even";
                            else
                                $cl = "odd";
                            //$projData = MbProjectDetail::model()->findByAttributes(array('pdetail_project' => $p->project_id));
                            ?>
                            <tr  <?php if ($cl == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?>  >
                               <td><a href="<?php echo $this->createAbsoluteUrl('Project/projectUpdate/prjid/' . $p['project_id']); ?>" target="_blank" class="btn green icon-edit"></a> </td>
                                <td> <?php echo $p['project_name']; ?> </td>
                                <td><?php echo $p['project_type']; ?></td>
                                <td><?php echo $p['project_stage']; ?></td>
                               
                                    <td><?php echo $p['project_description']; ?></td>
                                    <td><?php echo $p['project_goal']; ?></td>
                                    <td><?php echo $p['project_tools']; ?></td>
                                    <td><?php echo $p['project_path']; ?></td>

                                <?php } ?>
                            </tr>
                       
                    </tbody>
                </table>


            </div>

        </div>
    </div>
</div>