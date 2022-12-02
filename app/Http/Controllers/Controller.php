<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public static $TYPE_MESSAGES_SUCCESS = 'success';
    public static $TYPE_MESSAGES_ERROR = 'error';
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getMessages($message = '', $type = 'success')
    {
        return [
            'message' => $message,
            'alert-type' => $type
        ];
    }

    public function responseAjax($message, $icon = 'success', $boolean = true)
    {
        return [
            'message' => $message,
            'icon' => $icon,
            'status' => $boolean
        ];
    }

    public function getBuilderSearch($request)
    {
        return  [
            'keySearch' => $request->get('keySearch', ''),
            'fromTo' => $request->get('fromTo', ''),
            'fromDate' => null,
            'toDate' => null,
            'is_active' => $request->is_active ?? 1,
            'status' => $request->get('status', ''),
            'groups' => $request->get('groups', ''),
            'department_id' => $request->get('department_id', ''),
            'type' => 'SEARCH'
        ];
    }
}
