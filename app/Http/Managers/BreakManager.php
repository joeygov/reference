<?php

namespace App\Http\Managers;

use App\Models\Attendance;
use Carbon\Carbon;

class BreakManager
{
    public function setB1Start(Attendance $attendance, $breakStart = null)
    {
        $breakStart = $breakStart ? $breakStart : Carbon::now();
        $attendance->break1_start = $breakStart;
        $attendance->save();
    }

    public function setB1End(Attendance $attendance, $breakEnd = null)
    {
        $breakEnd = $breakEnd ? $breakEnd : Carbon::now();
        $attendance->break1_end = $breakEnd;
        $attendance->save();
    }

    public function setB2Start(Attendance $attendance, $breakStart = null)
    {
        $breakStart = $breakStart ? $breakStart : Carbon::now();
        $attendance->break2_start = $breakStart;
        $attendance->save();
    }

    public function setB2End(Attendance $attendance, $breakEnd = null)
    {
        $breakEnd = $breakEnd ? $breakEnd : Carbon::now();
        $attendance->break2_end = $breakEnd;
        $attendance->save();
    }

    public function setB3Start(Attendance $attendance, $breakStart = null)
    {
        $breakStart = $breakStart ? $breakStart : Carbon::now();
        $attendance->break3_start = $breakStart;
        $attendance->save();
    }

    public function setB3End(Attendance $attendance, $breakEnd = null)
    {
        $breakEnd = $breakEnd ? $breakEnd : Carbon::now();
        $attendance->break3_end = $breakEnd;
        $attendance->save();
    }

    public function setB4Start(Attendance $attendance, $breakStart = null)
    {
        $breakStart = $breakStart ? $breakStart : Carbon::now();
        $attendance->break3_start = $breakStart;
        $attendance->save();
    }

    public function setB4End(Attendance $attendance, $breakEnd = null)
    {
        $breakEnd = $breakEnd ? $breakEnd : Carbon::now();
        $attendance->break4_end = $breakEnd;
        $attendance->save();
    }

    public function getActiveBreakBtns(Attendance $attendance)
    {
        $active_buttons = [];
        if ($attendance->time_in && (is_null($attendance->time_out))) {
            if ($attendance->break4_end) {
                $active_buttons = ['out'];
            } elseif ($attendance->break4_start) {
                $active_buttons = ['break4_end'];
            } elseif ($attendance->break3_end) {
                $active_buttons = ['break4_start', 'out'];
            } elseif ($attendance->break3_start) {
                $active_buttons = ['break3_end'];
            } elseif ($attendance->break2_end) {
                $active_buttons = ['break3_start', 'break4_start', 'out'];
            } elseif ($attendance->break2_start) {
                $active_buttons = ['break2_end'];
            } elseif ($attendance->break1_end) {
                $active_buttons = ['break2_start', 'break3_start', 'break4_start', 'out'];
            } elseif ($attendance->break1_start) {
                $active_buttons = ['break1_end'];
            } else {
                $active_buttons = ['break1_start', 'break2_start', 'break3_start', 'break4_start', 'out'];
            }
        }

        return $active_buttons;
    }
}
