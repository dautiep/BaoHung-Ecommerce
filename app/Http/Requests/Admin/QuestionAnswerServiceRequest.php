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
                'questionName' => 'required|unique:question_aswer_service,question_content|max:200',
                'questionService' => 'required',
                'questionAnswer' => 'required|max:200',
            ];
        }
        $question = $this->_questionAnswerServiceInterface->find(request()->id);
        return [
            'questionName' => 'required|max:200|unique:question_aswer_service,question_content, '.$question->id,
            'questionService' => 'required',
            'questionAnswer' => 'required|max:200',
        ];
    }
}
