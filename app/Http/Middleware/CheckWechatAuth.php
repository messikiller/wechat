<?php

namespace App\Http\Middleware;

use Closure;
use EasyWeChat;
use App\Services\Auth;

class CheckWechatAuth
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
        if (! App()->isLocal() && ! Auth::has())
        {
            session()->put('redirect_url', $request->url());
            $app = EasyWeChat::officialAccount();

            return $app->oauth->redirect();
        }

        return $next($request);
    }
}
