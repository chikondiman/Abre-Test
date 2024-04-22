

<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="/core/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <h1>File Upload test</h1>
        <input type="file" name="resourcefile" id="resource-file">
        <button id="upload-btn-form">Upload via Form Data</button>
        <button id="upload-btn-file">Upload via File Data</button>
        <div id="result-container"></div>
        <img id="result-image" style="padding-left: 5px;justify-content: center; max-width: 150px; " src="">
     
    </body>
</html>


<?php

?>



<script>
//POST USING FORM DATA
$(function(){
    $('#upload-btn-form').click(function(event) {
        // Prevent the default action (button click)
        event.preventDefault();

        // Get the selected file
        var file = $('#resource-file')[0].files[0];

        // Create FormData object
        var formData = new FormData();
        
        // Append the file to FormData
        formData.append('resourcefile', file);

        // Send FormData via AJAX
        $.ajax({
            type: 'POST',
            url: '/test_post.php',
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting contentType
            success: function(response) {
                // Replace the content of the container with the response
                $('#result-container').html(response);
            }
        });
    });



//POST NOT USING FORM DATA
    $('#upload-btn-file').click(function(event) {
        // Prevent the default action (button click)
        event.preventDefault();

        // Get the selected file
        var file = $('#resource-file')[0].files[0];

        var reader = new FileReader();
        reader.onload = function(event) {
            var fileData = event.target.result;

            // Construct the data object to send via AJAX
            var data = {
                filename: file.name,
                filetype: file.type,
                filedata: fileData
            };

            $.ajax({
                type: 'POST',
                url: '/test_post.php',
                data: data,
                success: function(response) {
                    // Replace the content of the container with the response
                    $('#result-container').html(response);
                }
            });

        };
        reader.readAsDataURL(file);
    });
});

</script>