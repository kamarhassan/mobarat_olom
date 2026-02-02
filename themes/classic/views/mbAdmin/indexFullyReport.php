<?php
$baseUrl = Yii::app()->theme->baseUrl;
$n = new Functions();
?>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class=" icon-warning-sign"></i>
            </div>
            <div class="details">
                <div class="number">
                    تقرير
                </div>
                <div class="desc">
                    الأعضاء
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('User/reportall'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="icon-tasks"></i>
            </div>
            <div class="details">
                <div class="number">تقرير </div>
                <div class="desc">الأساتذة</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Personteacher/reportall'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>

    <div class = "col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class = "dashboard-stat orange">
            <div class = "visual">
                <i class = "icon-archive"></i>
            </div>
            <div class = "details">
                <div class = "number">تقرير</div>
                <div class = "desc">الطلاب </div>
            </div>
            <a class = "more" href = "<?php echo $this->createAbsoluteUrl('Personstudent/reportall') ?>">
                دخول <i class = "m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class=" icon-warning-sign"></i>
            </div>
            <div class="details">
                <div class="number">
                    تعديلات
                </div>
                <div class="desc">
                    شاملة
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('MbAdmin/ChooseSchool'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>


</div>