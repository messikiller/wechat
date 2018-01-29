<?php

namespace App\Http\Middleware;

use Closure;
use App;

class CheckLocale
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
        $key = config('define.user_locale_session');
        $lang = $request->session()->get($key);
        if (empty($lang)) {
            $lang = Auth::getConfig('language');
            if (empty($lang)) {
                $lang = App::getLocale();
            }

            $request->session()->put($key, $lang);
        }

        App::setLocale($lang);

        return $next($request);
    }
}
