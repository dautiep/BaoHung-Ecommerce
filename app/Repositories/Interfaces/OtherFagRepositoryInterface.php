<?php

namespace App\Repositories\Interfaces;

interface OtherFagRepositoryInterface extends BaseRepositoryInterface
{
    public function createQuestion($request);
    public function getList($request);
    public function updateContentToConsult($request, $id);
    public function handleDelete($request);
}
