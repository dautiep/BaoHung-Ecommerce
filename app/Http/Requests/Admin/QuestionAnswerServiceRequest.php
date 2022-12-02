<?php

namespace App\Http\Requests\Admin;

use App\Repositories\Interfaces\QuestionAswerServiceInterface;
use Illuminate\Foundation\Http\FormRequest;

class QuestionAnswerServiceRequest extends FormRequest
{
    private $_questionAnswerServiceInterface;

    public function __construct(QuestionAswerServiceInterface $questionAswerServiceInterface)
    {
        $this->_questionAnswerServiceInterface = $questionAswerServiceInterface;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!request()->id) {
            return [
                'questionName' => ['required','unique:question_aswer_service,question_content'],
                'questionService' => 'required',
                'questionAnswer' => 'required|',
            ];
        }
        $questions = $this->_questionAnswerServiceInterface->getAllData();
        $question = $this->_questionAnswerServiceInterface->find(request()->id);
        return [
            'questionName' => [
                'required',
                function ($attribute, $value, $fail) use ($question, $questions) {
                    foreach ($questions as $item) {
                        if ($item->question_content == $value && $value != $question->name) {
                            return $fail('Câu hỏi đã tồn tại trong hệ thống');
                        }
                    }
                }
            ],
            'questionService' => 'required',
            'questionAnswer' => 'required',
        ];
    }
}
