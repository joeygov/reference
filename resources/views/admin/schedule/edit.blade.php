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
                        <form class="form-sample" method="POST" action="{{ route('schedule.update', $schedule->id) }}">
                            @csrf
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Account : </label>
                                <div class="col-sm-5">
                                    <select name="account_id" id="account"
                                        class="form-control form-control-md @error('account_id') is-invalid @enderror">
                                        <option value="">Account</option>
                                        @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}"
                                            {{ old('account_id', $schedule->account_id) == $account->id ? 'selected' : '' }}>
                                            {{$account->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('account_id')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">All Employees in Action
                                    : </label>
                                <div class="col-sm-5">
                                    <input type="checkbox" name="is_all" value="1"
                                        {{ old('is_all', $schedule->is_all) == 1 ? 'checked' : '' }} id="all_employee"
                                        placeholder="Account Name">
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Employee
                                    IDs/Names:</label>
                                <div class="col-sm-5">
                                    <select name="employee[]" id="employee" data-placeholder="Employee Name" multiple
                                        class="chosen-select form-control form-control-md @error('') is-invalid @enderror">
                                        @foreach ($schedule->schedule_employee as $sched)
                                        <option value="{{ $sched->employee->id }}" selected>
                                            {{ $sched->employee->emp_id }} / {{ $sched->employee->first_name }}
                                            {{ $sched->employee->last_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Type : </label>
                                <div class="col-sm-5">
                                    <select name="is_flex"
                                        class="form-control form-control-md @error('is_flex') is-invalid @enderror">
                                        <option value="">Type</option>
                                        <option value="1"
                                            {{ old('is_flex', $schedule->is_flex) == 1 ? 'selected' : '' }}>Flex
                                        </option>
                                        <option value="0"
                                            {{ old('is_flex', $schedule->is_flex) == 0 ? 'selected' : '' }}>Fix</option>
                                    </select>
                                    @error('is_flex')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Shift Starts : </label>
                                <div class="col-sm-5">
                                    <input type="text" name="shift_starts" id="shift_starts"
                                        value="{{ old('shift_starts', $schedule->shift_starts) }}"
                                        class="shift_starts form-control form-control-lg @error('shift_starts') is-invalid @enderror"
                                        id="exampleInputEmail2" placeholder="Shift Starts">
                                    @error('shift_starts')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Shift Ends : </label>
                                <div class="col-sm-5">
                                    <input type="text" name="shift_ends" id="shift_ends"
                                        value="{{ old('shift_ends', $schedule->shift_ends) }}"
                                        class="shift_ends form-control form-control-lg @error('shift_ends') is-invalid @enderror"
                                        id="exampleInputEmail2" placeholder="Shift Starts">
                                    @error('shift_ends')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Date Starts : </label>
                                <div class="col-sm-5">
                                    <input type="text" name="start_date" id="start_date" autocomplete="off"
                                        value="{{ old('start_date', \Carbon\Carbon::parse($schedule->start_date)->format('m/d/Y')) }}"
                                        class="form-control form-control-lg @error('start_date') is-invalid @enderror"
                                        id="exampleInputEmail2" placeholder="Start Date">
                                    @error('start-date')
                                    <span class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Employee Name : </label>
                                <div class="col-sm-5">
                                    <textarea name="" id="employee_name" cols="30" rows="10"
                                        class="form-control form-control-lg @error('account_name') is-invalid @enderror">
                                        @foreach ($schedule->schedule_employee as $sched)
                                        {{ $sched->employee->emp_id }} / {{ $sched->employee->first_name }} {{ $sched->employee->last_name }}
                                        @endforeach
                                    </textarea>
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
@endsection

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
        $('#shift_starts').timepicker({});
        $('#shift_ends').timepicker({});
        $('#start_date').datepicker();
    });

    $(document).ready(function () {
        $('#account').change(function () {
            let account_id = $(this).val();
            $(".chosen-select").empty();
            $.ajax({
                type: 'GET',
                url: "{{route('schedule.getEmployee')}}",
                data: {
                    account_id: account_id
                },
                success: function (res) {
                    if (res) {
                        $('#employee_name').val('')
                        $('#all_employee').prop("checked", false)
                        $('.chosen-select').prop('disabled', false).trigger(
                            "chosen:updated");
                        $(".chosen-select").trigger("chosen:updated");
                        $.each(res, function (key, value) {
                            $(".chosen-select").append('<option value="' + key +
                                '">' + value + '</option>');
                            $(".chosen-select").trigger("chosen:updated");
                        });
                    } else {
                        $('#employee_name').val('')
                        $(".chosen-select").empty();
                    }
                }
            });
        });

        $('#all_employee').click(function () {
            if ($(this).prop("checked") == true) {
                $('.chosen-select').prop('disabled', true).trigger("chosen:updated");
                var account_id = $('#account').val();
                $.ajax({
                    type: 'GET',
                    url: "{{route('schedule.getEmployee')}}",
                    data: {
                        account_id: account_id
                    },
                    success: function (res) {
                        if (res) {
                            $('#employee_name').val('');
                            var val = ''
                            $.each(res, function (key, value) {
                                val += '\n' + value + '\n';
                            });
                            $('#employee_name').val(val);
                        } else {
                            $('#employee_name').val('');
                        }
                    }
                });
            } else if ($(this).prop("checked") == false) {
                $('.chosen-select').prop('disabled', false).trigger("chosen:updated");
                $('#employee_name').val('');
            }
        });

        $('.chosen-select').change(function () {
            var val = '';
            $('.chosen-select > option:selected').each(function () {
                var value = $(this).text();
                val += '\n' + value + '\n';
            });
            $('#employee_name').val(val);
        });
    });
</script>
@endpush