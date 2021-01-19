
Webcam.set({
    width: 240,
    height: 220,
    image_format: 'jpeg',
    jpeg_quality: 90
});

Webcam.attach( '#my_camera' );

function take_snapshot() 
{
    Webcam.snap( function(data_uri) {
    $(".image-tag").val(data_uri);

    });
}
