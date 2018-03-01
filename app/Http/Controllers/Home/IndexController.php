<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use EasyWeChat;
use App\Services\Auth;
use App\Models\Article;

class IndexController extends HomeController
{
    public function index()
    {
        $user   = Auth::user();
        $wechat = Auth::wechat();
        return view('home.index', compact('user', 'wechat'));
    }

    public function viewArticle($id)
    {
        $article   = Article::find($id);
        $wx_config = EasyWeChat::officialAccount()->jssdk->buildConfig([
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'onMenuShareQZone'
        ], false);

        return view('home.article.common_view', compact('article', 'wx_config'));
    }
}
