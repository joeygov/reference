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

        if($request->employee_id == null || $request->employee_id == ' ')
        {
            $response['message'] = "Please input ID Number.";
            return view('entrypage')->with('response', $response);

        }else{

            if ($request->time == 'IN' )
            {

                $response = $this->attendanceManager->saveImage();
                $response = $this->attendanceManager->timeIn($request->employee_id, Carbon::now(), $response);

                return \Redirect::back()->with('response', $response);
    
            }else{

                $response = $this->attendanceManager->saveImage();
                $response = $this->attendanceManager->timeOut($request->employee_id, Carbon::now(), $response );

                return \Redirect::back()->with('response', $response);

            }

            return \Redirect::back()->with('response', $response);
        }
    }

    public function getEmployee(Request $request){
        $request = $request;
        $response =[
            'status' => 'success',
            'message' => 'Success',
        ];
        try {
            $empinfo = $this->employeeManager->getEmployeeByEmpId($request->employee_id);

            if(empty($empinfo)) 
            {
                $response['message'] = " ID Number Not Found.";
                $response['status'] = 'error'; 
                return $response; 

            }
            else{    
                  
                $time = Carbon::now()->format('h:i:s A');

                if($response['status'] =='success')
                {
                    $attendance = $this->attendanceManager->getActiveAttendance($request->employee_id);
                    
                    if($attendance && $request->time == 'IN' )
                    {
                        $response['message'] = 'No time out. Please time out first.';
                        $response['status'] = 'error';
                        
                        return response()->json(['res' => $response , 'employee' => $empinfo, 'time' =>$time], 200);

                    }elseif($attendance == [] && $request->time == 'OUT') {

                        $response['message'] = 'No time in. Please time in first.';
                        $response['status'] = 'error';

                        return response()->json(['res' => $response , 'employee' => $empinfo, 'time' =>$time], 200);

                    }elseif($this->employeeManager->isUserLock($request->employee_id))
                    {
                        $response['message'] = 'Employee account is locked. Please inform admin to unlock.';
                        $response['status'] = 'error';

                        return response()->json(['res' => $response , 'employee' => $empinfo, 'time' =>$time], 200);

                    }elseif($this->attendanceManager->didNotTimeOut($request->employee_id) && $request->time == 'IN')
                    {
                        $response['message'] = 'No previous time out. Please time-out first.';
                        $response['status'] = 'error';

                        return response()->json(['res' => $response , 'employee' => $empinfo, 'time' =>$time], 200);

                    }elseif($this->attendanceManager->didNotTimeOut($request->employee_id) == [] && $request->time == 'OUT')
                    {
                        $response['message'] = 'No previous time out. Please time-out first.';
                        $response['status'] = 'error';

                        return response()->json(['res' => $response , 'employee' => $empinfo, 'time' =>$time], 200);

                    }else{
                        $response['message'] = 'Successful verification';
                        $response['status'] = 'success';

                        return response()->json(['res' => $response , 'employee' => $empinfo, 'time' =>$time], 200);    
                    }

                    return response()->json(['res' => $response , 'employee' => $empinfo, 'time' =>$time], 200);
                }  
            }
                  
        }catch( \Exception $e) {

        }
    }
    

}
