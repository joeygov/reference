<?php

namespace App\Http\Managers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceManager
{
    protected $empManager;

    public function __construct(EmployeeManager $empManager)
    {
        $this->empManager = $empManager;
    }

    public function getAllAttendance($employee_id = null)
    {
        if ($employee_id) {
            $attendance = Attendance::where('employee_id', $employee_id)->get();
        } else {
            $attendance = Attendance::all();
        }

        return $attendance;
    }

    public function getActiveAttendance($employee_id)
    {
        return Attendance::where('employee_id', $employee_id)
            ->whereNotNull('time_in')
            ->whereNull('time_out')
            ->first();
    }


    public function getAttendanceDate($employee_id, $date)
    {
        return  Attendance::where('employee_id', $employee_id)
            ->whereDate('time_in', $date->format('Y-m-d'))->first();
    }

    public function getLatestAttendance($employee_id)
    {
        $attendance = new Attendance();
        $latest = Attendance::where('employee_id', $employee_id)
            ->orderBy('time_in', 'DESC')->first();
        if ($latest && is_null($latest->time_out)) {
            $attendance = $latest;
        }

        return $attendance;
    }

    public function didNotTimeOut($employee_id)
    {
        $attendance = Attendance::where('employee_id', $employee_id)
            ->whereNull('time_out')
            ->whereNotNull('time_in')
            ->orderBy('time_in', 'DESC')
            ->first();

        return $attendance ? true : false;
    }

    private function setEmployeeTimeIn($employee_id, $time_in, $image_link = null)
    {
        $attendance = new Attendance();
        $attendance->employee_id = $employee_id;
        $attendance->time_in = $time_in;
        $attendance->time_in_image =$image_link;
        $attendance->status = $this->getAttendanceStatus($employee_id, $time_in, $image_link);
        $attendance->save();

        return $attendance;
    }

    
    private function getAttendanceStatus($employee_id, $time_in)
    {
        $status = Attendance::STATUS['FLEX'];
        $employee = $this->empManager->getEmployeeByEmpId($employee_id);
        if (!$employee->is_flex) {
            if ($employee->shift_starts) {
                $is_late = $employee->shift_starts < strtotime($time_in->format('H:i'));
                $status = $is_late ? Attendance::STATUS['LATE'] : Attendance::STATUS['ON_TIME'];
            } else {
                $status = Attendance::STATUS['ON_TIME'];
            }
        }

        return $status;
    }

    public function timeIn($employee_id, $time_in, $image = null)
    {
        $image_link = null;

        if ($image) {
            $this->saveImage($image);
            $image_link = $image;
        }

        $this->setEmployeeTimeIn($employee_id, $time_in, $image_link);

        $response['status'] = 'success';
        $response['message'] = 'Successfully Time In';

        return $response;
    }

    public function timeOut($employee_id, $time_out, $image = null)
    {
      
        $response = [
            'status' => 'error',
            'message' => 'Error',
        ];
        $image_link = null;

        $attendance = $this->getActiveAttendance($employee_id);

            if ($image) {

                $this->saveImage($image);
                $image_link = $image;
                $attendance->time_out_image = $image_link;
            }
            $attendance->time_out = $time_out;
            $attendance->save();
            $response['status'] = 'success';
            $response['message'] = 'Successfully Time out';

        return $response;
    }
    
    public function saveImage()
    {
        $img = $_POST['image'];
        $folderPath = storage_path('/app/ ');
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $current = date('mYdmHs');
        $fileName = $current . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
    
        return $fileName;
    }


    public function searchAttendance($request = null)
    {
        try {
            $employee_id = empty($request->employee_id) ? '' : $request->employee_id;
            $first_name = empty($request->first_name) ? '' : $request->first_name;
            $last_name = empty($request->last_name) ? '' : $request->last_name;
            $account_id = empty($request->account_id) ? '' : $request->account_id;
            $status = empty($request->status) ? '' : $request->status;
            $from = empty($request->from) ? '' : Carbon::parse($request->from)->format('Y-m-d');
            $to = empty($request->to) ? '' : Carbon::parse($request->to)->format('Y-m-d');

            $query = Attendance::with('employee');

            if (empty($employee_id) && empty($first_name) && empty($last_name) && empty($account_id) && empty($status) && empty($from) && empty($to)) {
                return $query->get()->toArray();
            }

            if (!empty($employee_id)) {
                $query->whereHas('employee', function ($q) use ($employee_id) {
                    $q->where('emp_id', $employee_id);
                });
            }

            if (!empty($first_name)) {
                $query->where('first_name', 'like', '%'.$first_name.'%');
            }

            if (!empty($last_name)) {
                $query->where('last_name', 'like', '%'.$last_name.'%');
            }

            if (!empty($account_id)) {
                $query->whereHas('employee', function ($q) use ($account_id) {
                    $q->where('account_id', $account_id);
                });
            }

            if (!empty($status)) {
                $query->where('status', $status);
            }

            if (!empty($from)) {
                if (empty($to)) {
                    $query->whereDate('time_in', $from);
                }
            }

            if (!empty($to)) {
                if (empty($from)) {
                    $query->whereDate('time_in', '<=', $to);
                }
            }

            if (!empty($to) && !empty($from)) {
                $query->whereBetween('time_in', [$from, $to]);
            }

            return  $query->get()->toArray();
        } catch (\Exception $e) {
            \Log::error(get_class().':searchAttendance(): '.$e->getMessage());

            return false;
        }
    }
}
