<?php
    session_start();
?>
<form action="upload.php" method="post" enctype="multipart/form-data" id="img_form">
    <input id="file_search" name="files[]" type="file" multiple>
    <input id="reset_form" type="reset" value="Clear">
    <button id="img_upload">upload files</button>
</form>
<div id="form_data"></div>
<script>
    $('#img_form').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData(this)
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            cache:false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
                $("#form_data").append(data);
            },
            error: function(data){
                $("#form_data").append("error check network connection images could not be uploaded" + data);
            }
        });
        document.getElementById("img_form").reset();
    });
</script>
