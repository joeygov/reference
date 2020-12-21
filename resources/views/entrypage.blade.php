
@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/entrypage/entrypage.css') }}">
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
@endpush
@section('content')
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
@endsection()
</body>
@push('js')
<script src="{{ asset('assets/js/entrypage/camera.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/entrypage/entrypage.js') }}" type="text/javascript"></script>
@endpush


