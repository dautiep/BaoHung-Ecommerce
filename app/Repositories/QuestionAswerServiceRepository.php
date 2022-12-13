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

    //get all data
    public function getAllData()
    {
        return $this->_model->select('question_content')->get();
    }

    //search with info from fe
    public function searchWithInfo($info)
    {
        $result = $this->_model;
        //check filter search
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

        //check permission
        $result = $result->where(function ($query) {
            if (!Auth::user()->is_admin) {
                if (is_can(['questions.list'])) {

                } else if (is_can(['questions.listBoss'])) {
                    $queryIdUsers = app(UserRepository::class)->getListIdByDepartmentId(Auth::user()->department_id);
                    $query->bossRole('user_id', $queryIdUsers);
                } else if (is_can(['questions.listStaff'])) {
                    $query->staffRole('user_id', Auth::user()->id);
                } else {
                    $query = $query->where('status', -1);
                }
            }
        });
        return $result->with(['typeOfServices', 'user'])->orderBy('created_at', 'DESC')->paginate(10);
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
                    'user_id' => Auth::user()->id,
                    'attach_files' => request()->file('file'),
                ]
            );
        }
        return $this->update([
            'question_content' => $request['questionName'],
            'type_of_service_id' => $request['questionService'],
            'consulting_content' => $request['questionAnswer'],
            'attach_files' => request()->file('file')
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
            return $this->update(['status' => $status[1]['key']], $input['questionId']);
        }
    }

    public function getQuestionAswerWithService($id)
    {
        $status = config('global.default.status.question');
        return $this->_model->where('status', $status[1]['key'])->with(['typeOfServices' => function ($q) {
            $status = config('global.default.status.type_of_services');
            $q->where('status', $status);
        }])->where('id', $id)->first();
    }

    public function getQuestionBotAppendDownload($builder)
    {
        return @$builder->content;
    }
}
