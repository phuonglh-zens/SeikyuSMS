<?php


namespace App\Repositories;


interface RepositoryInterface
{
    /**
     * Get all data
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*']);

    /**
     * Get data by id
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = ['*']);

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*']);

    /**
     * Create data
     * @param mixed $input
     * @return mixed
     */
    public function create($input);

    /**
     * Update data by id
     * @param mixed $input
     * @param $id
     * @return mixed
     */
    public function update(array $input, $id);

    /**
     * Delete data by id
     * @param $id
     * @return mixed
     */
    public function delete($id);
}