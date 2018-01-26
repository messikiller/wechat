<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\Region;

class RegionController extends AdminController
{
    public function list(Request $request)
    {
        $pagesize = 20;
        $where = $filter = [];

        if (($filter_title = $request->input('filter_title', false)) !== false) {
            $where['title']         = $filter_title;
            $filter['filter_title'] = $filter_title;
        }

        $list = Region::orderBy('created_at', 'desc')
            ->where($where)
            ->paginate($pagesize)
            ->appends($filter);

        return view('admin.region.list', compact('list', 'filter'));
    }

    public function add()
    {
        return view('admin.region.add');
    }

    public function handleAdd(Request $request)
    {
        $title = $request->title;
        if (Region::where('title', '=', $title)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '地区已存在！']
            ]);
        }

        $region = new Region;

        $region->title      = $title;
        $region->created_at = time();

        $res = $region->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '添加地区失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '添加地区成功！']
        ]);
    }

    public function edit($id)
    {
        $region = Region::find($id);

        return view('admin.region.edit', compact('region'));
    }

    public function handleEdit(Request $request, $id)
    {
        $title = $request->title;
        if (Region::where('title', '=', $title)->where('id', '!=', $id)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '地区已存在！']
            ]);
        }

        $region = Region::find($id);

        $region->title = $title;

        $res = $region->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '更新地区失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '更新地区成功！']
        ]);
    }
}
