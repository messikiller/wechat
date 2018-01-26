<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\Member;

class MemberController extends AdminController
{
    public function list(Request $request)
    {
        $pagesize = 20;

        $where = $filter = [];

        if (($filter_type = $request->input('filter_type', false)) !== false) {
            $where['type']         = $filter_type;
            $filter['filter_type'] = $filter_type;
        }

        $list = Member::with('region', 'hospital', 'company')
            ->where($where)
            ->orderBy('created_at', 'desc')
            ->paginate($pagesize)
            ->appends($filter);

        return view('admin.member.list', compact('list', 'filter'));
    }

    public function view($id)
    {

    }

    public function edit(Request $request, $id)
    {

    }
}
