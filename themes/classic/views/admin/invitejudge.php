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
            <div class="caption"><i class="icon-bar-chart"></i>دعوة حكم </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="note note-success">
                <p>
إختيار أفراد لهم علاقة سابقة مع مباراة العلوم ودعوتهم للمشاركة في التحكيم
                </p>
            </div>
            <div class="portlet-body" style="min-height: 100px;" id="portlet-info">

                    <table>
        <tr>
            <td width="75" style="text-align:center">
                <?php echo CHtml::label('الاسم',FALSE); ?>
            </td>
            <td width="150" >
                <?php echo CHtml::textField('txtFname','',array('id'=>'txtFname','class' => 'form-control ')); ?>
            </td>
             <td width="75" style="text-align:center">
                <?php echo CHtml::label('الاب',FALSE); ?>
            </td>
            <td width="150">
                <?php echo CHtml::textField('txtFather','',array('id'=>'txtFather','class' => 'form-control ')); ?>
            </td>
            <td width="75" style="text-align:center">
                <?php echo CHtml::label('الشهرة',FALSE); ?>
            </td>
            <td width="150" >
                <?php echo CHtml::textField('txtLname','',array('id'=>'txtLname','class' => 'form-control ')); ?>
            </td>
            <td width="65" style="text-align:center">
                 <?php echo CHtml::label('البحث في الحكام فقط',FALSE); ?>
            </td>
            <td width="25" >
                 <?php echo CHtml::checkBox('chSearchAll',true,array('id'=>'chSearchAll','class' => 'form-control ')); ?>
            </td>
            <td width="20"></td>
           

           
            <td width="20"></td>
             <td width="35">
                <?php 
                    $t=time();
                    if(isset($bodyreportparams))
                        $paramSearch=$bodyreportparams;
                    else 
                        $paramSearch=array();
                    $paramSearch['fname']="js:document.getElementById('txtFname').value ";
                    $paramSearch['fathername']="js:document.getElementById('txtFather').value ";
                    $paramSearch['lname']="js:document.getElementById('txtLname').value ";
                    $paramSearch['searchall']="js:document.getElementById('chSearchAll').checked";
                    $paramSearch['showall']="js:document.getElementById('chShowAll').checked";
                    
                    //echo $param['prjid'];
                    echo CHtml::button('search', array('id'=>'btsearch'.$t,'name'=>'btsearch'.$t,'class' => 'form-control', 'width' => 110,'Empty'=>'',
                    'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createAbsoluteUrl('/Admin/reportpersonmaincheck'),
                    'data'=>$paramSearch,
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
            

        </tr>
    </table>
                <div class="table-scrollable" id="fill_table">
                </div>
            </div>
        </div>
    </div>
    
     <?php
        Yii::app()->clientScript->registerScript('scid','$(document).ready(function(){$("#btsearch'.$t.'").click();});',CClientScript::POS_LOAD);

    ?>
</div>
    <table>
        <tr>
                      <td width="40">
                <div>
                    <?php
                        $param=array();
                        $param['ids']="js:pers_selected ";
                        echo CHtml::button('إرسال دعوات للمحددين فقط', array('id'=>'SendInvitation'.$t,'name'=>'SendInvitation'.$t/*,'class' => 'form-control'*/, 'width' => 110,'Empty'=>'',
                                'ajax' => array(
                                'type' => 'POST',
                                'url' => CController::createAbsoluteUrl('/Admin/SendJudgeInvitation'),
                                'data'=>$param,
                                'cache'=>FALSE,
                                //'update' => '#level2',
                                'success'=>'function(data) {'
                                    . 'if(data==-1){alert("حصل خطأ أثناء إرسال الدعوات!");}'
                                    . 'else {$("#Result_SendInvite").html(data + "<br>"+$("#Result_SendInvite").html());$("#Result_caption").html("لقد تم إرسال دعوات للأفراد التالية أسماؤهم:");pers_selected="";$("#btsearch'.$t.'").click();}}',
                                ))); 
                    ?>
                </div>
            </td>
            <td width="40">
                <div>
                    <?php
                        
                        echo CHtml::button('إرسال دعوات للكل', array('id'=>'SendInvitationAll'.$t,'name'=>'SendInvitationAll'.$t/*,'class' => 'form-control'*/, 'width' => 110,'Empty'=>'',
                                'ajax' => array(
                                'type' => 'POST',
                                'url' => CController::createAbsoluteUrl('/Admin/SendJudgeInvitationAll'),
                                'data'=>$paramSearch,
                                'cache'=>FALSE,
                                //'update' => '#level2',
                                'success'=>'function(data) {'
                                    . 'if(data==-1){alert("حصل خطأ أثناء إرسال الدعوات!");}'
                                    . 'else {$("#Result_SendInvite").html(data + "<br>" +$("#Result_SendInvite").html() );$("#Result_caption").html("لقد تم إرسال دعوات للأفراد التالية أسماؤهم:");pers_selected="";$("#btsearch'.$t.'").click();}}',
                                ))); 
                    ?>
                </div>
            </td>  
        </tr>
    </table>
    <br>
   
        <div class="note note-success">
            <p>يمكنك دعوة حكم جديد من خلال تعبئة إسمه والبريد الالكتروني</p>
        </div>
    <div>
        <table>
        <tr>
            <td width="75" style="text-align:center">
                <?php echo CHtml::label('اللقب',FALSE); ?>
            </td>
            <td width="100" >
                <?php echo CHtml::textField('txtSalutationInput','',array('id'=>'txtSalutationInput','class' => 'form-control ')); ?>
            </td>
            <td width="75" style="text-align:center">
                <?php echo CHtml::label('الاسم',FALSE); ?>
            </td>
            <td width="100" >
                <?php echo CHtml::textField('txtFnameInput','',array('id'=>'txtFnameInput','class' => 'form-control ')); ?>
            </td>
            <td width="75" style="text-align:center">
                <?php echo CHtml::label('الشهرة',FALSE); ?>
            </td>
            <td width="100" >
                <?php echo CHtml::textField('txtLnameInput','',array('id'=>'txtLnameInput','class' => 'form-control ')); ?>
            </td>
             <td width="75" style="text-align:center">
                <?php echo CHtml::label('البريد الالكتروني',FALSE); ?>
            </td>
            <td width="200">
                <?php echo CHtml::textField('txtEmailInput','',array('id'=>'txtEmailInput','class' => 'form-control ')); ?>
            </td>
            <td width="35">
                 <?php
                    $param=array();
                    $param['fname']="js:document.getElementById('txtFnameInput').value ";
                    $param['lname']="js:document.getElementById('txtLnameInput').value ";
                    $param['email']="js:document.getElementById('txtEmailInput').value ";
                    $param['salutation']="js:document.getElementById('txtSalutationInput').value ";
                    
                   
                    echo CHtml::button('إرسال الدعوة', array('id'=>'SendInvitationInput'.$t,'name'=>'SendInvitationInput'.$t,/*'class' => 'form-control', */'width' => 110,'Empty'=>'',
                            'ajax' => array(
                            'type' => 'POST',
                            'url' => CController::createAbsoluteUrl('/Admin/SendJudgeInvitationInput'),
                            'data'=>$param,
                            'cache'=>FALSE,
                            //'update' => '#level2',
                            'success'=>'function(data) {'
                                . 'if(data==-1){alert("حصل خطأ أثناء إرسال الدعوات!");}'
                                . 'else {$("#Result_SendInvite").html(data+"<br>" +$("#Result_SendInvite").html() );$("#Result_caption").html("لقد تم إرسال دعوات للأفراد التالية أسماؤهم:");pers_selected="";$("#btsearch'.$t.'").click();}}',
                            ))); 
                ?>
            </td>
            
        </table>
    </div>
        <div id="Result_caption">
            
        </div>
        <div class="table-scrollable" id="Result_SendInvite">
            
        </div>
   


