<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $remember = $request->get('remember') == 1 ? true : false;
        if (Auth::guard('user')->attempt(['emp_id' => $request->emp_id, 'password' => $request->password], $remember)) {
            return redirect()->route('home');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', config('messages.login_failed'));
    }

    public function logOut()
    {
        dd('heello');
        Auth::guard('user')->logout();

        return redirect()->route('login');
    }
}
