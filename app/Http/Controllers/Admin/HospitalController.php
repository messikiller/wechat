<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\Hospital;

class HospitalController extends AdminController
{
    public function list(Request $request)
    {
        $pagesize = 20;
        $where = $filter = [];

        if (($filter_title = $request->input('filter_title', false)) !== false) {
            $where['title']         = $filter_title;
            $filter['filter_title'] = $filter_title;
        }

        $list = Hospital::orderBy('created_at', 'desc')
            ->where($where)
            ->paginate($pagesize)
            ->appends($filter);

        return view('admin.hospital.list', compact('list', 'filter'));
    }

    public function add()
    {
        return view('admin.hospital.add');
    }

    public function handleAdd(Request $request)
    {
        $title = $request->title;
        if (Hospital::where('title', '=', $title)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '医院名称已存在！']
            ]);
        }

        $hospital = new Hospital;

        $hospital->title      = $title;
        $hospital->created_at = time();

        $res = $hospital->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '添加医院失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '添加医院成功！']
        ]);
    }

    public function edit($id)
    {
        $hospital = Hospital::find($id);

        return view('admin.hospital.edit', compact('hospital'));
    }

    public function handleEdit(Request $request, $id)
    {
        $title = $request->title;
        if (Hospital::where('title', '=', $title)->where('id', '!=', $id)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '医院名称已存在！']
            ]);
        }

        $hospital = Hospital::find($id);

        $hospital->title = $title;

        $res = $hospital->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '更新医院失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '更新医院成功！']
        ]);
    }
}
