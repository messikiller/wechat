<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\User;

class UserController extends AdminController
{
    public function list(Request $request)
    {
        $pagesize = 20;

        $list = User::where('is_admin', '=', config('admin.user.is_admin.false.value'))
            ->orderBy('created_at', 'desc')
            ->paginate($pagesize);

        return view('admin.user.list', compact('list'));
    }

    public function view($id)
    {

    }

    public function add()
    {
        return view('admin.user.add');
    }

    public function handleAdd(Request $request)
    {
        $user = new User;

        $username = $request->username;
        $salt     = str_random(8);

        if (User::where('username', '=', $username)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '账户名称已经被使用！']
            ]);
        }

        $user->username   = $request->username;
        $user->password   = md5($request->password . $salt);
        $user->salt       = $salt;
        $user->nickname   = $request->nickname;
        $user->is_admin   = config('admin.user.is_admin.false.value');
        $user->created_at = time();

        $res = $user->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '添加账户失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '添加账户成功！']
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.edit', compact('user'));
    }

    public function handleEdit(Request $request, $id)
    {
        $user     = User::find($id);
        $username = $request->username;

        if (User::where('username', '=', $username)->where('id', '!=', $id)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '账户名称已经被使用！']
            ]);
        }

        $user->username = $username;
        $user->nickname = $request->nickname;

        $res = $user->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '更新账号信息失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '更新账号信息成功！']
        ]);
    }

    public function resetPassword($id)
    {
        $user = User::find($id);

        return view('admin.user.reset_password', compact('user'));
    }

    public function handleResetPassword(Request $request, $id)
    {
        $user = User::find($id);

        $salt     = str_random(8);
        $password = md5($request->password . $salt);

        $user->salt     = $salt;
        $user->password = $password;

        $res = $user->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '修改密码失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '修改密码成功！']
        ]);
    }
}
