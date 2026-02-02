<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<?php 
    foreach ($teachs as $teach){
    ?>
<h3 class="page-title">
    صفحة تحكم الأستاذ المشرف
</h3>

<?php
    if(Mobarat::showMessgaeForUpdate($current)){
?>
<h3>
    سوف يتاح لكم إمكانية التعديل ضمن الفترة:
    <?php echo $current['openforupdate_fromdate']?> و <?php echo $current['openforupdate_todate']?>
</h3>
    <?php }?>
<div class="row">


    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="icon-bar-chart"></i>
            </div>
            <div class="details">
                <div class="number">تقرير بالمشروع</div>
                <div class="desc">المسجل</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/listprojectstea/persid/'.$teach['Person_id']); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-edit"></i>
            </div>
            <div class="details">
                <div class="number">تعديل</div>
                <div class="desc">المشاريع</div>
            </div>
            
             <?php
            
                //$d = new DateTime();
                //$date = $d->format('Y-m-d');
               // if (strtotime($date) < strtotime($current['last_update'])) {
                 if (Mobarat::isOpenForUpdate($current)) {
            ?>
                <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/listprojectsforupdatetea/persid/'.$teach['Person_id']); ?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تعديل المشاريع
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="icon-pencil"></i>
            </div>
            <div class="details">
                <div class="number">تعديل</div>
                <div class="desc">البيانات الشخصية</div>
            </div>
            <?php 
            //if (strtotime($date) < strtotime($current['last_update'])) { 
            if (Mobarat::isOpenForUpdate($current)) {
                ?>
                <a class="more" href="<?php  echo $this->createAbsoluteUrl('Person/update/' .$teach['Person_id']) ?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تعديل البيانات
                </a>
            <?php } ?>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat orange">
            <div class="visual">
                <i class=" icon-envelope-alt"></i>
            </div>
            <div class="details">
                <div class="number">إنشاء رسالة</div>
                <div class="desc">داخلية</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('MbMessage/create'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat bordo">
            <div class="visual">
                <i class=" icon-inbox"></i>
            </div>
            <div class="details">
                <div class="number">صندوق البريد</div>
                <div class="desc">الداخلي</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('MbMessage/receive'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class="icon-bullhorn"></i>
            </div>
            <div class="details">
                <div class="number">الإشعارات</div>
                <div class="desc">الداخلية</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('MbNotification/allNotification/' . Yii::app()->user->getId()) ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
</div>

<?php if (count($stds)) { ?>
    <div class="row">
        <div class="col-md-9 col-sm-6 col-xs-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-cogs"></i>تعديل صلاحيات الطلاب</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>

                    </div>
                </div>
                
                <div class="portlet-body" >

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>إسم الطالب</th>
                                <th> يحق للطالب تعديل على المشروع؟ لتعديل الصلاحية أنقر على المفتاح  <i class="icon-arrow-down"></i></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($stds as $std) {
                               
                                ?>

                                <tr>
                                    <td>

                                        <?php
                                        if ($std['Person_fname'] != NULL)
                                            echo $std['Person_fname'] . " " . $std['Person_lname'];
                                        else
                                            echo "الطلب من الطالب " . $std['Person_email1']."  إكمال بياناته";
                                        ?>
                                    </td>
										 
                                    <td >
                                        <?php
                                        
                                        if ($std['student_CanModifyProject'] == 1) {

                                            $cl = "green";
                                            $clt = "نعم";
                                            $path = "Personteacher/RoleNo";
                                        } else {
                                            $cl = "red";
                                            $clt = "كلا";
                                            $path = "Personteacher/RoleYes";
                                        }
                                        ?>


                                        <div <?php echo "id=\"sp". $std['Student_id'] ."\""
                                        ?>>
                                        <?php echo CHtml::ajaxLink('<button   type="button" data-loading-text="...إنتظار" class="demo-loading-btn btn ' . $cl . '">' . $clt . '</button>', array($path)
                                        		, array('update' => '#sp'.$std['Student_id'], 'data' => array('stdid' => $std['Student_id'],'persstdid'=>$std['persstudentid'],'persteaid'=>$std['persteacherid']))); ?>
</div>



                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
    }
    ?>