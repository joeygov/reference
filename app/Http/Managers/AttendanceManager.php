<?php

namespace App\Http\Managers;

use App\Models\Attendance;

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
            $attendance = Attendance::where('employee_id', $employee_id);
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
        $attendance->status = $this->getAttendanceStatus($employee_id, $time_in);
        $attendance->save();
    }

    private function getAttendanceStatus($employee_id, $time_in)
    {
        $status = Attendance::STATUS['FLEX'];
        $employee = $this->empManager->getEmployee($employee_id);
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
        $image_link = '';
        $response = [
            'status' => 'error',
            'message' => 'Error',
        ];
        if ($this->empManager->isUserLock($employee_id)) {
            $response['message'] = 'Employee account is locked. Please inform admin to unlock.';
        } elseif ($this->didNotTimeOut($employee_id)) {
            $response['message'] = 'No previous time out. Please time-out first.';
        } else {
            if ($image) {
                //call method to save image here;
                $image_link = 'some link here';
            }

            $this->setEmployeeTimeIn($employee_id, $time_in, $image_link);

            $response['status'] = 'success';
            $response['message'] = 'Successful Time In';
        }

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
        if ($attendance) {
            if ($image) {
                //call method to save image here;
                $image_link = '';
                $attendance->time_in_image = $image_link;
            }
            $attendance->time_out = $time_out;
            $attendance->save();
            $response['status'] = 'success';
            $response['message'] = 'Successful Time out';
        } else {
            $response['message'] = 'No time in. Please time in first.';
        }

        return $response;
    }
}
