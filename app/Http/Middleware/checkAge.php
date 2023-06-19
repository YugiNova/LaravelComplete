<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $dateOfBirth = Carbon::createFromFormat('Y-m-d H:i:s',Auth::user()->dob);
            $today = Carbon::now();
            $age = $today->diffInYears($dateOfBirth);
            
            if($age>18){
                return $next($request);
            }
        }
        toastr()->warning('Oops! You are under 18!');
        return redirect()->route('client.home');
    }
}
