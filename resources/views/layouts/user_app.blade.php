@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}" href="">
@endpush
@section('content')
    <div class="container-scroller">
        <!--header-->
        @include('common._headermenu')
        <div class="container-fluid page-body-wrapper">
            <!--side_menu-->
            @include('common._sidemenu')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div id="main_content">
                        @yield('maincontent')
                    </div>
                </div>
                <!--footer-->
                @include('common._footer')
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('assets/js/demo_1/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>
    @endpush
@endsection