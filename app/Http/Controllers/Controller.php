<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public static $TYPE_MESSAGES_SUCCESS = 'success';
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
}
