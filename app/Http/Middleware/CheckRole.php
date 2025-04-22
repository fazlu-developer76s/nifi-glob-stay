<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        $get_user_id  = Auth::user()->id;
        $get_user = User::where('id', $get_user_id)->first();
        if ($get_user->status == 2) {

            Auth::logout(); // Log the user out
            return redirect('/'); // Redirect to login
        }

            return $next($request);


        // if($get_user_role == 5 && $route == 'lead' ){
        //     return $next($request);
        // }
        // if($get_user_role == 5 && $route == 'note' ){
        //     return $next($request);
        // }
        // if($get_user_role == 5 && $route == 'change-status' ){
        //     return $next($request);
        // }
        // if($get_user_role == 5 && $route == 'dashboard' ){
        //     return $next($request);
        // }

        // if($get_user_role == 2 && $route == 'dashboard' ){
        //     return $next($request);
        // }
        // if($get_user_role == 2 && $route == 'note' ){
        //     return $next($request);
        // }
        // return redirect(route('dashboard'));
    }
}
