@extends('layouts.user_app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('assets/vendors/datepicker/datepicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/spinner/spin.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
@endpush

@section('maincontent')
<div class="main-panel">
    @include('flash-message')
    <div class="content-wrapper">
        <div class="row" id="employee_list">
            <div class="col-lg-12  grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" id="spinner-overlay">
                        <form action="" method="get" class="form-sample">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <input type="text" name="employee_id" class="form-control form-control-lg" id="employee_id" placeholder="Employee ID">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-lg" id="first_name" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-lg" id="last_name" placeholder="Last Name">
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="account" id="account_id" class="form-control" aria-placeholder="Account">
                                                <option value="" class="form-control form-control-lg">~</option>
                                                @foreach ($accounts as $account)
                                                <option value="{{ $account->id }}" class="form-control form-control-lg">{{ $account->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <input type="text" name="employee_id" class="form-control form-control-lg" id="from" placeholder="From Date">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-lg" id="to" placeholder="To Date">
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="account" id="status" class="form-control" aria-placeholder="Account">
                                                <option value="" class="form-control form-control-lg">~</option>
                                                @foreach (M_Attendance::STATUS as $key => $att)
                                                <option value="{{ $att }}" class="form-control form-control-lg">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="button" class="btn btn-primary btn-rounded btn-fw search-attendance">Search</button>
                                            <button type="button" class="btn btn-primary btn-rounded btn-fw search-attendance-reset">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="overlay">
                            <div id="spinner"></div>
                        </div>
                        <table class="table table-striped table-bordered nowrap" id="attendance-table">
                            <thead>
                              <tr>
                                <th> Employee ID </th>
                                <th> First Name </th>
                                <th> Last Name </th>
                                <th> Time In </th>
                                <th> Time Out </th>
                                <th> Over Break Total </th>
                                <th> Break Total </th>
                                <th> Status </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->employee->emp_id }}</td>
                                        <td>{{ $attendance->employee->first_name }}</td>
                                        <td>{{ $attendance->employee->last_name }}</td>
                                        <td>{{ $attendance->time_in }}</td>
                                        <td>{{ $attendance->time_out }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $attendance->statuses }}</td>
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
<script src="{{ asset('assets/vendors/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/vendors/spinner/spin.js') }}"></script>
<script src="{{ asset('assets/vendors/spinner/spin.umd.js') }}"></script>
<script src="{{ asset('assets/admin/admin.js') }}"></script>

<script>
    $('#from').datepicker();
     $('#to').datepicker();
</script>
@endpush

@endsection
