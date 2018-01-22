<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\PrivilegeGroup;

class PrivilegeGroupController extends AdminController
{
    public function list()
    {
        $pagesize = 20;

        $list = PrivilegeGroup::orderBy('created_at', 'desc')->paginate($pagesize);

        return view('admin.privilege_group.list', compact('list'));
    }

    public function add()
    {
        return view('admin.privilege_group.add');
    }

    public function handleAdd(Request $request)
    {
        $title = $request->title;

        if (PrivilegeGroup::where('title', '=', $title)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '名称已经被使用！']
            ]);
        }

        $privilegeGroup = new PrivilegeGroup;

        $privilegeGroup->title      = $title;
        $privilegeGroup->created_at = time();

        $res = $privilegeGroup->save();

        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '添加权限组失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '添加权限组成功！']
        ]);
    }

    public function edit($id)
    {
        $privilegeGroup = PrivilegeGroup::find($id);

        return view('admin.privilege_group.edit', compact('privilegeGroup'));
    }

    public function handleEdit(Request $request, $id)
    {
        $title = $request->title;

        if (PrivilegeGroup::where('title', '=', $title)->where('id', '!=', $id)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '名称已经被使用！']
            ]);
        }

        $privilegeGroup = PrivilegeGroup::find($id);

        $privilegeGroup->title = $title;

        $res = $privilegeGroup->save();

        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '更新权限组失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '更新权限组成功！']
        ]);
    }
}
