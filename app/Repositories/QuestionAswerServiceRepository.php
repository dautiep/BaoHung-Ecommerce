<?php

namespace App\Repositories;

use App\Models\QuestionAswerService;
use App\Models\TypeOfService;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\QuestionAswerServiceInterface;
use Illuminate\Support\Facades\Auth;

class QuestionAswerServiceRepository extends BaseRepository implements QuestionAswerServiceInterface
{
    private $_model;
    private $_modelService;
    public function __construct(QuestionAswerService $model, TypeOfService $modelService)
    {
        $this->_model = $model;
        $this->_modelService = $modelService;
        parent::__construct($model);
    }

    //search with info from fe
    public function searchWithInfo($info)
    {
        $result = $this->_model;
        if (!empty($info['questionName'])) {
            $result = $result->where('question_content', 'like', "%" . $info['questionName'] . "%");
        }
        if (!empty($info['fromDate']) && !empty($info['toDate'])) {
            $result = $result->where('created_at', '>=', $info['fromDate']);
            $result = $result->where('created_at', '<=', $info['toDate']);
        }
        if ($info['questionStatus'] != '') {
            $result = $result->where('status', $info['questionStatus']);
        }
        if ($info['questionService'] != '') {
            $result = $result->where('type_of_service_id', $info['questionService']);
        }
        return $result->with(['typeOfServices'])->orderBy('created_at', 'DESC')->paginate(10);
    }

    //get all type of service
    public function getTypeOfService()
    {
        return $this->_modelService->where('status', config('global.default.status.type_of_services')[0]['key'])->get();
    }

    //handle save or update data
    public function handleCreateOrUpdate($id, $request)
    {
        if ($id == null) {
            $idValue = Str::random(5);
            return $this->_model->create(
                [
                    'id' => $idValue,
                    'question_content' => $request['questionName'],
                    'type_of_service_id' => $request['questionService'],
                    'consulting_content' => $request['questionAnswer'],
                    'user_id' => Auth::user()->id
                ]
            );
        }
        return $this->update([
            'question_content' => $request['questionName'],
            'type_of_service_id' => $request['questionService'],
            'consulting_content' => $request['questionAnswer']

        ], $id);
    }


    public function changeStatus($input)
    {
        $status = config('global.default.status.question');
        if ((int)$input['questionStatus'] == $status[0]['key']) {
            return $this->update(['status' => $status[1]['key']], $input['questionId']);
        } else if ((int)$input['questionStatus'] == $status[1]['key']) {
            return $this->update(['status' => $status[2]['key']], $input['questionId']);
        } else {
            return $this->update(['status' => $status[2]['key']], $input['questionId']);
        }
    }

    public function getQuestionAswerWithService($id)
    {
        return $this->_model->with('typeOfServices')->where('id', $id)->first();
    }
}
