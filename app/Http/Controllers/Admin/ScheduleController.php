<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Account;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();

        $accounts = Account::all();

        return view('admin.schedule.list', compact('schedules', 'accounts'));
    }

    public function create()
    {
        $accounts = Account::all();

        return view('admin.schedule.create', compact('accounts'));
    }
}
