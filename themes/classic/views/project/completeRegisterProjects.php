<div class="col-md-6 col-md-offset-3">
    <div class="form-actions">
        <div class="col-md-offset-3"><h1> تم حجز المشروع بنجاح</h1></div><br>
        <a href="<?php echo $this->createAbsoluteUrl('project/projectUpdate/prjid/'.$project_id)?>">
            <button type="button" id="back-btn" class="btn btn-block green">لاستكمال بيانات المشروع اضغط هنا</button>
        </a>

        <br>
        <a href="<?php echo $this->createAbsoluteUrl('Personstudent/regStep1/sclid/'.$sclid)?>">
            <button class="btn btn-warning btn-block">لتسجيل الطلاب اضغط هنا</button>
        </a>

        <div id="yes"></div>

    </div>
</div>