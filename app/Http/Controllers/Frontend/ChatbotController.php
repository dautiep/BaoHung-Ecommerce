<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Admin\TypeOfServiceRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chatbot\ChatRequest;
use App\Repositories\Interfaces\OtherFagRepositoryInterface;
use App\Repositories\Interfaces\QuestionAswerServiceInterface;
use App\Repositories\Interfaces\TypeOfServiceRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    private $_prefix = 'frontend.pages.';
    private $_bot = 'frontend.messages.';
    private $_questionAswerServiceInterface;
    private $_typeOfServiceInterFace;
    private $_ortherRepositoryInterface;
    public function __construct(QuestionAswerServiceInterface $questionAswerServiceInterface, TypeOfServiceRepositoryInterface $typeOfServiceRepository, OtherFagRepositoryInterface $otherFagRepositoryInterface)
    {
        $this->_questionAswerServiceInterface = $questionAswerServiceInterface;
        $this->_typeOfServiceInterFace = $typeOfServiceRepository;
        $this->_ortherRepositoryInterface = $otherFagRepositoryInterface;
    }

    public function bot(Request $request)
    {
        return view($this->_prefix . 'index');
    }

    // when call bot when loaded pages
    public function handleCallBot(Request $request)
    {
        try {
            switch ($request->action) {
                case 'callBotById';
                    return $this->actionClickBot($request);
                case 'callBot': // load bot
                    return $this->actionCallBot($request);
            }
        } catch (Exception $e) {
            return $this->actionCallBot($request);
        }
    }

    public function actionCallBot($request, $message = 'Chào bạn. Mình là trợ lý ảo . Mình có thể giúp gì cho bạn không?')
    {
        $data = $this->_typeOfServiceInterFace->getTypeOfService();
        $next = 'callBotById';
        return view($this->_bot . 'bot', compact('data', 'message', 'next'))->render();
    }

    public function actionClickBot($request)
    {
        $next =  $request->get('next');
        switch ($next) {
            case 'callBotById':
                $type_of_service = $this->_typeOfServiceInterFace->findWithRelation($request->get('id', ''), ['questionAswerService']);
                $message = $type_of_service->name;
                $data = collect($type_of_service->questionAswerService)->map(function ($item) {
                    return (object) [
                        'id' => $item->id,
                        'name' => $item->question_content
                    ];
                });
                $next =  'callBotAswer';
                return view($this->_bot . 'bot', compact('data', 'message', 'next'))->render();
            case 'callBotAswer';
                $question = $this->_questionAswerServiceInterface->getQuestionAswerWithService($request->id);
                $message = $question->consulting_content;
                return view($this->_bot . 'bot', compact('message'))->render();
            default:
        }
    }

    public function handleBotUser(Request $request)
    {
        $message = $request->message ?? '';
        return view($this->_bot . 'user', compact('message'))->render();
    }

    // submit form question user
    public function handleSendQuestion(ChatRequest $request)
    {
        dd($request->all());
        $data = $this->_ortherRepositoryInterface->createQuestion($request);
        return response()->json('Câu hỏi của bạn đã được gửi đi');
    }
}
