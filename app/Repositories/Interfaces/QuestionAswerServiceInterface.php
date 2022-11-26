<?php

namespace App\Repositories\Interfaces;

interface QuestionAswerServiceInterface extends BaseRepositoryInterface
{
    /**
     * search with info
     * @param array $info
     * @return mixed
     */
    public function searchWithInfo(array $info);

    /**
     * get all type of service
     * @return mixed
     */
    public function getTypeOfService();

    /**
     * handle save or update data
     * @param string $id
     * @param array $request
     * @return mixed
     */
    public function handleCreateOrUpdate(String $id, array $request);

    /**
     * change status data
     * @param array $request
     * @return mixed
     */
    public function changeStatus(array $request);

    public function getQuestionAswerWithService($id);
}
