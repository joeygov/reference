<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body onload=display_ct();>
<div class="container">
    <form method="POST">
        @csrf
        <center>
        <div class="col-md-12 text-center">
            <img src="com_logo clear.gif">
        </div>
        <div class="timer">
            <h1 id ="date"></h1>
            <h1 id="time"></h1>
        </div>
        <br>
        </center>
        <div class="row">
            <div class="col-md-12">
                <div class="message">
                   alert message neh aria
                </div>
                <br>
                <input id ="in" type=button value="TIME IN">
                <br>
            </div>  
        </div>
    </form>
</div>
<style>
    body{
        background-color: #5f91f5;
        font-family: Arial, Helvetica, sans-serif;
    }

    form{
        background-color: #e1e2ed;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 1), 0 6px 20px 0 rgba(0, 0, 0, 2);
        margin-top:10%; 
        margin-left:15%;
        border-radius:10px;
        width:70%;
        height:400px;
    }

    img{
        margin-top:20px; 
        width:150px;
        height:100px;
    }

    h1{
        font-weight: bold;
    }

    #in{
        float:right; 
        margin-right:40%;
        height:60px;
        background-color:#2c6ade; 
        border-radius:10px: none; 
        border: none; 
        border-radius:10px;
        width:20%;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .message {
        width: 100%;
        height:60px;
        margin-left: 0%;
        text-align: center;
        padding-top:5px;
    }
    
    .timer {
        width: 100%;
        height: 100px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        font-weight: bold;
        font-size:40;
    }

    .modal-dialog {
        margin-top: 0px;
    }

</style>
  
<!-- Configure a few settings and attach camera -->
<script language="JavaScript">

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