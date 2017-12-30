<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function profile()
    {
        return view('home.member.profile');
    }

    public function updateProfile()
    {

    }
}
