<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    protected $page = 10;
    protected $request;
    const CACHE_KEY = 'CMS';

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    /**
     * getCacheKey
     *
     * @param string $key
     * @return string
     */
    protected function getCacheKey($key = ''): string
    {
        $key = strtoupper($key);
        $base64 = base64_encode(get_called_class());
        return static::CACHE_KEY . ".{$base64}.{$key}";
    }

    /**
     * @param string $store
     * @param string $key
     * @param $value
     * @param int $time
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function setCacheWithStore(string $store, string $key, $value, int $time = 20)
    {
        if (!Cache::store($store)->has($key))
            Cache::store($store)->put($key, $value, $time);
        return Cache::store($store)->get($key);
    }

    /**
     * create
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * update
     *
     * @param array $attributes
     * @param string $id
     * @return bool
     */
    public function update(array $attributes, string $id): bool
    {
        return $this->find($id)->update($attributes);
    }

    /**
     * all
     *
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all($columns = array('*'), string $orderBy = '', string $sortBy = 'asc')
    {
        if ($orderBy == '') {
            $orderBy = $this->model->getKeyName();
        }
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * Get all with relationship.
     *
     * @param string[] $columns
     * @param string $orderBy
     * @param string $sortBy
     * @param string[] $relationships
     * @return mixed
     */
    public function allWith(
        $columns = array('*'),
        string $orderBy = '',
        string $sortBy = 'asc',
        $relationships = array('*')
    ) {
        if ($orderBy == '') $orderBy = $this->model->getKeyName();
        return $this->model->orderBy($orderBy, $sortBy)->with($relationships)->paginate($this->page);
    }

    /**
     * find
     *
     * @param string $id
     * @return mixed
     */
    public function find(string $id)
    {
        return $this->model->find($id);
    }

    /**
     * Get all with relationship.
     *
     * @param string $id
     * @param string[] $relationships
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function findWith(string $id, $relationships = array('*'))
    {
        return $this->model->with($relationships)->find($id);
    }

    public function findWithoutColumn(string $id, $relationships = array(), $fields = '*')
    {
        return $this->model->select($fields)->without($relationships)->find($id);
    }

    /**
     * findOneOrFail
     *
     * @param string $id
     * @return mixed
     */
    public function findOneOrFail(string $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * findBy
     *
     * @param array $data
     * @return mixed
     */
    public function findBy(array $data)
    {
        return $this->model->where($data)->get();
    }

    /**
     * Get all with relationship.
     *
     * @param array $data
     * @param string[] $relationships
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findByWith(array $data, $relationships = array('*'))
    {
        return $this->model->with($relationships)->where($data)->paginate($this->page);
    }

    /**
     * findOneBy
     *
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data)
    {
        return $this->model->where($data)->first();
    }

    /**
     * findOneByOrFail
     *
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail();
    }

    /**
     * delete
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * insertMultipleGlobal
     *
     * @param $model
     * @param array $values
     */
    public function insertMultipleGlobal($model, array $values)
    {
        $model->newQuery()->insert($values);
    }

    /**
     * updateMultipleGlobal
     *
     * @param $model
     * @param array $values
     * @param $updatedUser
     * @param $primaryKey
     * @return int
     */
    public function updateMultipleGlobal($model, array $values, $updatedUser, $primaryKey = "")
    {
        // set data default
        $ids = [];
        $params = [];
        $columnsGroups = [];
        $queryStart = "UPDATE {$model->getTable()} SET";
        $keyTable = $primaryKey ? $primaryKey : "id";

        // set values, column name
        if (isset($values[0]) && is_array($values[0])) {
            $arrValues = $values;
            $columnsNames = array_keys(array_values($values)[0]);
        } else {
            $arrValues[] = $values;
            $columnsNames = array_keys($values);
        }

        // loop
        foreach ($columnsNames as $columnName) {
            $cases = [];
            $columnGroup = "`" . $columnName . "` = (CASE " . $keyTable . " ";

            foreach ($arrValues as $newData) {

                $id = "'" . $newData[$keyTable] . "'";
                $cases[] = "WHEN {$id} then ?";
                $ids[$id] = "0";
                unset($newData[$keyTable]);
                if ($columnName != $keyTable) {

                    if ($newData[$columnName] == "" && $newData[$columnName] != 0) $valParam = null;
                    else {

                        if ($columnName == "phone") {

                            $valParam = $newData[$columnName];
                        } else {
                            $valParam = is_numeric($newData[$columnName]) ? (int)$newData[$columnName] : $newData[$columnName];
                        }
                    }
                    $params[] = $valParam;
                }
            }
            $cases = implode(' ', $cases);
            if ($columnName != $keyTable) $columnsGroups[] = $columnGroup . "{$cases} END)";
        }

        $ids = implode(',', array_keys($ids));
        $columnsGroups = implode(',', $columnsGroups);
        $params[] = $updatedUser;
        $params[] = Carbon::now();
        $queryEnd = ", updated_user = ? , updated_at = ? WHERE " . $keyTable . " in ({$ids})";
        return DB::update($queryStart . $columnsGroups . $queryEnd, $params);
    }

    /**
     * updateGlobalByCondition
     *
     * @param $model
     * @param $condition
     * @param $data
     * @param string $key
     * @return mixed
     */
    public function updateGlobalByCondition($model, $condition, $data, $key = "")
    {
        return $key ? $model->whereIn($condition["key"], $condition["value"])->update($data) : $model->where($condition)->update($data);
    }

    /**
     * updateByIdGlobal
     *
     * @param $model
     * @param $data
     * @param $id
     * @return |null
     */
    public function updateByIdGlobal($model, $data, $id)
    {
        $rowRecord = $model->find($id);
        if (empty($rowRecord)) return null;
        return $rowRecord->update($data);
    }

    /**
     * deleteGlobalByCondition
     *
     * @param $model
     * @param $condition
     * @param $type
     * @return mixed
     */
    public function deleteGlobalByCondition($model, $condition, $type = '')
    {
        if ($type) $condition["arrId"] = is_string($condition["arrId"]) ? explode(" ", $condition["arrId"]) : $condition["arrId"];
        return $type ? $model->whereIn($condition["key"], $condition["arrId"])->delete() : $model->where($condition)->delete();
    }

    /**
     * destroyGlobalByCondition
     *
     * @param $model
     * @param $condition
     * @param $type
     * @return mixed
     */
    public function destroyGlobalByCondition($model, $condition, $type = '')
    {
        if ($type) $condition["arrId"] = is_string($condition["arrId"]) ? explode(" ", $condition["arrId"]) : $condition["arrId"];
        return $type ? $model->whereIn($condition["key"], $condition["arrId"])->forceDelete() : $model->where($condition)->forceDelete();
    }

    /**
     * delete record by id
     *
     * @param $model
     * @param $id
     * @return |null
     */
    public function deleteRecordGlobal($model, $id)
    {
        $rowRecord = $model->find($id);
        if (empty($rowRecord)) return null;
        return $rowRecord->delete();
    }

    /**
     * queryGlobalSQL
     *
     * @param $model
     * @param $with
     * @param $columns
     * @return mixed
     */
    public function queryGlobalSQL($model, $with, $columns)
    {
        $query = $model->select($columns);
        return $with ? $query->with($with) : $query;
    }

    /**
     * getErrorExceptionGlobal
     *
     * @param $e
     * @return string
     */
    protected function getErrorExceptionGlobal($e)
    {
        return $e->getMessage() . " " . $e->getFile() . " " . $e->getLine();
    }
}
