<?php

namespace App\Http\Controllers;

use App\Http\Managers\AttendanceManager;
use App\Models\BreakButton;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(AttendanceManager $attendanceManager, $response = null)
    {
        $user = Auth::user();
        $no_ongoing_break = true;
        $attendance = $attendanceManager->getLatestAttendance($user->id);
        $active_break_btns = new BreakButton();
        $show_time_in_btn = $user->is_wfh && empty($attendance->time_in);
        $show_time_out_btn = $user->is_wfh && ($no_ongoing_break) && $attendance->time_in && empty($attendance->time_out);

        return view('user.today', compact(
            'user',
            'attendance',
            'no_ongoing_break',
            'show_time_in_btn',
            'show_time_out_btn',
            'active_break_btns',
            'response',
            )
        );
    }

    public function timeIn(AttendanceManager $attendanceManager)
    {
        $response = [
            'status' => 'error',
            'message' => 'Error',
        ];
        $user = Auth::user();
        if ($user->is_wfh) {
            $response = $attendanceManager->timeIn($user->id, Carbon::now());
        }

        return redirect()->route('home')
            ->with('response', $response);
    }
}
