<?php
$function = new Functions();
?>





<div class="col-md-6">
    				<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>جدول تعديل السنوات
							</div>
							
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-hover">
								<thead>
								<tr>
									<th>
										 #
									</th>
								
								</tr>
								</thead>
								<tbody>
								<tr id="1">
                                <td>زيادة سنة</td>
									<td>
										 <?php $id=1; echo CHtml::ajaxLink('<button type="button"  class="btn green">
          <i class="icon-plus"></i>
        </button>', array('MbAdmin/increaseYear'),  array('data' => array('id'=>$id),  "success" => "function(data){
                    $('#'+data).remove();
                                    }"), array('confirm' => 'متأكد من زيادة السنة؟')); ?>
									</td>
								
								</tr>
								<tr id="2">
                                <td>تنقيص سنة</td>
									<td>
										 <?php $id=2; echo CHtml::ajaxLink('<button type="button"  class="btn red">
          <i class="icon-minus"></i>
        </button>', array('MbAdmin/decreaseYear'),  array('data' => array('id'=>$id),  "success" => "function(data){
                    $('#'+data).remove();
                                    }"), array('confirm' => 'متأكد من نقصان السنة؟')); ?>
									</td>
								
								</tr>
							
								</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>


