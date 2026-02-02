/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function InitPictureControls(file,btn,preview)
    {
        $('#' + file ).hide();
        $('#' + btn).click(function() {
            $('#' + file).trigger('click');
        });

        $('#' + file).change(function() {
            //alert(1);
            readImgUrlAndPreview(this);
            function readImgUrlAndPreview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + preview).attr('src', e.target.result);
                    }
                }
                ;
                reader.readAsDataURL(input.files[0]);
            }
        });
    }

