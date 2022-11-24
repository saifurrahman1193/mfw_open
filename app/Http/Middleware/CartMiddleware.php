<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartMiddleware
{
    public function handle($request, Closure $next)
    {
        $user_module_check = null;
        if (Auth::check()) 
        {
            $user_module_check = DB::table('user_roles_modules_view')
                                   ->where('userId', auth::user()->id )
                                   ->where('moduleId', 800)  
                                   ->pluck('moduleId')
                                   ->first();
        }
        
        if ($user_module_check===null) 
        {
            return redirect('/bismillah-mfwadmin');
        }
        else 
        {
            return $next($request);
        }
    }
}
