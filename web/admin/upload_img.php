<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../collection_view.php');
        die();
    }
    include "dz_img_upload.php";
?>
<script>
    $('#img_form').on('submit', function (e) {

        e.preventDefault();
        var upload_img = $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        });
        upload_img.done(function(data) {
           $("#form_data").html(data);
        });
        upload_img.fail(function(data) {
           $("#form_data").html("<div>error check network connection images could not be uploaded" + data + "</div>");
        });
       document.getElementById("img_form").reset();
    });
</script>
