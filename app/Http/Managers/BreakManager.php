<?php

namespace App\Http\Managers;

use Carbon\Carbon;

class BreakManager
{
    protected $attendance;
    protected $empManager;
    protected $attendanceManager;

    public function __construct(Attendance $attendance, EmployeeManager $empManager, AttendanceManager $attendanceManager)
    {
        $this->attendance = $attendance;
        $this->empManager = $empManager;
        $this->attendanceManager = $attendanceManager;
    }

    public function setB1Start($breakStart = null)
    {
        $breakStart = $breakStart ? $breakStart : Carbon::now();
        $this->attendance->break1_start = $breakStart;
        $this->attendance->save();
    }

    public function setB1End($breakEnd = null)
    {
        $breakEnd = $breakEnd ? $breakEnd : Carbon::now();
        $this->attendance->break1_end = $breakEnd;
        $this->attendance->save();
    }

    public function setB2Start($breakStart = null)
    {
        $breakStart = $breakStart ? $breakStart : Carbon::now();
        $this->attendance->break2_start = $breakStart;
        $this->attendance->save();
    }

    public function setB2End($breakEnd = null)
    {
        $breakEnd = $breakEnd ? $breakEnd : Carbon::now();
        $this->attendance->break2_end = $breakEnd;
        $this->attendance->save();
    }

    public function setB3Start($breakStart = null)
    {
        $breakStart = $breakStart ? $breakStart : Carbon::now();
        $this->attendance->break3_start = $breakStart;
        $this->attendance->save();
    }

    public function setB3End($breakEnd = null)
    {
        $breakEnd = $breakEnd ? $breakEnd : Carbon::now();
        $this->attendance->break3_end = $breakEnd;
        $this->attendance->save();
    }

    public function setB4Start($breakStart = null)
    {
        $breakStart = $breakStart ? $breakStart : Carbon::now();
        $this->attendance->break3_start = $breakStart;
        $this->attendance->save();
    }

    public function setB4End($breakEnd = null)
    {
        $breakEnd = $breakEnd ? $breakEnd : Carbon::now();
        $this->attendance->break4_end = $breakEnd;
        $this->attendance->save();
    }

    public function getActiveBreakBtns(Attendance $attendance)
    {
        return new BreakButton();
    }
}
