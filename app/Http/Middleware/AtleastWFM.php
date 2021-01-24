<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtleastWFM
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (array_search('WFM', Employee::Role) == $user->user_role || array_search('ADMIN', Employee::Role)) {
            return $next($request);
        }

        return redirect('home');
    }
}
