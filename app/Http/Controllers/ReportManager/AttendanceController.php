<?php

namespace App\Http\Controllers\ReportManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Account;
use App\Http\Managers\AttendanceManager;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();

        $accounts = Account::all();

        return view('report_manager.attendance.list', compact('attendances', 'accounts'));
    }

    public function search(Request $request, AttendanceManager $attendanceManager)
    {
        return $attendanceManager->searchAttendance($request);
    }
}
