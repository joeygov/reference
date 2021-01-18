<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Managers\OverBreakManager;
use App\Http\Requests\OverBreakRequest;
use Illuminate\Http\Request;
use App\Models\Overbreak;
use App\Models\Employee;
use App\Models\Account;
use DB;

class OverBreakController extends Controller
{
    public function index()
    {
        $overbreaks = Overbreak::all();

        $accounts = Account::all();

        return view('wfm.overbreak.list', compact('overbreaks', 'accounts'));
    }

    public function create()
    {
        $employees = Employee::select(
            DB::raw("CONCAT(emp_id,' / ',first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');

        return view('wfm.overbreak.create', compact('employees'));
    }

    public function store(OverBreakRequest $request, OverBreakManager $overBreakManager)
    {
        $overbreak = $overBreakManager->insertOverBreak($request);

        if ($overbreak) {
            return redirect()->route('overbreak.list')->with('success', 'Created OverBreak Successfully');
        }

        return redirect()->route('overbreak.list')->with('error', 'Transaction Error!');
    }

    public function edit(Overbreak $overbreak)
    {
        $employees = Employee::select(
            DB::raw("CONCAT(emp_id,' / ',first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');

        return view('wfm.overbreak.edit', compact('overbreak', 'employees'));
    }

    public function update(OverBreakRequest $request, Overbreak $overbreak, OverBreakManager $overBreakManager)
    {
        $overbreak = $overBreakManager->updateOverBreak($request, $overbreak);

        if ($overbreak) {
            return redirect()->route('overbreak.list')->with('success', 'Updated OverBreak Successfully');
        }

        return redirect()->route('overbreak.list')->with('error', 'Transaction Error!');
    }

    public function destroy(OverBreak $overbreak)
    {
        $overbreak->delete();

        if ($overbreak) {
            return redirect()->back()->with('success', 'Deleted Successfully');
        }
        return redirect()->back()->with('error', 'Transaction Error!');
    }

    public function search(Request $request, OverBreakManager $overBreakManager)
    {
        return $overBreakManager->searchOverbreak($request);
    }

}
