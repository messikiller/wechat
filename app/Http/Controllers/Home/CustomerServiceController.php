<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat;

class CustomerServiceController extends Controller
{
    public function list()
    {
        $app = EasyWeChat::officialAccount();
        $serviceList = $app->customer_service->list();
        return view('home.customer_service.list', compact('serviceList'));
    }

    public function open(Request $request)
    {
        $open_id = $request->input('open_id', false);

        if (! $open_id) {
            return back();
        }

        $app = EasyWeChat::officialAccount();
        $app->customer_service_session->create('test1@test', $open_id);

        return $app->server->serve();
    }

    public function close(Request $request)
    {

    }
}
