<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\Member;
use App\Models\Cdkey;

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
        $member       = Member::find($id);
        $machine_data = [];

        if (! empty($member->machine_data))
        {
            $machineData  = json_decode($member->machine_data, true);

            $cdkeys   = Cdkey::orderBy('created_at', 'desc')->get();
            $cdkeyIdx = $cdkeys->keyBy('title')->toArray();

            $hcdkey = $machineData['H']['M'];
            $ecdkey = $machineData['E']['M'];
            $lcdkey = $machineData['L']['M'];

            $machine_data = [
                'hsn'      => $machineData['H']['S'],
                'hcdkey'   => $hcdkey,
                'hmodel'   => empty($cdkeyIdx[$hcdkey]['model']) ? '-' : $cdkeyIdx[$hcdkey]['model'],
                'hversion' => $machineData['H']['V'],
                'esn'      => $machineData['E']['S'],
                'ecdkey'   => $ecdkey,
                'emodel'   => empty($cdkeyIdx[$ecdkey]['model']) ? '-' : $cdkeyIdx[$ecdkey]['model'],
                'eversion' => $machineData['E']['V'],
                'lsn'      => $machineData['L']['S'],
                'lcdkey'   => $lcdkey,
                'lmodel'   => empty($cdkeyIdx[$lcdkey]['model']) ? '-' : $cdkeyIdx[$lcdkey]['model'],
                'lversion' => $machineData['L']['V'],
            ];
        }

        return view('admin.member.view', compact('member', 'machine_data'));
    }
}
