@extends('layouts.user_app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/timepicker/jquery.timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/chosen/chosen.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/datepicker/datepicker.css') }}">

<style>
    .ui-timepicker-wrapper {
        width: 309px !important;
    }

</style>
@endpush

@section('maincontent')
<div class="main-panel" id="employee">
    <div class="content-wrapper">
        <div class="row" id="account_row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <form class="form-sample" method="POST" action="{{ route('overbreak.store') }}">
                            @csrf
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label required">Employee
                                    IDs/Names:</label>
                                <div class="col-sm-5">
                                    <select name="employee" id="employee_id" data-placeholder="Employee Name"
                                        class="chosen-select form-control form-control-md @error('employee_id') is-invalid @enderror">
                                        <option value="">~</option>
                                        @foreach ($employees as $key => $employee)
                                        <option value="{{ $key }}">{{ $employee }} </option>
                                        @endforeach
                                    </select>
                                    @error('employee')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Date : </label>
                                <div class="col-sm-5">
                                    <input type="text" name="overbreak_date" id="overbreak_date" autocomplete="off"
                                        value="{{ old('start_date') }}"
                                        class="form-control form-control-lg @error('start_date') is-invalid @enderror"
                                        id="exampleInputEmail2" placeholder="Start Date">
                                    @error('start_date')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Over Break 1 : </label>
                                <div class="col-sm-5">
                                    <input type="text" name="break1" id="break1"
                                        value="{{ old('break1') }}"
                                        class="shift_starts form-control form-control-lg @error('break1') is-invalid @enderror"
                                        id="exampleInputEmail2" placeholder="Over Break 1">
                                    @error('break1')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Over Break 2 : </label>
                                <div class="col-sm-5">
                                    <input type="text" name="break2" id="break2" value="{{ old('break2') }}"
                                        class="break2 form-control form-control-lg @error('break2') is-invalid @enderror"
                                        id="exampleInputEmail2" placeholder="Over Break 2">
                                    @error('break2')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Over Break 3 : </label>
                                <div class="col-sm-5">
                                    <input type="text" name="break3" id="break3"
                                        value="{{ old('break3') }}"
                                        class="break3 form-control form-control-lg @error('break3') is-invalid @enderror"
                                        id="exampleInputEmail2" placeholder="Over Break 3">
                                    @error('break3')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Over Break 4 : </label>
                                <div class="col-sm-5">
                                    <input type="text" name="break4" id="break4" value="{{ old('break4') }}"
                                        class="break4 form-control form-control-lg @error('break4') is-invalid @enderror"
                                        id="exampleInputEmail2" placeholder="Over Break 4">
                                    @error('break4')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row btn_acct">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-5">
                                    <button class="btn btn-primary btn-rounded btn-fw" type="submit">Save</button>
                                    <a href="{{ route('schedule.list') }}" class="btn btn-primary btn-rounded btn-fw acct_cancel">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{ asset('assets/vendors/chosen/chosen.jquery.js') }}"></script>
<script src="{{ asset('assets/vendors/timepicker/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datepicker/bootstrap-datepicker.js') }}"></script>

<script>
    $('.chosen-select').chosen({
        width: '100%',
        search_contains: true,
    });

    $(document).ready(function () {
        $('#break1').timepicker({
            'timeFormat': 'h:i:s A'
        });

        $('#break2').timepicker({
            'timeFormat': 'h:i:s A'
        });

        $('#break3').timepicker({
            'timeFormat': 'h:i:s A'
        });

        $('#break4').timepicker({
            'timeFormat': 'h:i:s A'
        });

        $('#overbreak_date').datepicker();
    });
</script>
@endpush

@endsection
