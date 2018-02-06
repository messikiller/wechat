<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class IndexController extends ApiController
{
    public function test()
    {
        return $this->response->array(['test_message' => 'store verification code']);
    }
}
