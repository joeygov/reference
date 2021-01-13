@extends('layouts.user_app')


@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/timepicker/jquery.timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
@endpush

@section('maincontent')

<div class="main-panel" id="employee">
    <div class="content-wrapper">
        <div class="row" id="employee_row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <form class="flex-container-column" method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="flex-container-row grow-3 space-between">
                                <div class="grow-1">
                                    @include('common.emp.img_form')
                                </div>
                                <div class="grow-3">
                                    @include('common.emp.info_form')
                                </div>
                            </div>
                            <div class="flex-container-row grow-1 space-between">
                                <div></div>
                                <button class="btn btn-primary btn-rounded btn-fw" type="button">Register Fingerprint</button>
                                <button class="btn btn-primary btn-rounded btn-fw" type="submit">Save</button>
                                <a href="{{ route('employee.list') }}" class="btn btn-primary btn-rounded btn-fw cancel_btn" type="button">Cancel</a>
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
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
<script src="{{ asset('assets/vendors/timepicker/jquery.timepicker.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<script>
    $("#upload").change(function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imageResult').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function(){
        $('#shift_start').timepicker({});
        $('#shift_end').timepicker({});
    });

    $(document).ready(function(){
        let tmpUrl = localStorage.getItem("temp_img");
        $('.image-area img').attr('src' , tmpUrl == null ? "" : tmpUrl);
        $('#temp_path').val(tmpUrl);
        if( $('#temp_path').val() || $('#upload').val() ){
        }else{
            $('#imageResult').hide();
        }

        $('#upload').change(function(e){
            let formData = new FormData();
            formData.append('photo', e.target.files[0]);
            $.ajax({
                type:'POST',
                url:'/admin/employee/image',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: formData,
                processData: false,
                contentType: false,
                timeout: 15000,
                async: true,
                success: function(data){
                    $('.image-area img').show();
                    $('.image-area img').attr('src', data.url);
                    localStorage.setItem("temp_img", data.url);
                    $('#temp_path').val(data.url);
                }
            });
        });
    });
</script>
@endpush