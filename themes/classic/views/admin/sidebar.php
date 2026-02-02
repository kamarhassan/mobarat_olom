
    
     <div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu">
        
        <li>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler hidden-phone"></div>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <form class="sidebar-search" action="" method="POST">
                    <div class="form-container">

                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>

        <li class="start active ">
            <a href="<?php echo $this->createAbsoluteUrl('Admin/index') ?>">
                <i class="icon-home"></i>
                <span class="title">الرئيسية</span>
                <span class="selected"></span>
            </a>
        </li>
        <?php if (Yii::app()->controller->action->id == 'update' || Yii::app()->controller->action->id=='SelectYear'){ ?>
        <li class="start active ">
            <a href="<?php echo $this->createAbsoluteUrl('Admin/config') ?>">
                <i class="icon-calendar"></i>
                <span class="title">إعدادات</span>
               
            </a>
        </li>
        <?php }?>
        <?php if (Yii::app()->controller->action->id == 'Mobaratjudgeupdate' 
                    || Yii::app()->controller->action->id=='invitejudge'
                    || Yii::app()->controller->action->id=='listprojectsrate'
                    || Yii::app()->controller->action->id=='Reportjudgewaited'
                    || Yii::app()->controller->action->id=='Reportjudgeaccept'
                    || Yii::app()->controller->action->id=='Reportjudgerejected'
                    || Yii::app()->controller->action->id=='Schoolhalls'
                ){ ?>
        <li class="start active ">
            <a href="<?php echo $this->createAbsoluteUrl('Admin/judge') ?>">
                <i class="icon-check"></i>
                <span class="title">التحكيم</span>
               
            </a>
        </li>
        <?php }?>
        
    </ul>
</div>
