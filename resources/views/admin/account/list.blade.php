@extends('layouts.user_app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
@endpush

@section('maincontent')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row account_list">
            <div class="col-lg-12  grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="get" class="form-sample">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <input type="text" name="id" class="form-control form-control-lg" id="account_id" placeholder="Account ID">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control form-control-lg" id="account_name" placeholder="Account Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-primary btn-rounded btn-fw search-account">Search</button>
                                            <button type="button" class="btn btn-primary btn-rounded btn-fw search-account-reset">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('account.create') }}" id="acct_add" class="btn btn-primary btn-rounded btn-fw">Add Account</a>
                        <table class="table table-striped table-bordered nowrap" id="account-table">
                            <thead>
                              <tr>
                                <th> Account ID </th>
                                <th> Account Name </th>
                                <th> Actions </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                <tr>
                                    <td>{{ $account->id }}</td>
                                    <td>{{ $account->name }}</td>
                                    <td>
                                        <a href="{{ route('account.edit', $account->id) }}}"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('account.delete', $account->id) }}}"><i class="fa fa-trash-o"></i></a>
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
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>>
<script src="{{ asset('assets/admin/admin.js') }}"></script>
@endpush

@endsection
