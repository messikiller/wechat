<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Auth;

class IsMemberProvider
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
        if (! Auth::user()->isProvider()) {
            return response()->view('home.common.message', [
                'msg_type'         => 'info',
                'title'            => 'Forbidden',
                'detail'           => 'Access denied, only distributor is permitted',
                'primary_btn_desc' => 'Home',
                'primary_btn_url'  => route('home.index'),
            ]);
        }

        return $next($request);
    }
}
