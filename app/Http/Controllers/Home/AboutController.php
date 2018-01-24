<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;

class AboutController extends HomeController
{
    public function us()
    {
        return 'About Us';
    }

    public function globe()
    {
        return 'Global Branches';
    }

    public function contact()
    {
        return 'Contact Us';
    }
}
