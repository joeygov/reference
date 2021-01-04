@extends('layouts.app')
@section('content')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/fingerprint/fingerprint.css') }}">
@endpush
<body onload=display_ct();>
<div class="container">
    <form method="POST">
        @csrf
        <center>
        <div class="col-md-12 text-center">
            <img src="com_logo clear.gif">
        </div>
        <div class="timer">
            <center> <input id="toggle-one" checked type="checkbox"></input></center>
            <h1 id="time"></h1>
        </div>
        <br>
        </center>
        <div class="row">
            <div class="col-md-12">
                <div class="message">
                    <span>alert message neh aria</span>
                </div>
                <center>
                <h1 id ="date"></h1>
                </center>
                <br>
            </div>  
        </div>
    </form>
</div>
@endsection
</body>
@push('js')
<script src="{{ asset('assets/js/entrypage/entrypage.js') }}" type="text/javascript"></script>
@endpush