<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\Company;

class CompanyController extends AdminController
{
    public function list(Request $request)
    {
        $pagesize = 20;
        $where = $filter = [];

        if (($filter_title = $request->input('filter_title', false)) !== false) {
            $where['title']         = $filter_title;
            $filter['filter_title'] = $filter_title;
        }

        $list = Company::orderBy('created_at', 'desc')
            ->where($where)
            ->paginate($pagesize)
            ->appends($filter);

        return view('admin.company.list', compact('list', 'filter'));
    }

    public function add()
    {
        return view('admin.company.add');
    }

    public function handleAdd(Request $request)
    {
        $title = $request->title;
        if (Company::where('title', '=', $title)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '公司名称已存在！']
            ]);
        }

        $company = new Company;

        $company->title      = $title;
        $company->created_at = time();

        $res = $company->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '添加公司失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '添加公司成功！']
        ]);
    }

    public function edit($id)
    {
        $company = Company::find($id);

        return view('admin.company.edit', compact('company'));
    }

    public function handleEdit(Request $request, $id)
    {
        $title = $request->title;
        if (Company::where('title', '=', $title)->where('id', '!=', $id)->count() > 0) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '公司名称已存在！']
            ]);
        }

        $company = Company::find($id);

        $company->title = $title;

        $res = $company->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '更新公司失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '更新公司成功！']
        ]);
    }
}
