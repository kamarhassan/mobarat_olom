<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cls_DialogBox
 *
 * @author Samer
 */
class cls_DialogBox {
 
 
        public static function createDialogBox(
             $this_
            ,$label
            ,$class
            ,$dialogName
            ,$dialogTitle
            ,$dialogInitAction
            ,$idInputElement
            ,$idInputElementCode
            ,$iconClass
            ,$w=300
            ,$h=380
            )
        {
            $timer = "timer".$dialogName;
 /*
            echo "\t<div class='$iconClass' 
                onclick=\"{ $('#$dialogName').dialog('open');
                $timer(); // lanza el timer creado mas abajo
            }\"></div>\n";*/
            
            echo CHtml::link($label, '#', array('class'=>$class,
   'onclick'=>"{ $('#$dialogName').dialog('open');
               $timer(); // lanza el timer creado mas abajo
            }",
));
 
            self::putDialog($this_
                ,$dialogName
                ,$dialogTitle
                ,$dialogInitAction
                ,true
                ,$w
                ,$h
            );
            self::defineTimerParaCierreDeDialogo($dialogName,$idInputElement,$idInputElementCode);
        }
 
 
 
 
        public static function closeDialogBox($value,$actionResetTo)
        {
            echo "<script>
                if(window.frameElement != null)
                    window.frameElement.value='$value';
                document.location.href='$actionResetTo';
            </script>";
        }
 
 
 
        /* crea un dialogo jquery con un IFRAME dentro
         * el cual contendrá el action a ejecutar y que a su vez
         * servira como PUENTE para trasmitir el resultado
         * del dialogo mediante el atributo IFRAME.VALUE
         * el cual será establecido por el action mediante
         * DialoxBox::closeDialogBox.
         * 
         */
        private static function putDialog($this_,$dialogName,$title
            ,$iframeActionSource
            ,$modal=true,$w=400,$h=400)
        {
            $js='app'.$dialogName;
            $dialog = $dialogName;
            $iframeId = 'iframe'.$dialogName;
            $divForForm = "divForForm-$dialogName";
 
            $this_->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id'=>$dialog,
                'options'=>array(
                    'title'=>$title,
                    'autoOpen'=>false,
                    'modal'=>$modal,
                    'width'=>$w,
                    'height'=>$h,
                ),
            ));
 
            //$src = Yii::app()->baseUrl."?r=".$iframeActionSource;
 $src = $iframeActionSource;
            /* .iframeDialogBg y .iframeDialog  esta en iframe.css
             * 
             */
 
            $iframe = "<iframe value='0' height='". ($h-60)."' width='". ($w-50)."' title='response' class='iframeDialog' id='$iframeId' frameborder='0' scrolling='no' src='$src'></iframe>";
 
            $extra="<div style='cursor:pointer;' onclick='closeDialogBox()'>close</div>";
 
            echo "\n\t<div class='iframeDialogBg'>\n\t\t$iframe\n\t</div>\n\t<!-- fin -->\n";
            $this_->endWidget();
        }
 
 
        /* es un timer que se ejecuta cuando se abre el dialogo jquery.
         * 
         * se mantiene revisando por cambios de valor en el iframe.value
         * este valor (iframe.value) es establecido por el script que usa
         * el iframe, en el caso de zipcodefinder es el boton Finish. 
         * 
         * cuando este valor pasa de null o undefined a tener un valor
         * distinto entonces cierra el dialogo jquery, establece
         * al INPUT con ID $idInputElement al valor devuelto.
         */
        private static function defineTimerParaCierreDeDialogo($dialogName,$idInputElement,$idInputElementCode)
        {
            $timer = "timer".$dialogName;
            $iframe = "iframe".$dialogName;
 
            echo "\n";
            echo "<!-- timer de escucha de respuesta del dialogo '$dialogName'  -->";
            echo "\n";
            echo "<script>\n";
            echo "function $timer(){
                    var x = document.getElementById('$iframe');
                    var result = String(x.value);
                    var i=result.indexOf(':');
                    var code= result.substring(0,i);
                    var label= result.substring(i+1);
                   
                    if(!(result == null || result == 'undefined')){
                        // hay valor definido
                        document.getElementById('$idInputElement').value = label;
                        document.getElementById('$idInputElementCode').value = code;
                        // cierra el dialogo
                        //$('#$dialogName').dialog('close');
                        $('#$dialogName').dialog('close');
                            //$('.modal.in').modal('hide');
                            // $('.modal-backdrop').remove();
                        x.value = 'undefined';
                        return;                         
                    }
                    setTimeout($timer,100);
                }</script>\n\n";
        }
 
}
