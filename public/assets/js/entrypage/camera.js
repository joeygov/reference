Webcam.set({
    width: 200,
    height: 180,
    image_format: 'jpeg',
    jpeg_quality: 90
});

Webcam.attach( '#my_camera' );

function take_snapshot() 
{
    Webcam.snap( function(data_uri) {
    $(".image-tag").val(data_uri);
    console.log("snappy");
    });
}