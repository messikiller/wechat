<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat;
use App\Services\Auth;
use App\Models\Member;
use App;

class WechatController extends Controller
{
    public function serve()
    {
        $app = EasyWeChat::officialAccount();

        $response = $app->server->serve();

        return $response;
    }

    public function oauthCallback(Request $request)
    {
        $app   = EasyWeChat::officialAccount();
        $oauth = $app->oauth;
        $user  = $oauth->user();

        $wechat_id = $user->getId();

        $member = Member::where('wechat_id', '=', $wechat_id)->first();
        if (empty($member)) {
            $member = Member::create([
                'wechat_id'    => $wechat_id,
                'machine_data' => '',
                'config'       => '',
                'created_at'   => time()
            ]);
        }

        $config = json_decode($member->config, true);
        if (! empty($config['language'])) {
            App::setLocale($config['language']);
        }

        $member->setAttribute('wechat', $user);
        Auth::set($member);

        $target = session('redirect_url', route('home.index'));

        return redirect($target);
    }
}
