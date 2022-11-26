<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    private $_prefix = 'frontend.pages.';
    private $_bot = 'frontend.messages.';
    public function index(Request $request)
    {
        return view($this->_prefix . 'index');
    }

    public function actionBot(Request $request)
    {
        return view($this->_bot . 'bot')->render();
    }

    public function actionSendMessage(Request $request)
    {
        $message = $request->message ?? '';
        return view($this->_bot . 'user', compact('message'))->render();
    }

    public function actionSendQuestion(Request $request)
    {
        $data = $request->all();
        return response()->json($request->message);
    }
}
