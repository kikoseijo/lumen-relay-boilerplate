<?php
namespace App\Http\Middleware;

use App\User;
use Closure;

class MockLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check() && env('APP_ENV') !== 'production') {
            auth()->setUser(User::first());
        }

        return $next($request);
    }
}
