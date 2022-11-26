<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionAswerServiceController extends Controller
{
    public function list(Request $request)
    {
        dd(1);
        // $status = config('global.default.status.type_of_services');
        // $fromTo = $request->get('fromTo');
        // $fromDate = NULL;
        // $toDate = NULL;
        // $res = explode(' - ', $fromTo);
        // if (count($res) == 2) {
        //     $fromDate = $res[0];
        //     $toDate = $res[1] . ' 23:59:59';
        // }
        // $info = [
        //     'serviceName' => $request->get('serviceName', ''),
        //     'serviceStatus' => $request->get('serviceStatus', ''),
        //     'fromTo' => $request->get('fromTo', ''),
        //     'fromDate' => $fromDate,
        //     'toDate' => $toDate,
        //     'type' => 'SEARCH'
        // ];
        // $services = $this->_typeOfServiceInterFace->searchWithInfo($info);
        // return view($this->_prefix . 'list', compact('services', 'info', 'status'));
    }
}
