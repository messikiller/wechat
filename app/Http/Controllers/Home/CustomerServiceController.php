<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Services\Auth;
use EasyWeChat;

class CustomerServiceController extends HomeController
{
    public function list()
    {
        $app = EasyWeChat::officialAccount();
        $serviceList = $app->customer_service->list();
        return view('home.customer_service.list', compact('serviceList'));
    }

    public function open(Request $request)
    {
        $kf_wechat_id = $request->input('kf_wechat_id', false);
        $wechat_id    = Auth::user()->wechat_id;

        if (! $kf_wechat_id) {
            return back();
        }

        $app = EasyWeChat::officialAccount();
        return $app->customer_service_session->create($kf_wechat_id, $wechat_id);

        // return $app->server->serve();
    }

    public function close(Request $request)
    {

    }
}
