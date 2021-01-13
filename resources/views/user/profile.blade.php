@extends('layouts.user_app')
@section('title')
Today's Tracker
@endsection
@section('maincontent')
<div class="card">
    <div class="card-body">
        <form class="flex-container-column" method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="flex-container-row space-between">
                <div class="grow-1">
                    @include('common.emp.img_form')
                </div>
                <div class="grow-3">
                    <fieldset disabled="disabled">
                    @include('common.emp.info_form')
                    </fieldset>
                </div>
            </div>
        </form>
        
    </div>
</div>
@endsection
@push('js')
@endpush
