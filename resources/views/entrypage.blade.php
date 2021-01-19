
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
    <form method="POST" action="{{route('entrytimeinout')}}">
        @csrf
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="label" value =''></h3>
                    </div>          
                <!-- Modal body -->
                    <center>
                    <div class="modal-body">
                    <h4 id="status" style="color:red;"></h4>
                    <h3 id="ctime"></h3>
                    <h3 id="info"></h3>
                    </center>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type ="submit" name="time" value="" id="submit" class="btn btn-success" label='OK'></input>
                        <button type="cancel" id ="cancel" class="btn btn-default" data-dismiss="modal" label='CANCEL'>CANCEL</button>
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
                <h3>{{date("F d, Y")}}</h3>
                <h3 id="time"></h3>
            </div>

            <span id="alert">
             @include('flash-message')
            </span>

        </center>
        <div class="row">
            <div class="col-md-6">
                <div class="idAsk">
                    <input placeholder="Employee ID" type="text" name="employee_id" id="employee_id" value="">
                    <br>
                    <br>
                    <span id="response" style="color:red;"></span>
                    <br> 
                    <br>
                    <button id="in" type="button"  data-in = 'IN' value="IN"  onClick ="take_snapshot()">IN</button>
                    <button id="out" type="button"  data-out = 'OUT' value="OUT" onClick="take_snapshot()" >OUT</button>
                    <input type="hidden" id="checking" value="checking">
                    <input type="hidden" id="image_tag" name="image" class="image-tag">
                </div>
            </div>
            <div class="col-md-6">                
                <div class="border border-dark" id="my_camera"></div>
            </div>
        </div>
        <br>
        <br>
        <center>
            <h5>Make sure face is facing the camera.</h5>
        </center>
        <br>
    </form>
</div>
@endsection()
</body>
@push('js')
<script src="{{ asset('assets/js/entrypage/camera.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/entrypage/entrypage.js') }}" type="text/javascript"></script>

@endpush


