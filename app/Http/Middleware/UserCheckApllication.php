<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Form;

class UserCheckApllication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $application_id = $request->route('application_id');

        $application = Form::findOrFail($application_id);
        
        if($application->user_id == auth()->user()->id){
             return $next($request);
        }else{
            return redirect()->route('dashboard');
        }

    }
}
