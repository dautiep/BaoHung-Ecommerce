<?php

namespace App\Repositories;

use App\Models\QuestionAswerService;
use App\Repositories\Interfaces\QuestionAswerServiceInterface;

class QuestionAswerServiceRepository extends BaseRepository implements QuestionAswerServiceInterface
{
    private $_model;
    public function __construct(QuestionAswerService $model)
    {
        $this->_model = $model;
    }
}
