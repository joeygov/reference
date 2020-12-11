<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryPageController extends Controller
{
    public function entryPage()
    {
        return view('entrypage');
    }
    public function get_time(Request $request)
    {
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
        return view('entrypage', $current_date_time);
        dd($current_date_time);
    }
}
