@extends('layouts.user_app')


@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/timepicker/jquery.timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
@endpush

@section('maincontent')

<div class="main-panel" id="employee">
    <div class="content-wrapper">
        <div class="row" id="employee_row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <form class="flex-container-column" method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="flex-container-row grow-3 space-between">
                                <div class="grow-1">
                                    @include('common.emp.img_form')
                                </div>
                                <div class="grow-3">
                                    @include('common.emp.info_form')
                                </div>
                            </div>
                            <div class="flex-container-row grow-1 space-between">
                                <div></div>
                                <button class="btn btn-primary btn-rounded btn-fw" type="button">Register Fingerprint</button>
                                <button class="btn btn-primary btn-rounded btn-fw" type="button">Reset Password</button>
                                <button class="btn btn-primary btn-rounded btn-fw" type="submit">Save</button>
                                <a href="{{ route('employee.list') }}" class="btn btn-primary btn-rounded btn-fw cancel_btn" type="button">Cancel</a>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/vendors/timepicker/jquery.timepicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/upload.js') }}"></script>
@endpush