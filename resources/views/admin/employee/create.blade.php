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
                        <form class="form-sample" method="POST" action="{{ route('employee.add') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="left_image">
                                <div class="row py-4">
                                    <div class="col-lg-6 mx-auto">
                                        <div class="image-area mt-4">
                                            <img id="imageResult" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
                                        </div>
                                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm upload-button">
                                            <input id="upload" type="file" name="emp_image" class="form-control border-0">
                                            <input type="hidden" id="temp_path" name="temp_path" class="form-control" >
                                            <label id="upload-label" class="font-weight-light text-muted">Choose File</label>
                                            <div class="input-group-append upload-container">
                                                <label for="upload" class="btn btn-light m-0 rounded-pill px-4">
                                                    <i class="fa fa-cloud-upload mr-2 text-muted"></i>
                                                    <small class="text-uppercase font-weight-bold text-muted">Choose File</small>
                                                </label>
                                            </div>
                                        </div>
                                        @error('emp_image')
                                            <span class="error" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" id="button">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <button class="btn btn-primary btn-rounded btn-fw" type="button">Register Fingerprint</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <button class="btn btn-primary btn-rounded btn-fw" type="button">Register Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="right_form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="required">Employee ID: </label>
                                                <input type="text" name="emp_id" value="{{ old('emp_id') }}" class="form-control @error('emp_id') is-invalid @enderror" placeholder="Employee ID "/>
                                                @error('emp_id')
                                                <span  class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="required">User Status: </label>
                                                <select name="user_status" class="form-control  @error('user_status') is-invalid @enderror">
                                                    <option value="">User Status</option>
                                                    @foreach (M_Employee::STATUS as $key => $value)
                                                    <option value="{{ $key }}" {{ old('user_status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_status')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="required">User Role: </label>
                                                <select name="user_role" class="form-control @error('user_role') is-invalid @enderror">
                                                    <option value="">User Role</option>
                                                    @foreach (M_Employee::ROLE as $key => $value)
                                                    <option value="{{ $key }}" {{ old('user_role') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_role')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="required">FirstName: </label>
                                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="FirstName" />
                                                @error('first_name')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">MiddleName : </label>
                                                <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="form-control @error('middle_name') is-invalid @enderror" placeholder="MiddleName" />
                                                @error('middle_name')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="required">LastName : </label>
                                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="LastName" />
                                                @error('last_name')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">Birth Date : </label>
                                                <input type="text" name="birthdate" value="{{ old('birthdate') }}" class="form-control @error('birthdate') is-invalid @enderror" placeholder="BirthDate" />
                                                @error('birthdate')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">Civil Status : </label>
                                                <select name="civil_status" class="form-control @error('civil_status') is-invalid @enderror">
                                                    <option value="">Civil Status</option>
                                                    <option value="1" {{ old('civil_status') == '1' ? 'selected' : '' }}>Single</option>
                                                    <option value="2" {{ old('civil_status') == '2' ? 'selected' : '' }}>Married</option>
                                                </select>
                                                @error('civil_status')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">Address : </label>
                                                <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" placeholder="Address" />
                                                @error('address')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">Contact No. : </label>
                                                <input type="text" name="contact_num" value="{{ old('contact_num') }}" class="form-control @error('contact_num') is-invalid @enderror" placeholder="Contact No." />
                                                @error('contact_num')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">Account : </label>
                                                <select name="account_id" class="form-control @error('account_id') is-invalid @enderror">
                                                    <option value="">Account</option>
                                                    @foreach ($accounts as $account)
                                                    <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }} class="form-control form-control-lg">{{ $account->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('account_id')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">Employment Type : </label>
                                                <select name="emp_status" class="form-control @error('emp_status') is-invalid @enderror">
                                                    <option value="">Employment Type</option>
                                                    @foreach (M_Employee::TYPE as $key => $value)
                                                    <option value="{{ $key }}" {{ old('emp_status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                @error('emp_status')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="required">Fix/Flex Schedule : </label>
                                                <select name="is_flex" class="form-control @error('is_flex') is-invalid @enderror">
                                                    <option value="">Fix/Flex Schedule</option>
                                                    <option value="0" {{ old('is_flex') == '0' ? 'selected' : '' }}>Fix</option>
                                                    <option value="1" {{ old('is_flex') == '1' ? 'selected' : '' }}>Flex</option>
                                                </select>
                                                @error('is_flex')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">Shift Starts : </label>
                                                <input type="text" id="shift_start" value="{{ old('shift_start') }}" name="shift_starts" class="form-control @error('shift_starts') is-invalid @enderror " autocomplete="off" placeholder="Shift Starts" />
                                                @error('shift_starts')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">Shift End : </label>
                                                <input type="text" id="shift_end" name="shift_ends" value="{{ old('shift_end') }}" class="form-control @error('shift_ends') is-invalid @enderror" autocomplete="off" placeholder="Shift End" />
                                                @error('shift_ends')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">HDMF# : </label>
                                                <input type="text" name="hdmf_num" value="{{ old('hdmf_num') }}" class="form-control @error('hdmf_num') is-invalid @enderror" placeholder="HDMF#" />
                                                @error('hdmf_num')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">SSS# : </label>
                                                <input type="text" name="sss_num" value="{{ old('sss_num') }}" class="form-control @error('sss_num') is-invalid @enderror" placeholder="SSS#" />
                                                @error('sss_num')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">PhilHealth# : </label>
                                                <input type="text" name="philhealth_num" value="{{ old('philhealth_num') }}" class="form-control @error('philhealth_num') is-invalid @enderror" placeholder="PhilHealth#" />
                                                @error('philhealth_num')
                                                <span class="error" style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="form-check">
                                                <label> Fingerprint : <span style="color:red;">Unregistered</span> </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label"> <input type="checkbox" value="1" name="is_wfh" class="form-check-input"> Work From Home </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="butt">
                                <div class="col-md-3" >
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary btn-rounded btn-fw"  type="submit">Save</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 cancel_butt">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <a href="{{ route('employee.list') }}" class="btn btn-primary btn-rounded btn-fw cancel_btn" type="button">Cancel</a>
                                        </div>
                                    </div>
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