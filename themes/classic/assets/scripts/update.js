/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $(document).on('click', '#student_photo', function() {
        $('#upload_student').click();
    });
    $(document).on('click', '.ok', function() {
        alert('d');
//        $('.ok').modal();
    });
});
