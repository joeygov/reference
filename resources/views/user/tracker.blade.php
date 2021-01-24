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
<div>
    @include('flash-message')
    <div class="content-wrapper">
        <div class="row" id="employee_list">
            <div class="col-lg-12  grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" id="spinner-overlay">
                        <form action="" method="get" class="form-sample">
                            <div class="row">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <input type="text" name="from" class="form-control form-control-lg" id="from" placeholder="From Date">
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
                                        <button type="button" class="btn btn-primary btn-rounded btn-fw search-attendance">Search</button>
                                        <button type="button" class="btn btn-primary btn-rounded btn-fw search-attendance-reset">Reset</button>
                                    </div>
                            </div>
                        </form>
                        <div class="overlay">
                            <div id="spinner"></div>
                        </div>
                        <table class="table table-striped table-bordered nowrap" id="attendance-table">
                            <thead>
                              <tr>
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
                                        <td>{{ $attendance->time_in }}</td>
                                        <td>{{ $attendance->time_out }}</td>
                                        @if($attendance->total_over_break > 0)
                                        <td> <a href="">{{ empty($attendance->total_over_break ) ? '00:00:00' : $attendance->total_over_break  }}</a></td>
                                        @else
                                        <td>{{ empty($attendance->total_over_break ) ? '00:00:00' : $attendance->total_over_break  }}</td>
                                        @endif
                                        @if ($attendance->break_total > 0)
                                        <td> <a href="">{{ $attendance->break_total }}</a></td>
                                        @else
                                        <td>{{ $attendance->break_total }}</td>
                                        @endif
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
<script src="{{ asset('assets/user/tracker.js') }}"></script>

<script>
    $('#from').datepicker();
     $('#to').datepicker();
</script>
@endpush

@endsection
