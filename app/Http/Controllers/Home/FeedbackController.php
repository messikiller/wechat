<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Validator;
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
        $wx_config = EasyWeChat::officialAccount()->jssdk->buildConfig(['scanQRCode'], false);
        return view('home.feedback.add', compact('wx_config'));
    }

    public function handleAdd(Request $request)
    {
        $rules = [
            'sn' => 'required',
        ];

        $messages = [
            'sn.required' => 'SN number is required'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return view('home.common.message', [
                'msg_type'         => 'info',
                'title'            => 'Invalid input options',
                'detail'           => $validator->errors()->first(),
                'primary_btn_desc' => 'Back',
                'primary_btn_url'  => route('feedback.add'),
            ]);
        }

        $feedback = new Feedback;

        $feedback->member_id   = Auth::user()->id;
        $feedback->sn          = $request->sn;
        $feedback->type        = $request->type;
        $feedback->description = strval($request->description);
        $feedback->status      = config('define.feedback.status.processing.value');
        $feedback->created_at  = time();

        $res = $feedback->save();

        if ($res === false) {
            return view('home.common.message', [
                'msg_type'         => 'warn',
                'title'            => 'Error',
                'detail'           => 'Save data failed',
                'primary_btn_desc' => 'Home',
                'primary_btn_url'  => route('home.index'),
            ]);
        }

        return view('home.common.message', [
            'msg_type'         => 'success',
            'title'            => 'success',
            'detail'           => 'Feedback submitted',
            'primary_btn_desc' => 'Home',
            'primary_btn_url'  => route('home.index'),
        ]);
    }

    public function ofMe()
    {
        $user = Auth::user();

        $member_id = $user->id;
        $feedbacks = Feedback::where('member_id', '=', $member_id)->orderBy('created_at', 'desc')->get();

        return view('home.feedback.ofMe', compact('feedbacks'));
    }
}
