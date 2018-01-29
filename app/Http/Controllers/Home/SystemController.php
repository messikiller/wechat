<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Models\Member;
use App;
use Auth;

class SystemController extends HomeController
{
    public function language()
    {
        $uid    = Auth::user()->id;
        $member = Member::find($uid);

        $config = json_decode($member->config, true);
        $language = isset($config['language']) ? $config['language'] : '';

        return view('home.system.language', compact('language'));
    }

    public function updateLanguage(Request $request)
    {
        $lang = $request->language;

        $uid    = Auth::user()->id;
        $member = Member::find($uid);

        $config = $member->config;
        if (empty($config)) {
            $config = ['language' => $lang];
        } else {
            $config['language'] = $lang;
        }

        $member->config = $config;

        $member->save();

        Auh::reload();
        App::setLocale($lang);

        return redirect()->route('home.index');
    }
}
