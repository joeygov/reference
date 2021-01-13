<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Account;
use App\Http\Managers\ScheduleManager;
use App\Http\Requests\ScheduleRequest;

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

    public function getEmployee(Request $request, ScheduleManager $scheduleManager)
    {
        $employee =  $scheduleManager->getEmployeeByAccountId($request->account_id);

        return $employee;
    }

    public function store(ScheduleRequest $request, ScheduleManager $scheduleManager)
    {
        $schedule = $scheduleManager->insertSchedule($request);

        if ($schedule) {
            return redirect()->route('schedule.list')->with('success', 'Created Schedule Successfully');
        }

        return redirect()->route('schedule.list')->with('error', 'Transaction Error!');
    }

    public function edit(Schedule $schedule)
    {
        $accounts = Account::all();

        return view('admin.schedule.edit', compact('schedule', 'accounts'));
    }

    public function update(ScheduleRequest $request, Schedule $schedule, ScheduleManager $scheduleManager)
    {
        $schedule = $scheduleManager->updateSchedule($request, $schedule);

        if ($schedule) {
            return redirect()->route('schedule.list')->with('success', 'Update Schedule Successfully');
        }

        return redirect()->route('schedule.list')->with('error', 'Transaction Error!');
    }

    public function destroy(Schedule $schedule, ScheduleManager $scheduleManager)
    {
        $scheds = $scheduleManager->getScheduleById($schedule->id);

        foreach ($scheds as $sched) {
            $sched->delete();
        }

        $schedule->delete();

        if ($schedule) {
            return redirect()->route('schedule.list')->with('success', 'Deleted Schedule Successfully');
        }

        return redirect()->route('schedule.list')->with('error', 'Transaction Error!');
    }

    public function search(Request $request, ScheduleManager $scheduleManager)
    {
        return $scheduleManager->searchSchedule($request);
    }
}
