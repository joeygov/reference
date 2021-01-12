<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user')->except('logOut');
    }

    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $remember = $request->get('remember') == 'on' ? true : false;
        if (Auth::guard('user')->attempt(['emp_id' => $request->emp_id, 'password' => $request->password], $remember)) {
            $user = Auth::user();
            session(['name' => $user->first_name.' '.$user->last_name]);
            session(['role' => Employee::ROLE[$user->user_role]]);
            session(['email' => $user->email]);

            return redirect()->route('home');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', config('messages.login_failed'));
    }

    public function logOut()
    {
        session()->flush();
        Auth::guard('user')->logout();

        return redirect()->route('login');
    }
}
