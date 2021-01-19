<?php

namespace App\Http\Managers;

use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EmployeeManager
{
    public function __construct()
    {
    }

    public function getEmployeeByEmpId($emp_id)
    {
        return Employee::where('emp_id', $emp_id)->first();
    }

    public function getEmployee($employee_id)
    {
        return Employee::find($employee_id)->first();
    }

    public function getEmployeeByBio($bio)
    {
        return new Employee();
    }

    public function isUserLock($employee_id)
    {
        return  Employee::USER_STATUS['LOCK'] == Employee::where('emp_id', $employee_id)->first()->user_status;
    }

    public function searchEmployee($request = null)
    {
        try {
            $employee_id = empty($request->employee_id) ? '' : $request->employee_id;
            $first_name = empty($request->first_name) ? '' : $request->first_name;
            $last_name = empty($request->last_name) ? '' : $request->last_name;
            $account_id = empty($request->account_id) ? '' : $request->account_id;
            $user_status = empty($request->user_status) ? '' : $request->user_status;

            $query = Employee::with('account');

            if (empty($employee_id) && empty($first_name) && empty($last_name) && empty($account_id) && empty($user_status)) {

                return $query->get()->toArray();
            }

            if (!empty($employee_id)) {
                $query->where('emp_id', $employee_id);
            }

            if (!empty($first_name)) {
                $query->where('first_name', 'like', '%' . $first_name . '%');
            }

            if (!empty($last_name)) {
                $query->where('last_name', 'like', '%' . $last_name . '%');
            }

            if (!empty($account_id)) {
                $query->where('account_id',  $account_id);
            }

            if (!empty($user_status)) {
                $query->where('user_status', $user_status);
            }


        } catch (\Exception $e) {
            \Log::error(get_class().':searchEmployee(): '.$e->getMessage());

            return false;
        }

        return  $query->get()->toArray();
    }

    public function insertEmployee(EmployeeRequest $request)
    {
        $retVal = false;
        $employee = new Employee();
        $image = $this->saveImage($request);

        try {
            $employee->emp_id = $request->emp_id;
            $employee->password = $request->emp_id;
            $employee->user_status = $request->user_status;
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->middle_name = $request->middle_name;
            $employee->birthdate = $request->birthdate ? Carbon::parse($request->birthdate)->format('Y-m-d His') : null;
            $employee->civil_status = $request->civil_status;
            $employee->address = $request->address;
            $employee->contact_num =  $request->contact_num;
            $employee->account_id = $request->account_id;
            $employee->emp_status = $request->emp_status;
            $employee->is_flex = $request->is_flex;
            $employee->shift_starts = $request->shift_starts;
            $employee->shift_ends = $request->shift_ends;
            $employee->hdmf_num = $request->hdmf_num;
            $employee->sss_num = $request->sss_num;
            $employee->philhealth_num = $request->philhealth_num;
            $employee->is_wfh = isset($request->is_wfh) ? $request->is_wfh : 0;
            $employee->emp_image = $image;
            $employee->save();

            $retVal = true;
        } catch (\Exception $e) {
            \Log::error(get_class().':insertEmployee(): '.$e->getMessage());

            $retVal = false;
        }

        return $retVal;
    }

    public function saveImage($request)
    {
        $filename = null;
        $imgDateTime = date('dmyHisu');

        if ($request->emp_image) {
            $ext = '.'.$request->emp_image->getClientOriginalExtension();
            $filename = (str_replace($ext, $imgDateTime.$ext, $request->emp_image->getClientOriginalName()));
            $upload_server_path = 'public/img/employee/'.$filename;
            Storage::put($upload_server_path, file_get_contents($request->emp_image));

        }

        return $filename;
    }

    public function updateEmployee(EmployeeRequest $request, Employee $employee)
    {
        $retVal = false;

        if ($request->hasFile('emp_image')) {
            $image = $this->saveImage($request);
        }else {
            $image = $request->emp_image_old;
        }

        try {
            $employee->update([
                'emp_id' => $request->emp_id,
                'user_status' => $request->user_status,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'birthdate' => $request->birthdate ? Carbon::parse($request->birthdate)->format('Y-m-d His') : null,
                'civil_status' => $request->civil_status,
                'address' => $request->address,
                'contact_num' =>  $request->contact_num,
                'account_id' => $request->account_id,
                'emp_status' => $request->emp_status,
                'is_flex' => $request->is_flex,
                'shift_starts' => $request->shift_starts,
                'shift_ends' => $request->shift_ends,
                'hdmf_num' => $request->hdmf_num,
                'sss_num' => $request->sss_num,
                'philhealth_num' => $request->philhealth_num,
                'is_wfh' => isset($request->is_wfh) ? $request->is_wfh : 0,
                'emp_image' => $image,
            ]);

            $retVal = true;

        } catch (\Exception $e) {
            \Log::error(get_class().':updateEmployee(): '.$e->getMessage());

            $retVal = false;
        }

        return $retVal;

    }
}
