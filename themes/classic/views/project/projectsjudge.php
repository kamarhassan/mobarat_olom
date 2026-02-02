  <script language="javascript">
        /*
      var pers_selected=0;  
      $(document).ready(function () {
          $(.'check_').click(function (event){
              if(this.checked){
                  alert("true");
              }
              else
                  alert("false");
          });
      });*/
     var pers_selected="";  
      function ch_check(element){
         
          //if(pers_selected.length>0) pers_selected+=","
          var id=element.id.substring( element.id.indexOf("_")+1);
          id="["+id+"]";
          //element.id;
          if(element.checked==true){
              pers_selected+=id;
          }
          else{
            //  alert(element.checked);
             pers_selected= pers_selected.replace(id,"");
          }
          /*
           if(element.value==0){
                  alert(element.checked);
              }
              else
                  alert(element.checked);*/
              //alert(pers_selected);
      }
    </script>
<div class="col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption"><i class="icon-bar-chart"></i>إختيار مشاريع لحكم </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body">

            <div class="portlet-body" style="min-height: 100px;" id="portlet-info">

    <table>
        <tr>
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
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('إظهار مشاريع الحكم فقط',FALSE); ?>
            </td>
            <td width="25" >
                 <?php echo CHtml::checkBox('chShowRegister',false,array('id'=>'chShowRegister','class' => 'form-control ')); ?>
            </td>
            <td width="20"></td>


            <td width="20"></td>
             <td width="35">
                <?php
                    $t=time();
                    if(isset($bodyreportparams))
                        $param=$bodyreportparams;
                    else 
                        $param=array();
                    $param['pname']="js:document.getElementById('txtPname').value ";
                    $param['school']="js:document.getElementById('txtSchool').value ";
                    $param['showRegister']="js:document.getElementById('chShowRegister').checked";
                    $param['showall']="js:document.getElementById('chShowAll').checked";
                    echo CHtml::button('search', array('id'=>'btsearch','name'=>'btsearch','class' => 'form-control', 'width' => 110,'Empty'=>'',
                        'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createAbsoluteUrl($bodyreport),
                        'data'=>$param,
                        'cache'=>FALSE,
                        //'update' => '#level2',
                        'success'=>'function(data) {$("#fill_table").html(data);}',
                        ))); 
                    
                ?>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="75" style="text-align:center">
                 <?php echo CHtml::label('إظهار الكل',FALSE); ?>
            </td>
            <td width="25" >
                 <?php echo CHtml::checkBox('chShowAll',false,array('id'=>'chShowAll','class' => 'form-control ')); ?>
            </td>
            <td width="20"></td>
            <td> <a href="<?php echo $this->createAbsoluteUrl('Project/projectprintforjudgeall/'. $bodyreportparams['judge_id'] ); ?>" target="_blank"  class="form-control">طباعة بطاقات تحكيم الحكم</a> 
            </td>
            <td> <a href="<?php echo $this->createAbsoluteUrl('Project/projectprintforjudgeallexcel/'. $bodyreportparams['judge_id'] ); ?>" target="_blank"  class="form-control">أكسل</a> 
            </td>
        </tr>
    </table>
                <div class="table-scrollable" id="fill_table">
                </div>
            </div>
        </div>
    </div>
    
     <?php
        Yii::app()->clientScript->registerScript('scid','$(document).ready(function(){$("#btsearch").click();});',CClientScript::POS_LOAD);

    ?>
</div>

  

