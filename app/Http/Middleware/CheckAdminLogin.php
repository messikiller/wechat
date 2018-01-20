<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Admin;

class CheckAdminLogin
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
        if (! Admin::has()) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
