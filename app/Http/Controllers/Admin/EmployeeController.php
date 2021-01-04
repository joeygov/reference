<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Managers\EmployeeManager;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CsvExport;
use App\Models\Employee;
use App\Models\Account;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where('user_role', '!=', 3)->get();

        $accounts = Account::all();

        return view('admin.employee.list', compact('employees', 'accounts'));
    }

    public function search(Request $request, EmployeeManager $employeeManager)
    {
        return $employeeManager->searchEmployee($request);
    }

}
