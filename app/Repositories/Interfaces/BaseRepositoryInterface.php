<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    /**
     * Create a model instance
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update a model instance
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, string $id);

    /**
     * Return all model rows
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return mixed
     */
    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');

    /**
     * Find one by ID
     * @param int $id
     * @return mixed
     */
    public function find(string $id);

    /**
     * Find one by ID or throw exception
     * @param int $id
     * @return mixed
     */
    public function findOneOrFail(string $id);

    /**
     * Find based on a different column
     * @param array $data
     * @return mixed
     */
    public function findBy(array $data);

    /**
     * Find one based on a different column
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data);

    /**
     * Find one based on a different column or through exception
     * @param array $data
     * @return mixed
     */
    public function findOneByOrFail(array $data);

    /**
     * Delete one by Id
     * @param int $id
     * @return mixed
     */
    public function delete(string $id);
    public function findByWith(array $data, $relationships = array('*'));
    public function findWith(string $id, $relationships = array('*'));
}
