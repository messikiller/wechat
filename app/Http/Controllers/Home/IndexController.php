<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $user = session(config('define.wechat_session_key'));
        return view('home.index', compact('user'));
    }
}
