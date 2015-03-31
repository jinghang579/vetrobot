$(document).ready(function() { 
    $('#photoimg').live('change', function(){ 
                       $("#preview").html('');
                $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
            $("#imageform").ajaxForm({
                        target: '#preview'
        }).submit();     
    });
}); 
$(document).ready(function() { 
    $('#photoimg1').live('change', function(){ 
                       $("#preview1").html('');

                $("#preview1").html('<img style="width=80px;height:90px;" alt="Uploading...."/>'); 
            $("#imageform1").ajaxForm({
                        target: '#preview1'
        }).submit();     
    });
}); 
function previewImage() {
    document.getElementById("uploadPreview").style.display="";
    var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("key_cover").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
};