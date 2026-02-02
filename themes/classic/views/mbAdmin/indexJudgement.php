<?php $baseUrl = Yii::app()->theme->baseUrl;
?>
<div class="row">
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class=" icon-download-alt"></i>
            </div>
            <div class="details">
                <div class="number">
                    تثبيت
                </div>
                <div class="desc">
                    المدارس و المشاريع
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('MbAdmin/submitSchoolProject'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class=" icon-check"></i>
            </div>
            <div class="details">
                <div class="number">
                    تأكيد حضور
                </div>
                <div class="desc">
                    المدارس
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('MbAdmin/ListSchool'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class=" icon-user"></i>
            </div>
            <div class="details">
                <div class="number">
                    حكم
                </div>
                <div class="desc">
                    جديد
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Judge/create'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
        </div>
    </div>
</div>