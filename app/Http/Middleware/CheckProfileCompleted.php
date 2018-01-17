<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Auth;

class CheckProfileCompleted
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
        if (env('ENABLE_PROFILE_CHECK', true) && ! Auth::user()->is_completed) {
            return response()->view('home.common.message', [
                'msg_type'         => 'info',
                'title'            => 'Forbidden',
                'detail'           => 'Please complete your profile',
                'primary_btn_desc' => 'Home',
                'primary_btn_url'  => route('home.index'),
            ]);
        }

        return $next($request);
    }
}
