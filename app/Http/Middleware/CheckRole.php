<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        if (!in_array($userRole, $roles)) {
            // Redirect based on user's actual role
            switch ($userRole) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'kasir':
                    return redirect()->route('kasir.dashboard');
                case 'pengguna':
                    return redirect()->route('pengguna.dashboard');
                default:
                    abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
