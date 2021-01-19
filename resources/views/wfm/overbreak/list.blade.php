@extends('layouts.user_app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/datepicker/datepicker.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
@endpush

@section('maincontent')
<div class="main-panel">
    @include('flash-message')
    <div class="content-wrapper">
        <div class="row" id="employee_list">
            <div class="col-lg-12  grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="get" class="form-sample">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <select name="account" id="account_id" class="form-control" aria-placeholder="Account">
                                                <option value="" class="form-control form-control-lg">~</option>
                                                @foreach ($accounts as $account)
                                                <option value="{{ $account->id }}" class="form-control form-control-lg">{{ $account->name }}</option>
                                                @endforeach
                                            </select>
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
                                            <input type="text"  class="form-control form-control-lg" id="from" placeholder="From Date">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-lg" id="to" placeholder="To Date">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-primary btn-rounded btn-fw search-overbreak">Search</button>
                                            <button type="button" class="btn btn-primary btn-rounded btn-fw search-overbreak-reset">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('overbreak.create') }}" id="emp_add"  class="btn btn-primary btn-rounded btn-fw">Report An OverBreak</a>
                        <table class="table table-striped table-bordered nowrap" id="overbreak-table">
                            <thead>
                              <tr>
                                <th> Account  </th>
                                <th> First Name </th>
                                <th> Last Name </th>
                                <th> Date </th>
                                <th> OverBreak 1 </th>
                                <th> OverBreak 2 </th>
                                <th> OverBreak 3 </th>
                                <th> OverBreak 4 </th>
                                <th> Actions </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($overbreaks as $overbreak)
                                <tr>
                                    <td>{{ empty($overbreak->employee->account_id) ? '' : $overbreak->employee->account_id }}</td>
                                    <td>{{ $overbreak->employee->first_name }}</td>
                                    <td>{{ $overbreak->employee->last_name }}</td>
                                    <td>{{ $overbreak->overbreak_date ? \Carbon\Carbon::parse($overbreak->overbreak_date)->format('Y-m-d') : '~' }}</td>
                                    <td>{{ $overbreak->break1 ? \Carbon\Carbon::parse($overbreak->break1)->format('H:i:s ') : '~'}}</td>
                                    <td>{{ $overbreak->break2 ? \Carbon\Carbon::parse($overbreak->break2)->format('H:i:s ') : '~'}}</td>
                                    <td>{{ $overbreak->break3 ? \Carbon\Carbon::parse($overbreak->break3)->format('H:i:s ') : '~'}}</td>
                                    <td>{{ $overbreak->break4 ? \Carbon\Carbon::parse($overbreak->break4)->format('H:i:s ') : '~'}}</td>
                                    <td>
                                        <a href="{{ route('overbreak.edit', $overbreak->id ) }}" class="{{ \Carbon\Carbon::now()->subDays(3)  <= $overbreak->created_at ? '' : 'not-active'  }}"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('overbreak.delete', $overbreak->id ) }}" class="{{ \Carbon\Carbon::now()->subDays(3)  <= $overbreak->created_at ? '' : 'not-active'  }}"><i class="fa fa-trash-o"></i></a>
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
<script src="{{ asset('assets/vendors/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script src="{{ asset('assets/admin/admin.js') }}"></script>

<script>
$('#from').datepicker();
$('#to').datepicker();
</script>
@endpush

@endsection