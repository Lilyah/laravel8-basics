<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| New Middlewares
|--------------------------------------------------------------------------
|
| New Middlewares MUST be uncluded manualy in Http/Kernel.php!
|
*/

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->age <= 20){
            return redirect('home');
        }
        return $next($request);
    }
}
