$("#upload").change(function () {
    readURL(this);
});

$(document).ready(function(){
    let tmpUrl = localStorage.getItem("temp_img");
    $('.image-area img').attr('src' , tmpUrl == null ? "" : tmpUrl);
    $('#temp_path').val(tmpUrl);
    if( $('#temp_path').val() || $('#upload').val() ){
    }else{
        $('#imageResult').hide();
    }

    $('#upload').change(function(e){
        let formData = new FormData();
        formData.append('photo', e.target.files[0]);
        $.ajax({
            type:'POST',
            url:'/admin/employee/image',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: formData,
            processData: false,
            contentType: false,
            timeout: 15000,
            async: true,
            success: function(data){
                $('.image-area img').show();
                $('.image-area img').attr('src', data.url);
                localStorage.setItem("temp_img", data.url);
                $('#temp_path').val(data.url);
            }
        });
    });
});