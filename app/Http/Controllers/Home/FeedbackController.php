<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Validator;
use EasyWeChat;
use App\Services\Auth;
use App\Models\Feedback;
use App\Models\Cdkey;

class FeedbackController extends HomeController
{
    public function add()
    {
        $wx_config = EasyWeChat::officialAccount()->jssdk->buildConfig(['scanQRCode'], false);
        return view('home.feedback.add', compact('wx_config'));
    }

    public function handleAdd(Request $request)
    {
        $rules = [
            'hsn' => 'required',
        ];

        $messages = [
            'hsn.required' => 'SN number is required'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return view('home.common.message', [
                'msg_type'         => 'info',
                'title'            => 'Invalid input options',
                'detail'           => $validator->errors()->first(),
                'primary_btn_desc' => 'Back',
                'primary_btn_url'  => route('home.feedback.add'),
            ]);
        }

        $feedback = new Feedback;

        $feedback->member_id    = Auth::user()->id;
        $feedback->hsn          = $request->hsn;
        $feedback->type         = $request->type;
        $feedback->description  = strval($request->description);
        $feedback->machine_data = json_encode(json_decode($request->machine_data, true));
        $feedback->status       = config('define.feedback.status.processing.value');
        $feedback->created_at   = time();

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

    public function manualAdd()
    {
        $cdkeys = Cdkey::orderBy('created_at', 'desc')->get()->unique('model');

        $ecdkeys = $cdkeys->where('type', '=', config('define.cdkey.type.lens.value'));
        $hcdkeys = $cdkeys->where('type', '=', config('define.cdkey.type.processor.value'));
        $lcdkeys = $cdkeys->where('type', '=', config('define.cdkey.type.light.value'));

        return view('home.feedback.manual_add', compact('ecdkeys', 'hcdkeys', 'lcdkeys'));
    }

    public function handleManualAdd(Request $request)
    {
        $hsn      = strval($request->hsn);
        $hmodel   = strval($request->hmodel);
        $hversion = strval($request->hversion);
        $emodel   = strval($request->emodel);
        $esn      = strval($request->esn);
        $eversion = strval($request->eversion);
        $lmodel   = strval($request->lmodel);
        $lsn      = strval($request->lsn);
        $lversion = strval($request->lversion);

        $machine_data = json_encode([
            'H' => [
                'M' => $hmodel,
                'S' => $hsn,
                'V' => $hversion
            ],
            'E' => [
                'M' => $emodel,
                'S' => $esn,
                'V' => $eversion
            ],
            'L' => [
                'M' => $lmodel,
                'S' => $lsn,
                'V' => $lversion
            ],
        ]);

        $feedback = new Feedback;

        $feedback->member_id    = Auth::user()->id;
        $feedback->hsn          = $hsn;
        $feedback->type         = $request->type;
        $feedback->description  = strval($request->description);
        $feedback->machine_data = $machine_data;
        $feedback->status       = config('define.feedback.status.processing.value');
        $feedback->created_at   = time();

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
