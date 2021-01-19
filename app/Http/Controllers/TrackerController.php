<?php

namespace App\Http\Controllers;

use App\Http\Managers\AttendanceManager;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackerController extends Controller
{
    protected $attendanceManager;

    public function __construct(AttendanceManager $attendanceManager)
    {
        $this->attendanceManager = $attendanceManager;
    }

    public function index()
    {
        $attendances = $this->attendanceManager->getAllAttendance(Auth::user()->id);
        $accounts = Account::all();

        return view('user.tracker', compact(
            'attendances', 'accounts'
        ));
    }

    public function search(Request $request, AttendanceManager $attendanceManager)
    {
        $request->employee_id = Auth::user()->id;

        return $attendanceManager->searchAttendance($request);
    }

    public function calendar()
    {
        $attendance = $this->attendanceManager->getAllAttendance(Auth::user()->id);

        return view();
    }
}
