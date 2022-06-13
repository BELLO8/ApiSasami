<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsServiceHospitalier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tokenCan('role:service_hopital')) {
            return $next($request);
        }else{
            abort(response()->json(['message' => 'pas autorisé car vous n\'êtes pas un service hospitalier  !!']));
        }
    }
}
