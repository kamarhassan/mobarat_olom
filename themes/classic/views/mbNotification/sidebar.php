<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    
     <div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu">
       <?php 
        $type = MbUser::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
?>
        <li class="start active ">
            
            	
            	 <?php if ($type->user_type == 1) { ?>
                 <a href="<?php echo Yii::app()->createAbsoluteUrl('MbAdmin/index'); ?>">
                 <?php } else if ($type->user_type == 2) { ?>
                 <a href="<?php echo Yii::app()->createAbsoluteUrl('MbSchool/index'); ?>">
                 <?php } else if ($type->user_type == 3) { ?>
                 <a href="<?php echo Yii::app()->createAbsoluteUrl('MbStudent/index'); ?>">
                 <?php } else if ($type->user_type == 4) { ?>
                 <a href="<?php echo Yii::app()->createAbsoluteUrl('MbTeacher/index'); ?>">
    			 <?php } ?>
                <i class="icon-home"></i>
                <span class="title">الرئيسية</span>
                <span class="selected"></span>
            </a>
        </li>
        <!--
        <li class="">
                        <a href="javascript:;">
                            <i class="icon-tasks"></i>
                            <span class="title">قسم التحكيم</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li >
                                <a href="<?php echo $this->createAbsoluteUrl('MbAdmin/submitSchoolProject'); ?>">
                                  تثبيت المدارس و المشاريع</a>
                            </li>
                            <li >
                                <a href="<?php echo $this->createAbsoluteUrl('MbAdmin/ListSchool'); ?>">
                                    تأكيد حضور المدارس</a>
                            </li>
                            <li >
                                <a href="<?php echo $this->createAbsoluteUrl('Judge/create'); ?>">
                                    حكم جديد  </a>
                            </li>
                        </ul>
                    </li>
           -->
    </ul>
</div>
</div>