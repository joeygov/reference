<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $req = \Request::route();

        if ($req->action['as'] == 'employee.reset') {
            $validate = [
                'new_password' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirm_password' => 'required_with:password|same:new_password',
                'employee_id' => 'nullable'
            ];
        }else {
            $validate =  [
                'emp_id' => 'required|numeric|digits_between:1,11',
                'user_role' => 'required',
                'user_status' =>'required',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'is_flex' => 'required|string',
                'birthdate' => 'nullable|date',
                'address' => 'nullable|string',
                'contact_num' => 'nullable|string|digits:11',
                'hdmf_num' => 'nullable|numeric|digits:12',
                'sss_num' => 'nullable|string|digits:12',
                'philhealth_num' => 'nullable|string|digits:12',
                'emp_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'email' => 'nullable|email'
            ];
        }

        return $validate;
    }
}
