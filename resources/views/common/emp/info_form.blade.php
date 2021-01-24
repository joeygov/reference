<div class="row">
        <div class="col-md-4">
            <div class="form-group row">
                <div class="col-sm-12">
                    <label class="required">Employee ID: </label>
                    <input type="text" name="emp_id" value="{{ old('emp_id', $employee->emp_id) }}" class="form-control @error('emp_id') is-invalid @enderror" placeholder="Employee ID "/>
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
                        <option value="{{ $key }}" {{ old('user_status', $employee->user_status) == $key ? 'selected' : '' }}>{{ $value }}</option>
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
                        <option value="{{ $key }}" {{ old('user_role', $employee->user_role) == $key ? 'selected' : '' }}>{{ $value }}</option>
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
                <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="FirstName" />
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
                <input type="text" name="middle_name" value="{{ old('middle_name', $employee->middle_name) }}" class="form-control @error('middle_name') is-invalid @enderror" placeholder="MiddleName" />
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
                <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="LastName" />
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
                <input type="text" name="birthdate" value="{{ old('birthdate', $employee->birthdate) }}" class="form-control @error('birthdate') is-invalid @enderror" placeholder="BirthDate" />
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
                    <option value="1" {{ old('civil_status',$employee->civil_status) == '1' ? 'selected' : '' }}>Single</option>
                    <option value="2" {{ old('civil_status',$employee->civil_status) == '2' ? 'selected' : '' }}>Married</option>
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
                <input type="text" name="address" value="{{ old('address', $employee->address ) }}" class="form-control @error('address') is-invalid @enderror" placeholder="Address" />
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
                <input type="text" name="contact_num" value="{{ old('contact_num', $employee->contact_num ) }}" class="form-control @error('contact_num') is-invalid @enderror" placeholder="Contact No." />
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
                    <option value="{{ $account->id }}" {{ old('account_id', $employee->account_id) == $account->id ? 'selected' : '' }} class="form-control form-control-lg">{{ $account->name }}</option>
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
                    <option value="{{ $key }}" {{ old('emp_status',$employee->emp_status) == $key ? 'selected' : '' }}>{{ $value }}</option>
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
                    <option value="0" {{ old('is_flex', $employee->is_flex) == '0' ? 'selected' : '' }}>Fix</option>
                    <option value="1" {{ old('is_flex', $employee->is_flex) == '1' ? 'selected' : '' }}>Flex</option>
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
                <input type="text" id="shift_start" value="{{ old('shift_starts', $employee->shift_starts) }}" name="shift_starts" class="form-control @error('shift_starts') is-invalid @enderror " autocomplete="off" placeholder="Shift Starts" />
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
                <input type="text" id="shift_end" name="shift_ends" value="{{ old('shift_ends', $employee->shift_ends) }}" class="form-control @error('shift_ends') is-invalid @enderror" autocomplete="off" placeholder="Shift End" />
                @error('shift_ends')
                <span class="error" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="">Email : </label>
                <input type="email" id="email" value="{{ old('shift_starts', $employee->email) }}" name="email" class="form-control @error('email') is-invalid @enderror " autocomplete="off" placeholder="Email" />
                @error('email')
                <span class="error" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="">HDMF# : </label>
                <input type="text" name="hdmf_num" value="{{ old('hdmf_num', $employee->hdmf_num) }}" class="form-control @error('hdmf_num') is-invalid @enderror" placeholder="HDMF#" />
                @error('hdmf_num')
                <span class="error" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="">SSS# : </label>
                <input type="text" name="sss_num" value="{{ old('sss_num', $employee->sss_num) }}" class="form-control @error('sss_num') is-invalid @enderror" placeholder="SSS#" />
                @error('sss_num')
                <span class="error" style="color:red">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="">PhilHealth# : </label>
                <input type="text" name="philhealth_num" value="{{ old('philhealth_num', $employee->philhealth_num) }}" class="form-control @error('philhealth_num') is-invalid @enderror" placeholder="PhilHealth#" />
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
                <label class="form-check-label"> <input type="checkbox" value="1" {{ old('is_wfh', $employee->is_wfh) == '1' ? 'checked' : '' }} name="is_wfh" class="form-check-input"> Work From Home </label>
            </div>
        </div>
    </div>
</div>