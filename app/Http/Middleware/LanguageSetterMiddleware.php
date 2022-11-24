<?php
namespace App\Http\Middleware;

use Closure;

class LanguageSetterMiddleware
{
    public function handle($request, Closure $next)
    {
        
        if ( app()->getLocale() ) 
        {
            session([app()->getLocale()]);
        }
        else
        {
            session(['lang' => 'en']);
        }

        return $next($request);
    }
}
