<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cdkey;

class CdkeyController extends Controller
{
    public function list(Request $request)
    {
        $pagesize = 20;

        $where = $filter = [];

        if (($filter_title = $request->input('filter_title', false)) !== false) {
            $where['title']         = $filter_title;
            $filter['filter_title'] = $filter_title;
        }

        if (($filter_model = $request->input('filter_model', false)) !== false) {
            $where['model']         = $filter_model;
            $filter['filter_model'] = $filter_model;
        }

        $list = Cdkey::orderBy('created_at', 'desc')
            ->where($where)
            ->paginate($pagesize)
            ->appends($filter);

        return view('admin.cdkey.list', compact('list', 'filter'));
    }

    public function add()
    {
        return view('admin.cdkey.add');
    }

    public function handleAdd(Request $request)
    {
        $title = $request->title;
        if (Cdkey::where('title', '=', $title)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '识别码名称已存在！']
            ]);
        }

        $cdkey = new Cdkey;

        $cdkey->title      = $title;
        $cdkey->model      = $request->model;
        $cdkey->created_at = time();

        $res = $cdkey->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '添加识别码失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '添加识别码成功！']
        ]);
    }

    public function edit($id)
    {
        $cdkey = Cdkey::find($id);

        return view('admin.cdkey.edit', compact('cdkey'));
    }

    public function handleEdit(Request $request, $id)
    {
        $title = $request->title;
        if (Cdkey::where('title', '=', $title)->where('id', '!=', $id)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '识别码名称已存在！']
            ]);
        }

        $cdkey = Cdkey::find($id);

        $cdkey->title = $title;
        $cdkey->model = $request->model;

        $res = $cdkey->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '更新识别码失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '更新识别码成功！']
        ]);
    }
}
