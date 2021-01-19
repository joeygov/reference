<?php

namespace App\Http\Managers;

use App\Models\Schedule;
use App\Models\Employee;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ScheduleEmployee;

class ScheduleManager
{
    public function getEmployeeByAccountId($emp_id)
    {
        return $employee = Employee::select(
                DB::raw("CONCAT(emp_id,' / ',first_name,' ',last_name) AS name"),'id')
                ->where('account_id', $emp_id)->pluck('name', 'id');

    }

    public function insertSchedule(Request $request)
    {
        $retVal = false;

        try {
            $schedule = new Schedule();
            $schedule->account_id = $request->account_id;
            $schedule->is_all = $request->is_all ? 1 : 0;
            $schedule->is_flex = $request->is_flex;
            $schedule->shift_starts = $request->shift_starts;
            $schedule->shift_ends = $request->shift_ends;
            $schedule->start_date = $request->start_date ? Carbon::parse($request->start_date)->format('Y-m-d His') : null;
            $schedule->save();

            if ($schedule && $request->has('is_all')) {
                $employees= $this->getAllEmployee($request->account_id);

                foreach ($employees as $employee) {
                    $schedule_employees = new ScheduleEmployee();
                    $schedule_employees->schedule_id = $schedule->id;
                    $schedule_employees->employee_id = $employee->id;
                    $schedule_employees->save();
                }
            }elseif ($schedule && $request->has('employee')) {
                $employees = $request->employee;

                foreach ($employees as $indx => $employee) {
                    $schedule_employees = new ScheduleEmployee();
                    $schedule_employees->schedule_id = $schedule->id;
                    $schedule_employees->employee_id = $employee;
                    $schedule_employees->save();
                }
            }

            $retVal = true;
        } catch (\Exception $e) {
            \Log::error(get_class().':insertSchedule(): '.$e->getMessage());

            $retVal = false;
        }

        return $retVal;
    }

    public function getAllEmployee($account_id)
    {
        return Employee::where('account_id',$account_id)->get();
    }

    public function updateSchedule(Request $request, Schedule $schedule)
    {
        $retVal = false;

        try {
            $schedule->update([
                'account_id' => $request->account_id,
                'is_all' => $request->is_all ? 1 : 0,
                'is_flex' => $request->is_flex,
                'shift_starts' => $request->shift_starts,
                'shift_ends' => $request->shift_ends,
                'start_date' => $request->start_date ? Carbon::parse($request->start_date)->format('Y-m-d His') : null
            ]);


            if ($schedule && $request->has('is_all')) {
                $employees = $this->getAllEmployee($request->account_id);
                $schedule_employees = ScheduleEmployee::where('schedule_id', $schedule->id);
                $employee_ids = $schedule_employees->pluck('employee_id')->toArray();
                foreach ($employees as $employee) {
                    $ind = array_search($employee->id, $employee_ids);
                    if ($ind !== false) {
                        unset($employee_ids[$ind]);
                    }
                    $scheds = ScheduleEmployee::where('schedule_id', $schedule->id)->where('employee_id', $employee->id);
                    if ($scheds->count() > 0) {
                        $sched_first = $scheds->first();
                        if ($scheds->count() > 1) {
                            $scheds->where('id', '!=', $sched_first->id)->delete();
                        }
                    } else {
                        ScheduleEmployee::create([
                            'schedule_id' => $schedule->id,
                            'employee_id' => $employee->id
                        ]);
                    }
                }

                ScheduleEmployee::where('schedule_id', $schedule->id)->whereIn('employee_id', $employee_ids)->delete();

            } elseif ($schedule && $request->has('employee')) {
                $employees = $request->employee;
                $schedule_employees = ScheduleEmployee::where('schedule_id', $schedule->id);
                $employee_ids = $schedule_employees->pluck('employee_id')->toArray();
                foreach ($employees as $employee_id) {
                    // unset ids that are updated
                    $ind = array_search($employee_id, $employee_ids);
                    if ($ind !== false) {
                        unset($employee_ids[$ind]);
                    }
                    $scheds = ScheduleEmployee::where('schedule_id', $schedule->id)->where('employee_id', $employee_id);
                    if ($scheds->count() > 0) {
                        $sched_first = $scheds->first();
                        if ($scheds->count() > 1) {
                            $scheds->where('id', '!=', $sched_first->id)->delete();
                        }
                    } else {
                        ScheduleEmployee::create([
                            'schedule_id' => $schedule->id,
                            'employee_id' => $employee_id
                        ]);
                    }
                }

                ScheduleEmployee::where('schedule_id', $schedule->id)->whereIn('employee_id', $employee_ids)->delete();
            }

            $retVal = true;

        } catch (\Exception $e) {
            \Log::error(get_class().':updateSchedule(): '.$e->getMessage());

            $retVal = false;
        }

        return $retVal;
    }

    public function getScheduleById($schedule_id)
    {
        return ScheduleEmployee::where('schedule_id' ,$schedule_id)->get();
    }

    public function searchSchedule($request = null)
    {
        try {
            $schedule_id = empty($request->schedule_id) ? '' : $request->schedule_id;
            $start_date = empty($request->start_date) ? '' : Carbon::parse($request->start_date)->format('Y-m-d His');
            $shift_starts = empty($request->shift_starts) ? '' : Carbon::parse( $request->shift_starts);
            $account_id = empty($request->account_id) ? '' : $request->account_id;
            $shift_ends = empty($request->shift_ends) ? '' : Carbon::parse( $request->shift_ends);
            $type = is_null($request->type) ? '' : (( $request->type == 0 ? 0: 1));

            $query = Schedule::with('schedule_employee');

            if (empty($schedule_id) && empty($start_date) && empty($shift_starts) && empty($account_id) && empty($shift_ends) && !is_int($type)  ) {
                return $query->get()->toArray();
            }

            if (!empty($schedule_id)) {
                $query->where('id', 'like', '%' . $schedule_id . '%');
            }

            if (!empty($start_date)) {
                $query->whereDate('start_date', $start_date);
            }

            if (!empty($account_id)) {
                return $account_id;
                $query->where('account_id', 'like', '%' .  $account_id . '%');
            }

            if ($type == 0) {
                $query->where('is_flex', FALSE );
            }elseif ($type == 1) {
                $query->where('is_flex', TRUE );
            }else {
                $query->where('is_flex', $type );
            }

            if (!empty($shift_starts)) {
                if(empty($shift_ends)){
                    $query->whereTime('shift_starts', $shift_starts );
                }
            }

            if (!empty($to)) {
                if(empty($shift_starts)){
                    $query->whereTime('shift_ends', '<=', $shift_ends);
                }
            }

            if (!empty($shift_ends) && !empty($shift_starts)) {
                $query->whereTime('shift_starts', '>=', $shift_starts)
                        ->whereTime('shift_ends', '<=', $shift_ends);
            }

            return $query->get()->toArray();

        } catch (\Exception $e) {
            \Log::error(get_class().':searchSchedule(): '.$e->getMessage());

            return false;
        }
    }
}


