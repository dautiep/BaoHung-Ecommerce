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
        parent::__construct($model);
    }

    public function getList($request)
    {
        $builder =  $this->_model->where(function ($query) use ($request) {
            if (!empty($request->keySearch)) {
                $query->whereLike('consulting_content', $request->keySearch);
            }

            if (!empty($request->fromTo)) {
                $query->whereExplodeDate('created_at', $request->fromTo);
            }

            if (isset($request->status)) {
                $query->where('status', $request->status);
            }
            if (!is_admin()) {
                if (is_can(['faq.listStaff'])) {
                    $query->staffRole('user_id', auth_user()->id);
                } else if (is_can(['faq.listBoss'])) {
                    $queryIdUsers = app(UserRepository::class)->getListIdByDepartmentId(auth_user()->department_id);
                    $query->bossRole('user_id', $queryIdUsers);
                } else if (is_can(['faq.list'])) {
                    $query = $query;
                } else {
                    $query = $query->where('status', -1);
                }
            }
        })->paginate($this->page);
        return $builder;
    }
    /**
     *   'unanswered',
     *    'answered',
     *    'refuses_answer'
     */
    public function configStatus($type, $action = 'key')
    {
        $config = 'global.default.status.orther_faqs.' . $type . '.' . $action;

        return config($config);
    }

    public function createQuestion($request)
    {
        $data = [
            'consulting_content' => $request->get('message'),
            'status' => $this->configStatus('unanswered', 'key'),
            'content_to_consult' => '',
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'type_of_service_id' => 1
        ];
        return $this->_model->create($data);
    }

    public function handleDelete($request)
    {
        $builder = $this->_model->find($request->get('itemId'));

        if ($builder) {
            $builder = $builder->delete();
        }
        return $builder;
    }

    public function updateContentToConsult($request, $id)
    {

        $builder = $this->_model->find($id);
        if (!$builder) {
            return false;
        }
        if (!empty($request->get('content_to_consult'))) {
            $data = [
                'content_to_consult' => $request->get('content_to_consult'),
                'status' => config('global.default.status.orther_faqs.answered.key')
            ];
        } else if (is_admin()) {
            $data = [
                'status' => config('global.default.status.orther_faqs.unanswered.key'),
                'user_id' => $request->get('assigned_user_id'),
            ];
        } else {
            $data = [
                'status' => config('global.default.status.orther_faqs.unanswered.key'),
            ];
        }
        $builder = $builder->update($data);
        return $builder;
    }
}
