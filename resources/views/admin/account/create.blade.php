@extends('layouts.user_app')


@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
@endpush

@section('maincontent')
<div class="main-panel" id="employee">
    <div class="content-wrapper">
        <div class="row" id="account_row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-header">
                       <p> ADD ACCOUNT </p>
                    </div>
                    <div class="card-body">
                        <form class="form-sample" method="POST" action="{{ route('account.store') }}">
                            @csrf
                            <div class="form-group row acc_name">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Account Name : </label>
                                <div class="col-sm-5">
                                  <input type="text" name="account_name" value="{{ old('account_name') }}" class="form-control form-control-lg @error('account_name') is-invalid @enderror" id="exampleInputEmail2" placeholder="Account Name">
                                    @error('account_name')
                                        <span  class="error" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row btn_acct">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-5">
                                    <button class="btn btn-primary btn-rounded btn-fw"  type="submit">Save</button>
                                    <a href="{{ route('account.list') }}" class="btn btn-primary btn-rounded btn-fw acct_cancel">Cancel</a>
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