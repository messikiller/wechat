<?php

function response_json_view($status, $data, $meta = '')
{
    $data = is_array($data) ? $data : ['msg' => $data];
    $meta = is_array($meta) ? $meta : ['ext' => $meta];
    $meta = array_merge($meta, ['timestamp' => time()]);

    $ret = [
        'status' => $status,
        'data'   => $data,
        'meta'   => $meta
    ];

    return response()->json($ret);
}
