<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\TypeOfServiceRepositoryInterface;

class TypeOfServiceController extends Controller
{
    private $_typeOfServiceInterFace;
    public function __construct(TypeOfServiceRepositoryInterface $typeOfServiceInterFace)
    {
        $this->_typeOfServiceInterFace = $typeOfServiceInterFace;
    }

    public function list(Request $request)
    {
        $fromTo = $request->get('fromTo');
        $fromDate = NULL;
        $toDate = NULL;
        $res = explode(' - ', $fromTo);
        if (count($res) == 2) {
            $fromDate = $res[0];
            $toDate = $res[1]. ' 23:59:59';
        }
        $info = [
            'serviceName' => $request->get('serviceName', ''),
            'fromTo' => $request->get('fromTo', ''),
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'type' => 'SEARCH'
        ];
        $services = $this->_typeOfServiceInterFace->searchWithInfo($info);
        return view('admin.pages.type-of-services.list', compact('services', 'info'));
    }

    public function create() {
        return view('admin.pages.type-of-services.create');
    }

    public function store() {
        dd(1);
    }

    public function delete(Request $request) {
        dd(1);
    }
}
