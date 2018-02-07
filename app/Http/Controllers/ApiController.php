<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Debugbar;

class ApiController extends Controller
{
    use Helpers;

    public function __construct()
    {
        Debugbar::disable();
    }
}
