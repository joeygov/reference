<?php

namespace App\Http\Controllers;

use App\Http\Managers\AttendanceManager;
use App\Http\Managers\BreakManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $attendanceManager;
    protected $breakManager;

    public function __construct(AttendanceManager $attendanceManager, BreakManager $breakManager)
    {
        $this->attendanceManager = $attendanceManager;
        $this->breakManager = $breakManager;
    }

    public function index($response = null)
    {
        $user = Auth::user();
        $attendance = $this->attendanceManager->getLatestAttendance($user->id);
        $active_break_btns = $this->breakManager->getActiveBreakBtns($attendance);
        $show_time_in_btn = $user->is_wfh && empty($attendance->time_in);

        return view('user.today', compact(
            'user',
            'attendance',
            'show_time_in_btn',
            'active_break_btns',
            'response',
            )
        );
    }

    public function timeIn()
    {
        $response = [
            'status' => 'error',
            'message' => 'Error',
        ];
        $user = Auth::user();
        if ($user->is_wfh) {
            $response = $this->attendanceManager->timeIn($user->id, Carbon::now());
        }

        return redirect()->route('home')
            ->with('response', $response);
    }

    public function timeOut()
    {
        $response = [
            'status' => 'error',
            'message' => 'Error',
        ];
        $user = Auth::user();
        if ($user->is_wfh) {
            $response = $this->attendanceManager->timeOut($user->id, Carbon::now());
        }

        return redirect()->route('home')
            ->with('response', $response);
    }

    public function setB1Start()
    {
        $response = [];
        $attendance = $this->attendanceManager->getActiveAttendance(Auth::user()->id);
        $this->breakManager->setB1Start($attendance);

        return redirect()->route('home');
    }

    public function setB1End()
    {
        $attendance = $this->attendanceManager->getActiveAttendance(Auth::user()->id);
        $this->breakManager->setB1End($attendance);

        return redirect()->route('home');
    }

    public function setB2Start()
    {
        $attendance = $this->attendanceManager->getActiveAttendance(Auth::user()->id);
        $this->breakManager->setB2Start($attendance);

        return redirect()->route('home');
    }

    public function setB2End()
    {
        $attendance = $this->attendanceManager->getActiveAttendance(Auth::user()->id);

        $this->breakManager->setB2End($attendance);

        return redirect()->route('home');
    }

    public function setB3Start()
    {
        $attendance = $this->attendanceManager->getActiveAttendance(Auth::user()->id);
        $this->breakManager->setB3Start($attendance);

        return redirect()->route('home');
    }

    public function setB3End()
    {
        $response = [];
        $attendance = $this->attendanceManager->getActiveAttendance(Auth::user()->id);
        $this->breakManager->setB3End($attendance);

        return redirect()->route('home');
    }

    public function setB4Start()
    {
        $attendance = $this->attendanceManager->getActiveAttendance(Auth::user()->id);

        $this->breakManager->setB4Start($attendance);

        return redirect()->route('home');
    }

    public function setB4End()
    {
        $attendance = $this->attendanceManager->getActiveAttendance(Auth::user()->id);

        $this->breakManager->setB4End($attendance);

        return redirect()->route('home');
    }

}
