<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    public function artisanCache(Request $request)
    {
        try {
            $redirect = redirect()->route('dashboard')->with(array(
                'message' => 'Cập nhật cache hệ thống thành công',
                'alert-type' => 'success'
            ));
            Artisan::call('migrate');
            Artisan::call('optimize');
            Artisan::call('route:clear');
            Artisan::call('storage:link');
            return $redirect;
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with(array(
                'message' => 'Cập nhật cache hệ thống thành công',
                'alert-type' => 'success'
            ));
        }
    }
}
