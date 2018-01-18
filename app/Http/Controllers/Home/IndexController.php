<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use EasyWeChat;
use App\Services\Auth;

class IndexController extends HomeController
{
    public function index()
    {
        $user   = Auth::user();
        $wechat = Auth::wechat();
        return view('home.index', compact('user', 'wechat'));
    }
}
