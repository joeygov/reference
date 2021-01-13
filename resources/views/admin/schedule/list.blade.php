@extends('layouts.user_app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/timepicker/jquery.timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/datepicker/datepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
@endpush

@section('maincontent')
<div class="main-panel">
    @include('flash-message')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12  grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="get" class="form-sample">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-lg" id="schedule_id"
                                                placeholder="Schedule ID">
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="account" id="account_id" class="form-control form-control-md"
                                                aria-placeholder="Account">
                                                <option value="" class="form-control form-control-lg">~</option>
                                                @foreach ($accounts as $account)
                                                <option value="{{$account->id}}" class="form-control form-control-md">
                                                    {{ $account->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-lg" autocomplete="off"
                                                id="start_date" placeholder="Start Date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" autocomplete="off" id="shift_starts"
                                                placeholder="Shift Start">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" autocomplete="off" id="shift_ends"
                                                placeholder="Shift End">
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="user_status" id="type" class="form-control"
                                                aria-placeholder="User Status">
                                                <option value="" class="form-control ">~</option>
                                                <option value="1" class="form-control ">Flex</option>
                                                <option value="0" class="form-control ">Fix</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button"
                                                class="btn btn-primary btn-rounded btn-fw search-schedule">Search</button>
                                            <button type="button"
                                                class="btn btn-primary btn-rounded btn-fw search-schedule-reset">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('schedule.create') }}"
                            class="btn btn-primary btn-rounded btn-fw new_schedule">Create New Schedule</a>
                        <table class="table table-striped table-bordered nowrap" id="schedule-table">
                            <thead>
                                <tr>
                                    <th> Schedule ID </th>
                                    <th> Account </th>
                                    <th> Employees Count </th>
                                    <th> All Account Employees </th>
                                    <th> Shift Starts </th>
                                    <th> Shift Ends </th>
                                    <th> Type </th>
                                    <th> Date Starts </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->id }}</td>
                                    <td>{{ $schedule->account_id }}</td>
                                    <td>{{ $schedule->schedule_employee()->count() }}</td>
                                    <td>{{ $schedule->is_all ? 'Yes' : 'No'  }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->shift_starts)->format('H:i a') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->shift_ends)->format('H:i a')  }}</td>
                                    <td>{{ $schedule->is_flexs }}</td>
                                    <td>{{ $schedule->start_date }}</td>
                                    <td>
                                        <a href="{{ route('schedule.edit', $schedule->id) }}"><i
                                                class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('schedule.delete', $schedule->id) }}"><i
                                                class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{ asset('assets/vendors/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/vendors/timepicker/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/admin/admin.js') }}"></script>
@endpush

@endsection