<?php $baseUrl = Yii::app()->theme->baseUrl; 
$t= time();
?>
<div class="row">
    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">الأستاذ المشرف القديم</h4>
                </div>
                <div class="modal-body" id="modalBody">

                </div>
                <!--                              <div class="modal-footer">
                                                 <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                 <button type="button" class="btn blue">Save changes</button>
                                              </div>-->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- end modal -->

    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-bar-chart"></i>تقرير</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="note note-success">
                    <p>
                        معلومات المدارس الغير مؤكدة
                        <br>
                        <span class="label label label-success">مدرسة جديدة</span>
                        <span class="label label label-info">مدرسة قديمة - أستاذ قديم</span>
                        <span class="label label label-warning">مدرسة قديمة  - أستاذ جديد</span>

                    </p>
                </div>
                <div class="table-scrollable">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>حذف</th>
                                <th>تأكيد</th>
                                <th>إلغاء المشاركة كليا</th>
                                <th>إسم المدرسة</th>
                                <th>إسم المدير</th>
                                <th>المحافظة</th>
                                <th>القضاء</th>
                                <th>المدينة</th>
                                <th>الشارع</th>
                                <th>هاتف المدرسة</th>
                                <th>الأستاذ المسؤول</th>
                                <th>رقم هاتف الأستاذ المسؤول</th>
                                <th>البريد الإلكتروني</th>
                                <th>معلومات الأستاذ القديم</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $eo = 0;
                            foreach ($schoolPending as $p) {

                                $eo++;
                                if ($eo % 2 == 0)
                                    $cl = "even";
                                else
                                    $cl = "odd";
 $tdColor = "success";
 
 
                                if ($p['school_Past'] == '01') {
                                    $tdColor = "success";
                                }

                                //old teacher - old school
                                if ($p['school_Past'] == '03') {
                                    $tdColor = "info";
                                }

                                //old school - new teacher
                                if ($p['school_Past'] == '02') {
                                    $tdColor = "warning";
                                }

                                ?>
                                <tr id="<?php echo $p['school_id']; ?>" <?php if ($cl == "even") { ?> bgcolor="#ffffff" <?php } else { ?> bgcolor="#f9f9f9" <?php } ?> >

                                    <td>
                                    					
				<?php echo CHtml::ajaxLink('<button type="button" class="btn btn red ">
                                       <i class="icon-remove"></i>
                                    </button>', array('Admin/deleteSchool')
                                    , array('data' => array('id' => $p['school_id']),'update' => '#'.$p['school_id'])
									, array('confirm' => 'هل انت متأكد من حذف المدرسة?')); ?>
									
                                    </td>





                                    <td>
                                    	 
                                        <?php
                                        echo CHtml::ajaxLink('<button type="button"  class="btn blue pull-right">
                                        	<i class="icon-save"></i>
                                    		</button>', array('Admin/confirmSchool')
                                    		, array('data' => array('id' => $p['school_id']),'update' => '#'.$p['school_id'])
											, array('confirm' => 'هل انت متأكد من قبول  المدرسة?' ));
									
									
                                     	?>
                                    </td>
                                     <td>
                                    	 
                                        <?php
                                        echo CHtml::ajaxLink('<button type="button"  class="btn red pull-right">
                                        	<i class="icon-remove"></i>
                                    		</button>', array('Admin/RemoveSchool')
                                    		, array('data' => array('id' =>$p['school_id']),'update' => '#'.$p['school_id'])
						, array('id' =>'dlt'.$t.$p['school_id'],'confirm' => 'هل انت متأكد سوف يتم إلغاء مشاركة المدرسة كليا?' ));
									
									
                                     	?>
                                    </td>
                                    <td><span class="label label label-<?php echo $tdColor; ?>"><?php echo $p['school_name']; ?></span></td>
                                    <td><?php echo $p['manager']; ?></td>
                                    <td><?php echo $p['moha']; ?></td>
                                    <td><?php echo $p['kada']; ?></td>
                                    <td><?php echo $p['city']; ?></td>
                                    <td><?php echo $p['school_street']; ?></td>
                                    <td><?php echo $p['school_phone']; ?></td>
                                    <td><?php echo $p['ofteacher']; ?></td>
                                    <td><?php echo $p['Person_CellPhone']; ?></td>
                                    <td><?php echo $p['Person_email1']; ?></td>
									
									
                                   
                                    <td>
                                        <?php
                                        
                                        if ($p['school_Past'] == '02') {

                                            echo CHtml::ajaxLink('<button type="button" class="btn yellow">
                                        		<i class=\'icon-search\'></i></button>', array('Admin/ModalOldOteach'), array('update' => '#modalBody',
                                                'complete' => 'function() { $("#basic").modal();}',
                                                'data' => array('id' => $p['school_id'])));
                                        }
                                         
                                        ?>


                                    </td>


                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>