<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TypeOfServiceRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\TypeOfServiceRepositoryInterface;
use Exception;

class TypeOfServiceController extends Controller
{
    private $_prefix = 'admin.pages.type-of-services.';
    private $_typeOfServiceInterFace;
    public function __construct(TypeOfServiceRepositoryInterface $typeOfServiceInterFace)
    {
        $this->_typeOfServiceInterFace = $typeOfServiceInterFace;
    }

    public function list(Request $request)
    {
        $status = config('global.default.status.type_of_services');
        $fromTo = $request->get('fromTo');
        $fromDate = NULL;
        $toDate = NULL;
        $res = explode(' - ', $fromTo);
        if (count($res) == 2) {
            $fromDate = $res[0];
            $toDate = $res[1] . ' 23:59:59';
        }
        $info = [
            'serviceName' => $request->get('serviceName', ''),
            'serviceStatus' => $request->get('serviceStatus', ''),
            'fromTo' => $request->get('fromTo', ''),
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'type' => 'SEARCH'
        ];
        $services = $this->_typeOfServiceInterFace->searchWithInfo($info);
        return view($this->_prefix . 'list', compact('services', 'info', 'status'));
    }

    public function create()
    {
        return view($this->_prefix . 'create');
    }

    public function store(TypeOfServiceRequest $request, $id = null)
    {
        try {
            $input = $request->all();
            $data = $this->_typeOfServiceInterFace->handleCreateOrUpdate($id, $input);
            if (!$data) {
                $message = config('global.default.messages.type_of_services.error');
                return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_ERROR));
            } else {
                $message = config('global.default.messages.type_of_services.store');
                return redirect()->route('services.list')->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
            }
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            $message = config('global.default.messages.type_of_services.error');
            return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_ERROR));
        }
    }

    public function edit($id)
    {
        $service = $this->_typeOfServiceInterFace->find($id);
        return view($this->_prefix . 'create', compact('service'));
    }

    public function lock(Request $request)
    {
        try {
            $input = $request->all();
            $this->_typeOfServiceInterFace->lockOrUnlockByID($input);
            return \Response::json(['success' => $this::$TYPE_MESSAGES_SUCCESS, 'message' => config('global.default.messages.type_of_services.lock')]);
        } catch (Exception $e) {
            dd($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return \Response::json(['success' => $this::$TYPE_MESSAGES_ERROR, 'message' => config('global.default.messages.type_of_services.error')]);
        }
    }

    public function unlock(Request $request)
    {
        try {
            $input = $request->all();
            $this->_typeOfServiceInterFace->lockOrUnlockByID($input);
            return \Response::json(['success' => $this::$TYPE_MESSAGES_SUCCESS, 'message' => config('global.default.messages.type_of_services.unlock')]);
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return \Response::json(['success' => $this::$TYPE_MESSAGES_ERROR, 'message' => config('global.default.messages.type_of_services.error')]);
        }
    }
}
