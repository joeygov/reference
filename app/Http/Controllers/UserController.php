<?php

namespace App\Http\Controllers;

use App\Http\Managers\AttendanceManager;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(AttendanceManager $attendanceManager)
    {
        $user = Auth::user();
        $no_ongoing_break = true;
        $attendance = $attendanceManager->getAttendanceDate($user->id, new Carbon());

        if ($attendance) {
        } else {
            $attendance = new Attendance();
        }
        $show_time_in_btn = $user->is_wfh && empty($attendance->time_in);
        $show_time_out_btn = $user->is_wfh && ($no_ongoing_break) && $attendance->time_in && empty($attendance->time_out);

        return view('user.today', compact(
            'user',
            'attendance',
            'no_ongoing_break',
            'show_time_in_btn',
            'show_time_out_btn',
            )
        );
    }
}
