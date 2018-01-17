<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use EasyWeChat;
use App\Services\Auth;
use App\Models\Feedback;

class FeedbackController extends HomeController
{
    public function __construct()
    {
        $this->middleware('checkProfileCompleted');
    }

    public function add()
    {
        $js_config = EasyWeChat::officialAccount()->jssdk->buildConfig(['scanQRCode'], true);
        return view('home.feedback.add');
    }

    public function handleAdd(Request $request)
    {

    }

    public function ofMe()
    {
        $user = Auth::user();

        $member_id = $user->id;
        $feedbacks = Feedback::where('member_id', '=', $member_id)->orderBy('created_at', 'desc')->get();

        return view('home.feedback.ofMe', compact('feedbacks'));
    }
}