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

    public function index()
    {
        $services = $this->_typeOfServiceInterFace->all();
        dd($services);
    }
}
