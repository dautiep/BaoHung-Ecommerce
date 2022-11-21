<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\TypeOfServiceRepositoryInterface;

class TypeOfServiceController extends Controller
{
    private $typeOfServiceInterFace;
    public function __construct(TypeOfServiceRepositoryInterface $typeOfServiceInterFace)
    {
        $this->typeOfServiceInterFace = $typeOfServiceInterFace;
    }

    public function index() {
        $services = $this->typeOfServiceInterFace->all();
        dd($services);
    }
}
