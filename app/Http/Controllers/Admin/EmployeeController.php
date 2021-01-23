<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Managers\EmployeeManager;
use App\Http\Requests\EmployeeRequest;
use App\Models\Account;
use App\Models\Employee;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();

        $accounts = Account::all();

        return view('admin.employee.list', compact('employees', 'accounts'));
    }

    public function search(Request $request, EmployeeManager $employeeManager)
    {
        return $employeeManager->searchEmployee($request);
    }

    public function create()
    {
        $accounts = Account::all();
        $employee = new Employee();

        return view('admin.employee.create', compact('accounts', 'employee'));
    }

    public function store(EmployeeRequest $request, EmployeeManager $employeeManager)
    {
        $retVal = false;

        if ($request->hasFile('emp_image') || !empty($request->temp_path)) {
            $exploded = explode('/', $request->temp_path);
            $filename = end($exploded);
            $path = storage_path().'/app/public/img/temp/'.$filename;
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $file = new UploadedFile(
                $path,
                $filename,
                $finfo->file($path),
                filesize($path),
                0,
                false
            );

            if (!empty($file)) {
                $request->request->add(['emp_image' => $file]);
            }
        }

        $retVal = $employeeManager->insertEmployee($request);

        if ($retVal) {
            return redirect()->route('employee.list')->with('success', 'Successfully Created Employee!');
        }

        return redirect()->back()->with('error', 'Transaction Error');
    }

    public function updateImage(Request $request)
    {
        $file = $request->file('photo');

        $imgURL = Employee::uploadPathTmpFile($file);

        if ($imgURL) {
            $url = explode('/storage', $imgURL);
            if (count($url) > 1) {
                $imgURL = '/storage'.$url[1];

                return response()->json([
                'url' => $imgURL,
            ], 200);
            }
        }

        return response()->json([
            'error' => __('errors.fail.create'),
        ], 500);
    }

    public function edit(Employee $employee)
    {
        $accounts = Account::all();

        return view('admin.employee.edit', compact('employee', 'accounts'));
    }

    public function update(EmployeeRequest $request, Employee $employee, EmployeeManager $employeeManager)
    {
        if ($request->hasFile('emp_image')) {
            $request->request->add(['emp_image' => $request->emp_image]);
        }

        if ($employeeManager->updateEmployee($request, $employee)) {
            return redirect()->route('employee.list')->with('success', 'Updated Successfully');
        }

        return redirect()->route('employee.list')->with('error', 'Transaction Error!');
    }

    public function destroy(Employee $employee)
    {
        $employees = Employee::find($employee->id);
        $employees->delete();

        return redirect()->back()->with('success', 'Deleted Successfully');
    }

    public function reset(EmployeeRequest $request, EmployeeManager $employeeManager)
    {
        $emp = $employeeManager->getEmployee($request->employee_id);

        if (!Hash::check($request->old_password, $emp->password)) {
            return redirect()->back()->with('error', 'Current password does not match!');
        }

        $reset = $employeeManager->resetPassword($request, $emp);

        if ($reset) {
            return redirect()->back()->with('success', 'Password Updated Successfully');
        }

        return redirect()->back()->with('error', 'Transaction Error');
    }
}
