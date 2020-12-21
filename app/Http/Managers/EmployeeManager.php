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
        return Employee::find($employee_id)->first();
    }

    public function getEmployeeByBio($bio)
    {
        return new Employee();
    }

    public function isUserLock($employee_id)
    {
        return  Employee::USER_STATUS['USER_STATUS'] == Employee::where('id', $employee_id)->first()->user_status;
    }
}
