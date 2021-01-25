<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsReportManager
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (array_search('REPORT_MANAGER', Employee::Role) == $user->user_role) {
            return $next($request);
        }

        return redirect('home');
    }
}
