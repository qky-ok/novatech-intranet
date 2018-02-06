Dropzone.autoDiscover = false;

$(document).ready(function(){
    var dropzone = new Dropzone('#dropzone', {
        paramName: "file_name",
        url: "/parts/file-upload",
        maxFilesize: 2,
        maxFiles : 10,
        uploadMultiple : false,
        acceptedFiles : ".jpg, .png, .gif",
        addRemoveLinks : false,
        clickable : true,
        autoProcessQueue: true,
        sending: function(file, xhr, formData) {
            formData.append("_token", $('[name=_token]').val());
        },
        success: function(file){
            $('.image-upload-container').append('<input type="hidden" name="part_images[]" value="'+ file.name +'" autocomplete="off" required>');
        }
    });

    $(document).on('click', '.part-image-delete', function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('[name=_token]').val() }
        });

        var file_id     = $(this).attr('id').split('_'); file_id = file_id[1];
        var file_name   = $(this).data('fileName');
        $.ajax({
            type        : "POST",
            url         : "/parts/file-delete",
            data        : { "file_id" : file_id, "file_name" : file_name },
            dataType    : "json",
            complete: function(xhr, textStatus) {
                if(xhr.status === 200){
                    $('#remove_' + file_id).parent().fadeOut(800, function(){ $(this).remove(); });
                }
            }
        });
    });
});