<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
</head>

<body  onload=display_ct();>
    <div class="card" style="background-color:Ivory">
        <div class="timer">
            <h1>TELE-NET TIME TRACKER</h1>
            <h1 id="time"><h1>
        </div>
        <div id="camera" >
        </div>
        <div class="idAsk">
            <input placeholder="Employee ID" type="text" id="inputID">
            <div class="buttons">
                <button class="in" id="in" data-target="#myModal" data-toggle="modal" onclick="snapshot(); queryId()">In</button>
                <button class="out" id="in">Out</button>
            </div>
        </div>
        <p class="reminder" style="margin-top:70px;">Please make sure face is facing the camera.</p>
    </div>
    <div id="snapShot">
    </div>
</body>

</html>
<style>
    body {
        background-image: url("https://industrywired.com/wp-content/uploads/2020/03/Here_are-Top-10-Emerging-Technologies-Worth-Investing-in-for-2020.jpeg");
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h1 {
        font-weight: bold;
    }

    .reminder {
        margin-top: 5%;
        text-align: center;
        font-weight: bold;
    }

    #camera {
        text-align: center;
        float: right;
        width: 30%;
        border: 1px solid #000000;
        height: 250px;
        margin-right: 8%;
        background-repeat: no-repeat;
    }

    .idAsk {
        width: 80%;
        margin-left: 8%;
        margin-bottom: 10px;
    }

    button {
        font-size: 20px;
        padding: 5px;
        width: 40%;
        margin: 5%;
        border-radius: 10px;
        outline: none;
        border: none;
    }

    .in {
        background-color: rgb(58, 104, 255);
    }

    .in:active {
        background-color: rgb(53, 77, 155);
    }

    .out {
        background-color: rgb(255, 89, 89);
    }

    .out:active {
        background-color: rgb(189, 69, 69);
    }

    .buttons {
        width: 50%;
        margin-left: 8%;
        margin-top:10px;
    }

    .timer {
        width: 100%;
        height: 200px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        padding: 10px;
    }

    .card {
        margin-top: 5%;
        overflow: auto;
        height: auto;
        width: 70%;
        padding: 30px;
        border: 1px solid #000000;
        margin-left: auto;
        margin-right: auto;
    }

    input {
        outline: none;
        width: 50%;
        padding: 15px;
    }
    .modal-dialog {
        margin-top: 300px;
    }
    #myModal {
        background-color: rgba(177, 177, 177, 0.8);
    }
</style>

<script>

function display_c(){
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct()',refresh);
}
//display currenttime
function display_ct() {
    var x = new Date()
    var hours = x.getHours();
    var minutes = x.getMinutes();
    var seconds = x.getSeconds();
    var ampm = hours <= 12 ? 'AM' : 'PM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' +seconds : seconds;
    var currentTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    document.getElementById('time').innerHTML = currentTime;
    display_c();
 }

 function ok(){
     location.reload();
 }

//setting webcam
//  Webcam.set({
//         width: 180,
//         height: 194.38,
//         image_format: 'jpeg',
//         jpeg_quality: 50
//     });
//     Webcam.attach('#camera');  

// //display captured image
// function snapshot(){
//     Webcam.snap(function (data_uri) {
//             document.getElementById('snapShot').innerHTML = 
//                 '<img src="' + data_uri + '" width="70px" height="50px" />';
//         });
//     $('#camera').fadeOut('quick');
//     $('#camera').fadeIn('quick');
      
// }

</script>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width:500px; height:600px; position-align:center;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title">TIME IN</h1>
            </div>
            <div class="modal-body">
                <p>ORAS KUNG KANUS_A NILOGIN<p id="inputed"></p>.</p>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <button onclick ="ok()">OK</button>
                    <button>Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>