<?php

namespace App\Repositories;

use App\Models\OtherFag;
use App\Repositories\Interfaces\OtherFagRepositoryInterface;

class OtherFagRepository extends BaseRepository implements OtherFagRepositoryInterface
{
    private $_model;
    public function __construct(OtherFag $model)
    {
        $this->_model = $model;
    }
}
