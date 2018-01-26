<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Validator;
use EasyWeChat;
use App\Services\Auth;
use App\Models\Member;
use App\Models\Region;
use App\Models\Company;
use App\Models\Hospital;

class MemberController extends HomeController
{
    public function profile()
    {
        $member_id = Auth::user()->id;
        $member    = Member::find($member_id);

        $hospitals = Hospital::orderBy('created_at', 'desc')->get();
        $companies = Company::orderBy('created_at', 'desc')->get();
        $regions   = Region::orderBy('created_at', 'desc')->get();

        return view('home.member.profile', compact('member', 'hospitals', 'companies', 'regions'));
    }

    public function updateProfile(Request $request)
    {
        $rules = [
            'type'        => 'required',
            'nickname'    => 'required',
            'sex'         => 'required',
            'mail'        => 'required|email',
            'mobile'      => 'required|integer',
            'region_id'   => 'required',
            'company_id'  => 'required_if:type,1',
            'hospital_id' => 'required_if:type,0',
        ];

        $messages = [
            'type.required'           => 'Role type is required',
            'nickname.required'       => 'Name is required',
            'sex.required'            => 'Sex is required',
            'mail.required'           => 'Mail is required',
            'mail.email'              => 'Invalid mail',
            'mobile.required'         => 'Mobile is required',
            'mobile.integer'          => 'Invalid mobile',
            'region_id.required'      => 'Region is required',
            'company_id.required_if'  => 'Company is required for provider',
            'hospital_id.required_if' => 'Hospital is required for doctor',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return view('home.common.message', [
                'msg_type'         => 'info',
                'title'            => 'Invalid input options',
                'detail'           => $validator->errors()->first(),
                'primary_btn_desc' => 'Profile',
                'primary_btn_url'  => route('home.member.profile'),
            ]);
        }

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
        $member->company_id   = $request->company_id;
        $member->hospital_id  = $request->hospital_id;
        $member->company_id   = $request->company_id;
        $member->is_completed = 1;

        $res = $member->save();
        if ($res === false) {
            return view('home.common.message', [
                'msg_type'         => 'warn',
                'title'            => 'Failed',
                'detail'           => 'Update user data failed',
                'primary_btn_desc' => 'Profile',
                'primary_btn_url'  => route('home.member.profile'),
                'extra_btn_desc'   => 'Home',
                'extra_btn_url'    => route('home.index'),
            ]);
        }

        Auth::reload();

        return view('home.common.message', [
            'msg_type'         => 'success',
            'title'            => 'Success',
            'primary_btn_desc' => 'Profile',
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

        if (empty($machine_type) || empty($machine_sn) || empty($machine_data)) {
            return view('home.common.message', [
                'msg_type'         => 'info',
                'title'            => 'Invalid',
                'detail'           => 'please fill form completely',
                'primary_btn_desc' => 'Back',
                'primary_btn_url'  => route('home.member.machine'),
            ]);
        }

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
