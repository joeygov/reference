<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Managers\AttendanceManager;
use App\Http\Managers\BreakManager;
use App\Http\Managers\EmployeeManager;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class EntryPageController extends Controller
{

    protected $attendanceManager;
    protected $breakManager;
    protected $employeeManager;

    public function __construct(AttendanceManager $attendanceManager, BreakManager $breakManager, EmployeeManager $employeeManager)
    {
        $this->attendanceManager = $attendanceManager;
        $this->breakManager = $breakManager;
        $this->employeeManager = $employeeManager;
    }

    public function entryPage()
    {
        return view('entrypage');
    }

    public function fingerprint()
    {
        return view('fingerprint');
    }
    
    public function timeInOut(Request $request)
    {   
        $response =[
            'status' => 'error',
            'message' => 'Error',
        ];

        if ($request->time == 'IN' ){
        
            $empinfo = $this->getInfo($request->employee_id);
            $response = $this->attendanceManager->saveImage();
            $response = $this->attendanceManager->timeIn($request->employee_id, Carbon::now(), $response);

        }else{
            
            $empinfo = $this->getInfo($request->employee_id);
            $response = $this->attendanceManager->saveImage();
            $response = $this->attendanceManager->timeOut($request->employee_id, Carbon::now(), $response );
        }

        return view('entrypage', compact('empinfo'))->with('response', $response); 
        
    }

    public function getInfo($employee_id)
    {
        $empinfo = $this->employeeManager->getEmployeeByEmpId($employee_id);

        return $empinfo;
    }

}
