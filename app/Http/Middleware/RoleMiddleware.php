<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;



class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, $roles)) {
            return redirect()->back();
        }

        if ($user->status == 'inactive') {
            Auth::logout();
            toastr()->addError('Your account is inactive.');
            return redirect()->route('home');
        }

        return $next($request);
    }
}

// class RoleMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next, $role): Response
//     {
//         if($request->user()->role !== $role){
//             return redirect()->route('home');
//         }
//         return $next($request);
//     }
// }
