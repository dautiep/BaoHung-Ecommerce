<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Exception;

class ServiceController extends Controller
{
    private $_prefix = 'admin.pages.services.';
    private $_serviceInterFace;
    public function __construct(ServiceRepositoryInterface $serviceRepositoryInterface)
    {
        $this->_serviceInterFace = $serviceRepositoryInterface;
    }

    //get list services
    public function list(Request $request) {
        $status = config('global.default.status.services');
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
        $services = $this->_serviceInterFace->searchWithInfo($info);
        return view($this->_prefix . 'list', compact('services', 'info', 'status'));
    }

    //create service
    public function create() {
        return view($this->_prefix . 'create');
    }

    //store or update service. If id = null. That stores data. if id != null. That updates data
    public function save(ServiceRequest $request, $id = null) {
        try {
            $input = $request->all();
            $data = $this->_serviceInterFace->handleCreateOrUpdate($id, $input);
            if (!$data) {
                $message = config('global.default.messages.services.error');
                return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_ERROR));
            } else {
                $message = config('global.default.messages.services.store');
                return redirect()->route('services.list')->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
            }
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            $message = config('global.default.messages.services.error');
            return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_ERROR));
        }
    }

    //get data edit
    public function edit($id)
    {
        $service = $this->_serviceInterFace->find($id);
        return view($this->_prefix . 'create', compact('service'));
    }

    //lock data
    public function lock(Request $request)
    {
        try {
            $input = $request->all();
            $this->_serviceInterFace->lockOrUnlockByID($input);
            return Response::json(['success' => $this::$TYPE_MESSAGES_SUCCESS, 'message' => config('global.default.messages.services.lock')]);
        } catch (Exception $e) {
            dd($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return Response::json(['success' => $this::$TYPE_MESSAGES_ERROR, 'message' => config('global.default.messages.services.error')]);
        }
    }

    //unlock data
    public function unlock(Request $request)
    {
        try {
            $input = $request->all();
            $this->_serviceInterFace->lockOrUnlockByID($input);
            return Response::json(['success' => $this::$TYPE_MESSAGES_SUCCESS, 'message' => config('global.default.messages.services.unlock')]);
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return Response::json(['success' => $this::$TYPE_MESSAGES_ERROR, 'message' => config('global.default.messages.services.error')]);
        }
    }

}
