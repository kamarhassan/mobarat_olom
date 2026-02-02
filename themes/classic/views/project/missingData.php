<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="col-md-3 "></div>
    <div class="col-md-6 ">
        <div class="form-actions">

            <div class="col-md-4 "></div>
            <div class="col-md-6 ">
                <a href="#" class="icon-btn">
                    <i class="icon-remove"></i>
                    <div>Error</div>
                    <span class="badge badge-important">1</span>
                </a>
            </div>
            <br>
            <div class="form-actions">
                <h3 class="text-center">
                    لا تستطيع تسجيل مشروع
                </h3>
                <br>
                <h1 class="text-center">
                  لا يمكن أن تسجل أي مشروع دون استكمال كامل بيانات المدرسة، المدير والاستاذ المسؤول
                </h1>




            </div>
            <div class="col-md-3 "></div>
            <div class="col-md-6 ">
               
                <a href="<?php echo $this->createAbsoluteUrl('School/update/' . $sclid); ?> " class="btn btn-lg green">
                    إكمال بيانات المدرسة <i class="icon-edit"></i></a>
            </div>
        </div>

    </div>
</div>