<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\Feedback;
use App\Models\Cdkey;

class FeedbackController extends AdminController
{
    public function list(Request $request)
    {
        $pagesize = 20;

        $where = $filter = [];

        if (($filter_status = $request->input('filter_status', false)) !== false) {
            $where['status']         = $filter_status;
            $filter['filter_status'] = $filter_status;
        }

        if (($filter_type = $request->input('filter_type', false)) !== false) {
            $where['type']         = $filter_type;
            $filter['filter_type'] = $filter_type;
        }

        if (($filter_hsn = $request->input('filter_hsn', false)) !== false) {
            $where['hsn']         = $filter_hsn;
            $filter['filter_hsn'] = $filter_hsn;
        }

        $list = Feedback::with('member')
            ->where($where)
            ->orderBy('created_at', 'desc')
            ->paginate($pagesize)
            ->appends($filter);

        return view('admin.feedback.list', compact('list', 'filter'));
    }

    public function view($id)
    {
        $feedback = Feedback::find($id);

        $cdkeys = Cdkey::orderBy('created_at', 'desc')->get();
        $cdkeyIdx = $cdkeys->keyBy('title')->toArray();

        $machineData = json_decode($feedback->machine_data, true);

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

        return view('admin.feedback.view', compact('feedback', 'machine_data'));
    }

    public function edit($id)
    {
        $feedback = Feedback::find($id);

        return view('admin.feedback.edit', compact('feedback'));
    }

    public function handleEdit(Request $request, $id)
    {
        $feedback = Feedback::find($id);

        $feedback->status = $request->status;

        $res = $feedback->save();
        if ($res === false) {
            return back()->with('errors', [
                ['type' => 'error', 'desc' => '更新反馈信息失败！']
            ]);
        }

        return back()->with('errors', [
            ['type' => 'success', 'desc' => '更新反馈信息成功！']
        ]);
    }
}
