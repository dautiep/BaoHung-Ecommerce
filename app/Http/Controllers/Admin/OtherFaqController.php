<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OtherFaqRequest;
use App\Repositories\Interfaces\OtherFagRepositoryInterface;

class OtherFaqController extends Controller
{
    private $_otherFaqRespositoryInterface;
    private $_prefix = 'admin.pages.other-faqs.';
    public function __construct(OtherFagRepositoryInterface $otherFagRepositoryInterface)
    {
        $this->_otherFaqRespositoryInterface = $otherFagRepositoryInterface;
    }

    public function index(Request $request)
    {
        $info = $this->getBuilderSearch($request);
        $data = $this->_otherFaqRespositoryInterface->getList($request);
        return view($this->_prefix . 'list', compact('info', 'data'));
    }

    public function delete(Request $request)
    {
        $data = $this->_otherFaqRespositoryInterface->handleDelete($request);
        return response()->json($this->responseAjax(config('global.default.messages.orther_faqs.delete'), $this::$TYPE_MESSAGES_SUCCESS));
    }

    public function edit($id)
    {
        $data = $this->_otherFaqRespositoryInterface->find($id);
        if (!$data) {
            return redirect()->route('other_faqs.list')->with($this->getMessages(config('global.default.messages.orther_faqs.not_found'), $this::$TYPE_MESSAGES_ERROR));
        }
        return view($this->_prefix . 'edit', compact('data'));
    }

    public function postContentToConsult(OtherFaqRequest $request, $id)
    {
        $data = $this->_otherFaqRespositoryInterface->updateContentToConsult($request, $id);
        if (!$data) {
            return redirect()->route('other_faqs.list')->with($this->getMessages(config('global.default.messages.orther_faqs.not_found'), $this::$TYPE_MESSAGES_ERROR));
        }
        return redirect()->route('other_faqs.list')->with($this->getMessages(config('global.default.messages.orther_faqs.content_to_consult'), $this::$TYPE_MESSAGES_SUCCESS));
    }
}