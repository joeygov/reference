@extends('layouts.user_app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
@endpush

@section('maincontent')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12  grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="get" class="form-sample">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <input type="text" name="employee_id" class="form-control form-control-lg" id="employee_id" placeholder="Employee ID">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-lg" id="first_name" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-lg" id="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <select name="account" id="account_id" class="form-control form-control-lg" aria-placeholder="Account">
                                                <option value="" class="form-control form-control-lg">~</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="user_status" id="user_status" class="form-control form-control-lg" aria-placeholder="User Status">
                                                <option value="" class="form-control form-control-lg">`</option>
                                                <option value="1" class="form-control form-control-lg">Active</option>
                                                <option value="2" class="form-control form-control-lg">Block</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-primary btn-rounded btn-fw search-employee">Search</button>
                                            <button type="button" class="btn btn-primary btn-rounded btn-fw search-reset">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('schedule.create') }}" class="btn btn-primary btn-rounded btn-fw new_schedule">Create New Schedule</a>
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
                                    <td>{{ $schedule->is_all }}</td>
                                    <td>{{ $schedule->is_flex }}</td>
                                    <td>{{ $schedule->shift_starts }}</td>
                                    <td>{{ $schedule->shift_ends }}</td>
                                    <td>{{ $schedule->start_date }}</td>
                                    <td>
                                        <a href=""><i class="fa fa-pencil-square-o"></i></a>
                                        <a href=""><i class="fa fa-trash-o"></i></a>
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
<script src="{{ asset('assets/admin/admin.js') }}"></script>
@endpush

@endsection
