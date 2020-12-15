<!DOCTYPE html>
<html>
<head>
    <title>Capture webcam image with php and jquery - ItSolutionStuff.com</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body onload=display_ct();>
<div class="container">
    <form method="POST" action="{{url('captureImage')}}">
        @csrf
        <center>
        <div class="col-md-12 text-center">
                    <img src="com_logo clear.gif">
            </div>
            <div class="timer">
                <h2 id ="date"></h2>
                <h2 id="time"></h2>
            </div>
        </center>
        <div class="row">
            <div class="col-md-6">
                <div class="idAsk">
                    <input placeholder="Employee ID" type="text" id="inputID"><br><br>
                </div>
                <div class="buttons">
                    <input id="in" type=button  value="IN" onClick="take_snapshot();">
                    <input id ="out" type=button value="OUT" onclick="window.location='{{route('modal')}}'" >
                    <input type="hidden" name="image" class="image-tag">
                </div>
            </div>
            <div class="col-md-6">
                <div id="my_camera"></div>
            </div>
            <div class="col-md-12 text-center" style="margin-top:10px;">
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
        <br>
        <center>
            <h5>Make sure face is facing the camera.</h5>
        </center>
    </form>
</div>
<style>
    body{
        background-color: #6d99f2;
        font-family: Arial, Helvetica, sans-serif;
    }

    form{

        background-color: #e1e2ed;
        margin-top:2%; 
        margin-left:100px;
        border-radius:10px;
        display: center;
        width:80%;

    }
    img{
        margin-top:20px; 
        width:200px;
        height:150px;
    }

    h1{
        font-weight: bold;
    }
    h5{
        padding-bottom:30px;
    }

    #in{
        float:left;
        background-color: #2a7ddb;
        outline: none; border: none; 
        border-radius:10px
    }
    #out{
        float:right; 
        background-color:#e3403d; 
        border-radius:10px: none; 
        border: none; 
        border-radius:10px
    }

    #my_camera {
        text-align: center;
        margin-top:0%;
        float:left;
        margin-left:100px;
        /* margin-left:10px; */
        width: 50%;
        height: 360px;
        margin-left: 5%;
    }

    .idAsk {
        width: 100%;
        margin-left: 0%;
        text-align: center;
    }

    .buttons {
        width: 40%;
        margin-left: 30%;
        padding-top:20px;
    }

    .timer {
        width: 100%;
        height: 100px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        padding: 10px;
        font-weight: bold;
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
  
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    Webcam.set({
        width: 250,
        height: 200,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() 
    {
        Webcam.snap( function(data_uri) {
        $(".image-tag").val(data_uri);
        //document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        console.log("snappy");
        //alert("fdfhsdfjs");
        });
    }

    function display_c()
    {
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct()',refresh);
    }

    //display currenttime
    function display_ct() {
        var months = [ "January", "February", "March", "April", "May", "June", 
           "July", "August", "September", "October", "November", "December" ];

        var x = new Date()
        var month =months[ x.getMonth()];
        var hours = x.getHours();
        var minutes = x.getMinutes();
        var seconds = x.getSeconds();
        var date =month +" "+ x.getDate() + ", " + x.getFullYear();
        var ampm = hours <= 12 ? 'AM' : 'PM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' +seconds : seconds;
        var currentTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        document.getElementById('date').innerHTML = date;
        document.getElementById('time').innerHTML = currentTime;
        display_c();
    }

    function ok(){
        location.reload();
    }
</script>
</body>
</html>