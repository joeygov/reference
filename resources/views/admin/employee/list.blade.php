@extends('layouts.user_app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
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
                                                @foreach ($accounts as $account)
                                                <option value="{{ $account->id }}" class="form-control form-control-lg">{{ $account->name }}</option>
                                                @endforeach
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
                        <button type="button" class="btn btn-primary btn-rounded btn-fw">Add Employee</button>
                        <table class="table table-striped table-bordered nowrap" id="employee-table">
                            <thead>
                              <tr>
                                <th> Employee ID </th>
                                <th> First Name </th>
                                <th> Last Name </th>
                                <th> Employee Type </th>
                                <th> Account </th>
                                <th> User Status </th>
                                <th> User Role </th>
                                <th> Actions </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{$employee->emp_id}}</td>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->emp_statuses }}</td>
                                    @if( empty($employee->account))
                                    <td></td>
                                    @else
                                    <td>{{ $employee->account->name }}</td>
                                    @endif
                                    <td>{{ $employee->user_statuses }}</td>
                                    <td>{{ $employee->user_roles }}</td>
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
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="{{ asset('assets/admin/admin.js') }}"></script>
@endpush

@endsection
