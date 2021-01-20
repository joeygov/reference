@extends('layouts.user_app')

@push('css')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
@endpush

@section('maincontent')
<div class="main-panel">
    @include('flash-message')
    <div class="content-wrapper">
        <div class="row" id="calendar_list">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {!! $calendar->calendar() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
{!! $calendar->script() !!}
@endpush

@endsection
