<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuestionAnswerServiceRequest;
use App\Repositories\Interfaces\QuestionAswerServiceInterface;
use Illuminate\Http\Request;

class QuestionAswerServiceController extends Controller
{
    private $_prefix = 'admin.pages.questions-answer-service.';
    private $_questionAnswerServiceInterface;

    public function __construct(QuestionAswerServiceInterface $questionAswerServiceInterface)
    {
        $this->_questionAnswerServiceInterface = $questionAswerServiceInterface;
    }
    public function list(Request $request)
    {

        $status = config('global.default.status.question');
        $fromTo = $request->get('fromTo');
        $fromDate = NULL;
        $toDate = NULL;
        $res = explode(' - ', $fromTo);
        if (count($res) == 2) {
            $fromDate = $res[0];
            $toDate = $res[1] . ' 23:59:59';
        }
        $info = [
            'questionName' => $request->get('questionName', ''),
            'questionStatus' => $request->get('questionStatus', ''),
            'fromTo' => $request->get('fromTo', ''),
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'type' => 'SEARCH'
        ];
        $questions = $this->_questionAnswerServiceInterface->searchWithInfo($info);
        return view($this->_prefix . 'list', compact('questions', 'info', 'status'));
    }

    public function create() {
        $services = $this->_questionAnswerServiceInterface->getTypeOfService();
        return view($this->_prefix . 'create', compact('services'));
    }

    public function uploadImage() {
        dd(1);
    }

    public function store(QuestionAnswerServiceRequest $request, $id = null) {
        try {
            $input = $request->all();
            $data = $this->_questionAnswerServiceInterface->handleCreateOrUpdate($id, $input);
            if (!$data) {
                $message = config('global.default.messages.question_answer_service.error');
                return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_ERROR));
            } else {
                $message = config('global.default.messages.question_answer_service.store');
                return redirect()->route('questions.list')->with($this->getMessages($message, $this::$TYPE_MESSAGES_SUCCESS));
            }
        } catch (Exception $e) {
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            $message = config('global.default.messages.question_answer_service.error');
            return redirect()->back()->with($this->getMessages($message, $this::$TYPE_MESSAGES_ERROR));
        }
    }

    public function approve(Request $request) {
        try {
            $input = $request->all();
            $this->_questionAnswerServiceInterface->changeStatus($input);
            return \Response::json(['success' => $this::$TYPE_MESSAGES_SUCCESS, 'message' => config('global.default.messages.question_answer_service.approved')]);
        } catch (Exception $e) {
            dd($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            logger($e->getMessage() . ' at ' . $e->getLine() .  ' in ' . $e->getFile());
            return \Response::json(['success' => $this::$TYPE_MESSAGES_ERROR, 'message' => config('global.default.messages.question_answer_service.error')]);
        }
    }
}
