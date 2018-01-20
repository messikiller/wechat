<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function check(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', '=', $username)->first();
        if (empty($user)) {
            return view('layouts.modal', ['modal' => [
                'type'    => 'info',
                'title'   => '登录失败',
                'content' => '用户名不存在！',
                'url'     => route('admin.login')
            ]]);
        }

        $check = md5($password. $user->salt);
        if ($user->password != $check) {
            return view('layouts.modal', ['modal' => [
                'type'    => 'info',
                'title'   => '登录失败',
                'content' => '用户名或密码错误！',
                'url'     => route('admin.login')
            ]]);
        }

        Admin::login($user);

        return redirect()->route('admin.index.index');
    }

    public function logout()
    {
        Admin::logout();

        return redirect()->route('admin.login');
    }
}
