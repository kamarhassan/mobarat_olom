<?php $baseUrl = Yii::app()->theme->baseUrl; ?>

<h3 class="page-title">
   صفحة الحكم
</h3>
<div class="row">



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
                 $d = new DateTime();
                $date = $d->format('Y-m-d');
                if (strtotime($date) < strtotime($current['last_update_judge'])) { ?>
                <a class="more" href="<?php  echo $this->createAbsoluteUrl('Person/update/' .$judge['Person_id']) ?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                    انتهت مهلة تعديل البيانات
                </a>
            <?php } ?>
        </div>
    </div>

    
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-bitbucket"></i>
            </div>
            <div class="details">
                 <div class="number">المشاريع</div>
                <div class="desc">دخول</div>
            </div>
            <?php 
                
                if ($showProject==true) { ?>
                <a class="more" href="<?php  echo $this->createAbsoluteUrl('Personjudge/Judgeproject/' .$judge['Person_id']) ?>">
                    دخول <i class="m-icon-swapleft m-icon-white"></i>
                </a>
            <?php } else { ?>
                <a class="more" href="#">
                   التحكيم غير مفعل
                </a>
            <?php } ?>
        </div>
    </div>
    
     

</div>
 <?php 
                
    if ($showProject==true) { ?>
    <div class="row">
        <div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
        <h3>عزيزي الحكم ،<br/> في حال توقفك عن متابعة التحكيم يرجى تسجيل 
             <a class="more" href="<?php  echo $this->createAbsoluteUrl('Site/Logout') ?>">
                        الخروج <i class="m-icon-swapleft m-icon-white"></i>
                    </a><br/>
        ليتم توزيع المشاريع الباقية  على حكام اخرين
        </h3>
          </div>
    </div>
 <?php } ?>
