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

        $list = User::where('is_admin', '=', config('admin.user.is_admin.true.value'))
            ->orderBy('created_at', 'desc')
            ->paginate($pagesize);

        return view('admin.user.list', compact('list'));
    }

    public function view($id)
    {

    }

    public function add()
    {

    }

    public function handleAdd(Request $request)
    {

    }

    public function edit($id)
    {

    }

    public function handleEdit(Request $request, $id)
    {

    }

    public function resetpassword()
    {

    }

    public function handleResetpassword(Request $request)
    {

    }
}
