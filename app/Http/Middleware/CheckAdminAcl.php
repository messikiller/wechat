<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use App\Services\Acl;
use App\Services\Admin;

class CheckAdminAcl
{
    private $user;
    private $acl;

    public function __construct(Acl $acl)
    {
        $this->acl  = $acl;
        $this->user = Admin::user();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = Route::currentRouteName();
        if (! $this->user->is_admin && ! $this->acl->canAccess($this->user->id, $route)) {
            return abort(403);
        }

        return $next($request);
    }
}
