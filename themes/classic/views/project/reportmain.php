
<div class="col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption"><i class="icon-bar-chart"></i>تقرير المشاريع المشاركة سابقاً </div>
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

                <div id='searchcontrol'>
                    <table>
                        <tr>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('السنة',FALSE); ?>
                        </td>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::textField('txtYear','',array('id'=>'txtYear','class' => 'form-control ')); ?>
                        </td>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('المدرسة',FALSE); ?>
                        </td>
                        <td width="150">
                             <?php echo CHtml::textField('txtSchool','',array('id'=>'txtSchool','class' => 'form-control ')); ?>
                        </td>
                        
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('المشروع',FALSE); ?>
                        </td>
                        <td width="150" >
                             <?php echo CHtml::textField('txtPname','',array('id'=>'txtPname','class' => 'form-control ')); ?>
                        </td>
                                             
                        
                        <td width="20"></td>
                         <td width="35">
                             <?php echo CHtml::button('search', array('id'=>'btsearch','name'=>'btsearch','class' => 'form-control', 'width' => 110,'Empty'=>'',
                            'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createAbsoluteUrl('Project/reportbody'),
                            'data'=>array('pname'=>"js:document.getElementById('txtPname').value "
                                    ,'school'=>"js:document.getElementById('txtSchool').value "
                                    ,'myear'=>"js:document.getElementById('txtYear').value "
                                    ,'showall'=>"js:document.getElementById('chShowAll').checked "
                                    ),
                            'cache'=>FALSE,
                            //'update' => '#level2',
                            'success'=>'function(data) {$("#fill_table").html(data);}',
                        ))); 
                    ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="75" style="text-align:center">
                             <?php echo CHtml::label('إظهار الكل',FALSE); ?>
                        </td>
                        <td width="25" >
                             <?php echo CHtml::checkBox('chShowAll',false,array('id'=>'chShowAll','class' => 'form-control ')); ?>
                        </td>
                    </tr>
                    </table>
                    <?php
                        Yii::app()->clientScript->registerScript('scid','$(document).ready(function(){$("#btsearch").click();});',CClientScript::POS_LOAD);
                    ?>
                </div>
                <div class="table-scrollable" id="fill_table">
                </div>
            </div>
        </div>
    </div>
</div>


