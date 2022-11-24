<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Customer_F_Middleware
{
    public function handle($request, Closure $next)
    {
        
        if (Auth::check()) 
        {
            return $next($request);
        }
        else 
        {
            return redirect()->Route('customerLogin', app()->getLocale());
        }
    }
}
