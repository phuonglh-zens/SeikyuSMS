<?php

namespace App\Repositories;

use Illuminate\Container\Container as Container;
use Illuminate\Database\Eloquent\Model;
use Exception;


abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Container
     */
    protected $container;

    /**
     * BaseRepository constructor.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $model = $this->model();
        $this->model = app()->make($model);
    }

    /**
     * Specify Model class name
     * @return mixed
     */
    abstract function model();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }
     /**
     * @param $attribute search 
     * @param Array $conditions
     * @return mixed
     */
    public function search(Array $conditions, $columns = array('*'))
    {
       
        $data = $this->model->where(function ($query) use ( $conditions) {
            foreach ($conditions as $field => $value) {
                if (is_array($value)) {
                    [ $condition, $val] = $value;
                    switch (strtoupper($condition)) {
                        case 'IN':
                            $query->whereIn($field, $val);
                            break;
                        case 'NOT_IN':
                            $query->whereNotIn($field, $val);
                            break;
                        default:
                            $query->where($field, $condition, $val);
                            break;
                    }
                } else {
                    $query->where($field, $value);
                }
        }
        })->get($columns);
        return $data;
    }

      /**
     * @param $attribute search 
     * @param Array $conditions
     * @return mixed
     */
    public function searchWithRelationship(Array $conditions, $columns = array('*'), $relation)
    {
       
        $data = $this->model->where(function ($query) use ( $conditions) {
            foreach ($conditions as $field => $value) {
                if (is_array($value)) {
                    [ $condition, $val] = $value;
                    switch (strtoupper($condition)) {
                        case 'IN':
                            $query->whereIn($field, $val);
                            break;
                        case 'NOT_IN':
                            $query->whereNotIn($field, $val);
                            break;
                        case 'OR':
                            $query->where(function ($q) use($val, $field){
                                $q->orWhere($field, $val);
                            });
                            break;
                        default:
                            $query->where($field, $condition, $val);
                            break;
                    }
                } else {
                    $query->where($field, $value);
                }
        }
        })->with($relation)->get($columns);
        return $data;
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }
     /**
     * @param array $attribute 
     * ['key1' => val1 , 'key2' => val2 ]
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function getListViaFindByPaginate($attributes,$perPage = 15, $columns = array('*'))
    {
        return $this->model->where($attributes)->paginate($perPage, $columns);
    }

    /**
     * @param array $attribute 
     * ['key1' => val1 , 'key2' => val2 ]
     * @param $value
     * @return mixed
     */
    public function getListViaFindBy($attributes)
    {
        return $this->model->where($attributes)->get();
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param mixed $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return int|mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
