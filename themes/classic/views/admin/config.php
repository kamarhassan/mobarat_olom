<?php
$baseUrl = Yii::app()->theme->baseUrl;

?>

<h3 class="page-title">
    صفحة إعدادات لسنة <?php
    $clsPerson=Yii::app()->session['clsPerson'] ;
    echo $mobarat['mobarat_year'];
    //$n = new Functions;
   // echo $n->getYear();
    ?>
</h3>

<div class = "row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="icon-calendar"></i>
            </div>
            <div class="details">
                <div class="number">
                   تعديل إعدادات
                </div>
                <div class="desc">
                    السنة الحالية
                </div>
            </div>

            <a class="more" href="<?php echo $this->createAbsoluteUrl('Mobarat/update/'.$mobarat['mobarat_year']);
                                        //echo $this->createAbsoluteUrl('Admin/PendingSchool');
            
            ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="icon-magic"></i>
            </div>
            <div class="details">
                <div class="number"> إضافة سنة</div>
                <div class="desc"><?php echo Mobarat::getMaxYear()+1; ?></div>
            </div>
           
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Admin/NewYear'); ?>" onclick="return confirm('هل انت متأكد من إضافة سنة جديدة وتحويلها الى سنة حالية?')">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
                
        </div>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-bar-chart"></i>
            </div>
            <div class="details">
                <div class="number">إختيار</div>
                <div class="desc"> سنة اخرى</div>
            </div>
            <a class="more" href="<?php echo $this->createAbsoluteUrl('Admin/SelectYear'); ?>">
                دخول <i class="m-icon-swapleft m-icon-white"></i>
            </a>
        </div>
    </div>
    
    

</div>