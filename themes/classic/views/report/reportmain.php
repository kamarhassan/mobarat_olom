 
<div class="col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption"><i class="icon-bar-chart"></i><?php echo $title ?> </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="note note-success">
                <p>
                   شروط البحث

                </p>
            </div>
            <div class="portlet-body" style="min-height: 100px;" id="portlet-info">

                <?php
                    
                    echo $this->renderPartial($searchcontrol,$params);
                ?>
                <div class="table-scrollable" id="fill_table">
                </div>
            </div>
        </div>
    </div>
</div>


