<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Calendar;
use Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];

        $attendance = Attendance::where('employee_id', Auth::user()->id)->get();
        if ($attendance->count()) {
            foreach ($attendance as $value) {
                if ($value->statuses == 'LATE') {
                    if (!empty($value->time_in) && empty($value->time_out)) {
                        $events[] = Calendar::event(
                            ' IN : '. Carbon::parse($value->time_in)->format('h:i A '),
                             true,
                             Carbon::parse($value->time_in)->format('Y-m-d'),
                             Carbon::parse($value->time_out)->format('Y-m-d'),
                             $value->id,
                             [
                                'color' => 'red',
                             ]
                         );
                    }else {
                        $events[] = Calendar::event(
                            ' IN : '. Carbon::parse($value->time_in)->format('h:i A ') . ' , ' .
                            ' OUT : '.Carbon::parse($value->time_out)->format('h:i A '),
                             true,
                             Carbon::parse($value->time_in)->format('Y-m-d'),
                             Carbon::parse($value->time_out)->format('Y-m-d'),
                             $value->id,
                             [
                                'color' => 'red',
                             ]
                         );
                    }
                }elseif(!empty($value->time_in) && empty($value->time_out)) {
                    $events[] = Calendar::event(
                        ' IN : '. Carbon::parse($value->time_in)->format('h:i A '),
                         true,
                         Carbon::parse($value->time_in)->format('Y-m-d'),
                         Carbon::parse($value->time_out)->format('Y-m-d'),
                         $value->id,
                     );
                }elseif (!empty($value->time_in) && !empty($value->time_in)) {
                    $events[] = Calendar::event(
                        ' IN : '. Carbon::parse($value->time_in)->format('h:i A ') . ' , ' .
                        ' OUT : '.Carbon::parse($value->time_out)->format('h:i A '),
                         true,
                         Carbon::parse($value->time_in)->format('Y-m-d'),
                         Carbon::parse($value->time_out)->format('Y-m-d'),
                         $value->id,
                     );
                }
            }
        }

        $calendar = Calendar::addEvents($events);
        $calendar->setOptions([
            'headerToolbar' => [
                'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
            ]
        ]);

        return view('calendar.list', compact('calendar'));
    }
}
