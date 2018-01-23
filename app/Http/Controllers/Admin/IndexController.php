<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Services\Admin;
use App\Models\User;
use App\Models\PrivilegeGroup;
use App\Models\UserPrivilege;

class IndexController extends AdminController
{
    public function index()
    {
        return view('admin.index.index');
    }

    public function welcome()
    {
        $user = Admin::user();
        $uid  = $user->id;

        $privilegGroups = PrivilegeGroup::orderBy('created_at', 'desc')->get();
        $userPrivileges = UserPrivilege::with('privilege.privilegeGroup')
            ->where('user_id', '=', $uid)
            ->orderBy('created_at', 'desc')
            ->get();

        $privData = [];
        foreach ($userPrivileges as $userPrivilege)
        {
            $group_title = $userPrivilege->privilege->privilegeGroup->title;
            $privData[$group_title][] = $userPrivilege->privilege->title;
        }

        return view('admin.index.welcome', compact('user', 'privData'));
    }
}
