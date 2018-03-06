<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;

class AboutController extends HomeController
{
    public function us()
    {
        return view('home.about.us');
    }

    public function globe()
    {
        return view('home.about.globe');
    }

    public function contact()
    {
        return 'Contact Us (Maintaining...)';
    }
}
