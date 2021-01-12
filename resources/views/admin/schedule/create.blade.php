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
                        <form class="form-sample" method="POST" action="">
                            @csrf
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Account : </label>
                                <div class="col-sm-5">
                                    <select name="account_id" id="account" class="form-control form-control-md @error('account_id') is-invalid @enderror">
                                        <option value="">Account</option>
                                        @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}">{{$account->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('account_id')
                                        <span  class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">All Employees in Action : </label>
                                <div class="col-sm-5">
                                  <input type="checkbox" name="account_name" value="{{ old('account_name') }}" id="all_employee" placeholder="Account Name">
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Employee IDs/Names:</label>
                                <div class="col-sm-5">
                                    <select name="employee[]" id="employee" data-placeholder="Employee Name" multiple class="chosen-select form-control form-control-md @error('account_id') is-invalid @enderror">
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                                    @error('employee')
                                        <span  class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Type : </label>
                                <div class="col-sm-5">
                                    <select name="is_flex" class="form-control form-control-md @error('is_flex') is-invalid @enderror">
                                        <option value="">Type</option>
                                        <option value="0">Flex</option>
                                        <option value="1">Fix</option>
                                    </select>
                                    @error('is_flex')
                                        <span  class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Shift Starts : </label>
                                <div class="col-sm-5">
                                  <input type="text" name="shift_starts" id="shift_starts" value="{{ old('shift_starts') }}" class="shift_starts form-control form-control-lg @error('shift_starts') is-invalid @enderror" id="exampleInputEmail2" placeholder="Shift Starts">
                                    @error('shift_starts')
                                        <span  class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Shift Ends : </label>
                                <div class="col-sm-5">
                                    <input type="text" name="shift_ends" id="shift_ends" value="{{ old('shift_ends') }}" class="shift_ends form-control form-control-lg @error('shift_ends') is-invalid @enderror" id="exampleInputEmail2" placeholder="Shift Starts">
                                    @error('shift_ends')
                                        <span  class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Date Starts : </label>
                                <div class="col-sm-5">
                                  <input type="text" name="start_date" id="start_date" autocomplete="off" value="{{ old('start_date') }}" class="form-control form-control-lg @error('start_date') is-invalid @enderror" id="exampleInputEmail2" placeholder="Start Date">
                                    @error('start-date')
                                        <span  class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row schedule">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Employee Name : </label>
                                <div class="col-sm-5">
                                    <textarea name="" id="" cols="30" rows="10"  class="form-control form-control-lg @error('account_name') is-invalid @enderror"></textarea>
                                </div>
                            </div>
                            <div class="form-group row btn_acct">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-5">
                                    <button class="btn btn-primary btn-rounded btn-fw"  type="submit">Save</button>
                                    <a href="" class="btn btn-primary btn-rounded btn-fw acct_cancel">Cancel</a>
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

    $(document).ready(function(){
        $('#shift_starts').timepicker({});
        $('#shift_ends').timepicker({});
        $('#start_date').datepicker();
    });


</script>
@endpush