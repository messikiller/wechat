<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Validator;
use EasyWeChat;
use App\Services\Auth;
use App\Models\Member;
use App\Models\Region;

class MemberController extends HomeController
{
    public function profile()
    {
        $member_id = Auth::user()->id;
        $member    = Member::find($member_id);
        $regions   = Region::orderBy('created_at', 'desc')->get();

        return view('home.member.profile', compact('member', 'regions'));
    }

    public function updateProfile(Request $request)
    {
        $wechat_id = Auth::wechat()->getId();

        $member = Member::where('wechat_id', '=', $wechat_id)->first();
        if (empty($member))
        {
            $member = new Member;
            $member->wechat_id  = $wechat_id;
            $member->created_at = time();
        }

        $member->type         = $request->type;
        $member->nickname     = $request->nickname;
        $member->sex          = $request->sex;
        $member->mail         = $request->mail;
        $member->mobile       = $request->mobile;
        $member->region_id    = $request->region_id;
        $member->company      = strval($request->company);
        $member->hospital     = strval($request->hospital);
        $member->address      = strval($request->address);
        $member->is_completed = config('define.member.is_completed.true.value');

        $res = $member->save();
        if ($res === false) {
            return view('home.common.message', [
                'msg_type'         => 'warn',
                'title'            => 'Failed',
                'detail'           => 'Update user data failed',
                'primary_btn_desc' => 'Back',
                'primary_btn_url'  => route('home.member.profile'),
                'extra_btn_desc'   => 'Home',
                'extra_btn_url'    => route('home.index'),
            ]);
        }

        Auth::reload();

        return view('home.common.message', [
            'msg_type'         => 'success',
            'title'            => 'Success',
            'primary_btn_desc' => 'Back',
            'primary_btn_url'  => route('home.member.profile'),
            'extra_btn_desc'   => 'Home',
            'extra_btn_url'    => route('home.index'),
        ]);
    }

    public function machine()
    {
        $member_id = Auth::user()->id;
        $member    = Member::find($member_id);
        $wx_config = EasyWeChat::officialAccount()->jssdk->buildConfig(['scanQRCode'], false);

        return view('home.member.machine', compact('member', 'wx_config'));
    }

    public function updateMachine(Request $request)
    {
        $machine_type = $request->machine_type;
        $machine_sn   = $request->machine_sn;
        $machine_data = $request->machine_data;

        $member_id = Auth::user()->id;
        $member    = Member::find($member_id);

        $member->machine_type = $machine_type;
        $member->machine_data = json_encode(json_decode($machine_data, true));

        $res = $member->save();
        if ($res === false) {
            return view('home.common.message', [
                'msg_type'         => 'warn',
                'title'            => 'Failed',
                'detail'           => 'Update machine data failed',
                'primary_btn_desc' => 'Home',
                'primary_btn_url'  => route('home.index')
            ]);
        }

        Auth::reload();

        return view('home.common.message', [
            'msg_type'         => 'success',
            'title'            => 'Success',
            'primary_btn_desc' => 'Home',
            'primary_btn_url'  => route('home.index')
        ]);
    }
}
