<?php

namespace App\Http\Middleware;

use Closure;
use EasyWeChat;

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
        if (! empty(session(config('define.wechat_session_key')))) {
            $app = EasyWeChat::officialAccount();

            session()->put('redirect_url', $request->url());

            return $app->oauth->redirect();
        }

        return $next($request);
    }
}
