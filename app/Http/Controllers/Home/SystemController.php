<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class SystemController extends AdminController
{
    public function language()
    {
        return view('home.system.language');
    }

    public function updateLanguage()
    {

    }
}
