<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user()->hasVerifiedEmail()){
            return redirect()->route('verify.email');
        }

        // if (auth()->user()->is_admin !== 0) {
        //     abort(403, 'Unauthorized');
        // }

        return $next($request);
    }
}
