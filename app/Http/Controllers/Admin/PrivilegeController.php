<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Models\Privilege;
use App\Models\PrivilegeGroup;
use App\Models\UserPrivilege;
use App\Services\Acl;

class PrivilegeController extends AdminController
{
    public function list()
    {
        $pagesize = 20;

        $list = Privilege::with('privilegeGroup')->orderBy('created_at', 'desc')->paginate($pagesize);

        return view('admin.privilege.list', compact('list'));
    }

    public function add()
    {
        $privilegeGroups = PrivilegeGroup::orderBy('created_at', 'desc')->get();

        return view('admin.privilege.add', compact('privilegeGroups'));
    }

    public function handleAdd(Request $request)
    {
        $title = $request->title;

        if (Privilege::where('title', '=', $title)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '名称已经被使用！']
            ]);
        }

        $privilege = new Privilege;

        $privilege->title              = $title;
        $privilege->path               = $request->path;
        $privilege->privilege_group_id = $request->privilege_group_id;
        $privilege->created_at         = time();

        $res = $privilege->save();

        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '添加权限失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '添加权限成功！']
        ]);
    }

    public function edit($id)
    {
        $privilege       = Privilege::find($id);
        $privilegeGroups = PrivilegeGroup::orderBy('created_at', 'desc')->get();

        return view('admin.privilege.edit', compact('privilege', 'privilegeGroups'));
    }

    public function handleEdit(Request $request, $id)
    {
        $title = $request->title;

        if (Privilege::where('title', '=', $title)->where('id', '!=', $id)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '名称已经被使用！']
            ]);
        }

        $privilege = Privilege::find($id);

        $privilege->title              = $title;
        $privilege->path               = $request->path;
        $privilege->privilege_group_id = $request->privilege_group_id;

        $res = $privilege->save();

        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '添加权限失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '添加权限成功！']
        ]);
    }

    public function manage(Request $request)
    {
        $uid = $request->input('uid', 0);

        $users            = User::where('is_admin', '=', config('admin.user.is_admin.false.value'))->orderBy('created_at', 'desc')->get();
        $privilegeGroups  = PrivilegeGroup::with('privileges')->orderBy('created_at', 'desc')->get();
        $userPrivilegeIds = UserPrivilege::where('user_id', '=', $uid)->get()->pluck('privilege_id')->unique()->toArray();

        return view('admin.privilege.manage', compact('uid', 'users', 'privilegeGroups', 'userPrivilegeIds'));
    }

    public function handleManage(Request $request)
    {
        $uid = $request->input('uid', 0);

        $init    = json_decode($request->userPrivilegeIds, true);
        $changed = json_decode($request->changedUserPrivilegeIds, true);

        $toDelIds = collect($init)->diff($changed)->values()->unique()->toArray();
        $toAddIds = collect($changed)->diff($init)->values()->unique()->toArray();

        if (! empty($toDelIds)) {
            UserPrivilege::where('user_id', '=', $uid)->whereIn('privilege_id', $toDelIds)->delete();
        }

        if (! empty($toAddIds)) {
            $inserts = [];
            foreach ($toAddIds as $add_id)
            {
                $inserts[] = [
                    'user_id'      => $uid,
                    'privilege_id' => $add_id,
                    'created_at'   => time()
                ];
                UserPrivilege::insert($inserts);
            }
        }

        $user = User::find($uid);

        Acl::refresh($uid);

        return view('layouts.modal', ['modal' => [
            'type'    => 'success',
            'title'   => '成功',
            'content' => ('账户：'. $user->username .' 权限已更新！'),
            'url'     => route('admin.privilege.manage', ['uid' => $uid])
        ]]);
    }
}
