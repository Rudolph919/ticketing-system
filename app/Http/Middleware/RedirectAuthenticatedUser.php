<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectAuthenticatedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $authUser = Auth::user();

            $user = User::find($authUser->id);

            if ($user->hasRole('Customer')) {
                return redirect('/tickets/create');
            } else {
                return redirect('/tickets');
            }
        }

        return $next($request);
    }
}
