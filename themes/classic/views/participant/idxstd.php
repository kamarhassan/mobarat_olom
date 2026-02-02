<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
 <?php
            
            //$d = new DateTime();
            //$date = $d->format('Y-m-d');
            
            ?>
<?php 
    foreach ($stds as $std){
    ?>
<h3 class="page-title">
    صفحة تحكم الطالب
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
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/listprojectsstd/persid/'.$std['Person_id']); ?>">
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
            //if (strtotime($date) < strtotime($current['last_register_project'])) {
            if (Mobarat::isOpenForUpdate($current)){
                ?>
                 <a class="more" href="<?php echo $this->createAbsoluteUrl('Project/listprojectsforupdatestd/persid/'.$std['Person_id']); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تعديل المشاريع
                </a>
            <?php } ?>
           
               
            </a>
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
            //if (strtotime($date) < strtotime($current['last_register_project'])) {
             if (Mobarat::isOpenForUpdate($current)){
                ?>
                 <a class="more" href="<?php echo $this->createAbsoluteUrl('Person/update/' .$std['Person_id']) ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تعديل البيانات الشخصية
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
<?php if($showScholarship==true){ ?>
<div class="row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class=" icon-gift"></i>
            </div>
            <div class="details">
                <div class="number">المنح</div>
                <div class="desc">الجامعية</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Personstudent/Scholarship/stdid/'.$std['student_id']); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>

</div>
<?php } ?>
<?php
    }
    ?>