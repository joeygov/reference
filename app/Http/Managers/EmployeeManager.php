<?php

namespace App\Http\Managers;

use App\Models\Employee;

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
        return Employee::find($empployee_id)->first();
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

            $query = Employee::with('account')->where('user_role', '!=', 3);

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
}
