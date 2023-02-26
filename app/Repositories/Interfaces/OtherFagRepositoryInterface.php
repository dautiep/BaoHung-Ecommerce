<?php

namespace App\Repositories\Interfaces;

interface OtherFagRepositoryInterface extends BaseRepositoryInterface
{
    public function createQuestion($request);
    public function getList($request);
    public function getAllDepartment();
    public function updateContentToConsult($request, $id);
    public function handleDelete($request);
    public function countQuestionByStatus();
    public function getAllQuestions();
    public function countQuestionsByDate($date);
}
