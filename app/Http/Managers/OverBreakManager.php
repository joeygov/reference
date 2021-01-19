<?php

namespace App\Http\Managers;

use App\Models\OverBreak;
use App\Http\Requests\AccountRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class OverBreakManager{

    public function insertOverBreak(Request $request)
    {
        $retVal = false;

        try {
            $overbreak = new OverBreak();
            $overbreak->employee_id = $request->employee;
            $overbreak->overbreak_date = $request->overbreak_date ? Carbon::parse($request->overbreak_date)->format('Y-m-d His') : null;
            $overbreak->break1 = $request->break1;
            $overbreak->break2 = $request->break2;
            $overbreak->break3 = $request->break3;
            $overbreak->break4 = $request->break4;
            $overbreak->created_by = Auth::user()->emp_id;
            $overbreak->save();

            $retVal = true;
        } catch (\Exception $e) {
            \Log::error(get_class().':insertOverBreak(): '.$e->getMessage());

            $retVal = false;
        }

        return $retVal;
    }

    public function updateOverBreak(Request $request, OverBreak $overbreak)
    {
        $retVal = false;

        try {

            $overbreak->update([
                'employee_id' => $request->employee,
                'overbreak_date' => $request->overbreak_date ? Carbon::parse($request->overbreak_date)->format('Y-m-d His') : null,
                'break1' => $request->break1,
                'break2' => $request->break2,
                'break3' => $request->break3,
                'break4' => $request->break4,
                'updated_by' => Auth::user()->emp_id
            ]);
            $retVal = true;
        } catch (\Exception $e) {
            \Log::error(get_class().':updateOverBreak(): '.$e->getMessage());

            $retVal = false;
        }

        return $retVal;
    }

    public function searchOverbreak($request = null)
    {
        try {
            $account_id = empty($request->account_id) ? '' : $request->account_id;
            $first_name = empty($request->first_name) ? '' : $request->first_name;
            $last_name = empty($request->last_name) ? '' : $request->last_name;
            $start_date = empty($request->start_date) ? '' : Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = empty($request->end_date) ? '' :Carbon::parse($request->end_date)->format('Y-m-d');

            $query = OverBreak::with('employee');

            if (empty($account_id) && empty($first_name) && empty($last_name) && empty($start_date) && empty($end_date)) {

                return $query->get()->toArray();
            }

            if (!empty($account_id)) {
                $query->whereHas('employee', function ($q) use ($account_id) {
                   $q->where('account_id', $account_id);
                });
            }

            if (!empty($first_name)) {
                $query->whereHas('employee', function ($q) use ($first_name) {
                   $q->where('first_name', 'like', '%' . $first_name . '%');
                });
            }

            if (!empty($last_name)) {
                $query->whereHas('employee', function ($q) use ($last_name) {
                   $q->where('last_name', 'like', '%' . $last_name . '%');
                });
            }

            if (!empty($start_date)) {
                if (empty($end_date)) {
                    $query->whereDate('overbreak_date', $start_date);
                }
            }

            if (!empty($end_date)) {
                if (empty($start_date)) {
                    $query->whereDate('overbreak_date', '<=', $end_date);
                }
            }

            if (!empty($end_date) && !empty($start_date)) {
                $query->whereBetween('overbreak_date', [$start_date, $end_date]);
            }
        } catch (\Exception $e) {
            \Log::error(get_class().':searchOverbreak(): '.$e->getMessage());

            return false;
        }

        return  $query->get()->toArray();
    }
}
