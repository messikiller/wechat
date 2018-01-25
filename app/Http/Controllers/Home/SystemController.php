<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;

class SystemController extends HomeController
{
    public function language()
    {
        return view('home.system.language');
    }

    public function updateLanguage()
    {

    }
}
