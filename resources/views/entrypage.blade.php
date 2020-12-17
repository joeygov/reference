<!DOCTYPE html>
<html>
<head>
    <title>Capture webcam image with php and jquery - ItSolutionStuff.com</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body onload=display_ct();>
<div class="container">
    <form method="POST" action="{{url('captureImage')}}">
        @csrf
         <!-- Modal STARTS -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">TIME IN</h4>
                    </div>          
                <!-- Modal body -->
                    <center>
                    <div class="modal-body">
                        <h5>TIME</h5>
                        <h5>Employee Name:</h5>
                    </div>
                    </center>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-success">OK</button>
                        <button type="button" id ="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
         <!-- Modal ENDS -->
        <center>
        <div class="col-md-12 text-center">
                <img src="com_logo clear.gif">
        </div>
            <div class="timer">
                <h3 id ="date"></h3>
                <h3 id="time"></h3>
            </div>
        </center>
        <div class="row">
            <div class="col-md-6">
                <div class="idAsk">
                    <input placeholder="Employee ID" type="text" name="employee_id" id="inputId">
                </div>
                <input id="in" type=button  value="IN" onClick="take_snapshot();" data-toggle="modal" data-target="#myModal" >
                <input id ="out" type=button value="OUT" data-toggle="modal" data-target="#myModal" >
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">                
                <div class="border border-dark" id="my_camera"></div>
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
        background-color: #edf1f2;
        font-family: Arial, Helvetica, sans-serif;
    }

    form{

        background-color: #e1e2ed;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 1), 0 6px 20px 0 rgba(0, 0, 0, 2);
        margin-top:2%; 
        margin-left:15%;
        border-radius:10px;
        display: center;
        width:70%;
    }

    img{
        margin-top:20px; 
        width:150px;
        height:100px;
    }

    h3{
        font-weight: bold;
        font-size: 24;
    }

    h5{
        padding-bottom:10px;
        font-size:24;
    }

    button{
        width:80px;
    }

    #inputId{
        span:80px;
    }

    #ok{
        background-color:#2a7ddb;
    }

    #cancel{
        background-color:#e3403d;
    }

    #in{
        float:left;
        margin-left:28%;
        background-color: #2a7ddb;
        outline: none; border: none; 
        border-radius:10px;
        width:20%;
        margin-top:0px;
        box-shadow: 2px 3px 5px 2px black;
        /* box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
    }
    #out{
        float:right; 
        margin-right:28%;
        background-color:#e3403d; 
        border-radius:10px: none; 
        border: none; 
        border-radius:10px;
        width:20%;
        box-shadow: 2px 3px 5px 2px black;
        /* box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
    }

    #my_camera {
        text-align: center;
        /* margin-top:0%; */
        float:left;
        /* margin-left:100px; */
        /* margin-left:10px; */
        width: 50%;
        height: 100px;
        margin-left: 5%;
        background-color: black;
        border-radius:10px; 
    }

    .idAsk {
        width: 100%;
        height:60%;
        margin-left: 0%;
        text-align: center;
        /* background-color:yellow; */
        /* padding-top:7px; */
    }
    .timer {
        width: 100%;
        height: 100px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        /* padding: 5px; */
        font-weight: bold;
        font-size:40;
        /* background-color:green; */
    }

    input {
        outline: none;
        width: 50%;
        padding: 15px;
        border: 2px solid #555555;
    }

    .modal-dialog {
        margin-top: 0px;
    }

    #myModal {
        background-color: rgba(177, 177, 177, 0.8);
    }
</style>
  
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
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
        // document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
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