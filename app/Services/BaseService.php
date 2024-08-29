<?php

namespace App\Services;

use Illuminate\Http\Request;

abstract class BaseService
{
    protected $repository;

    /**
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->repository = app()->make($this->repository());
    }

    abstract function repository();

    public function index(Request $request)
    {
        if ($request->has("per_page")) {
            return $this->repository->paginate($request->input("per_page"));
        }
        return $this->repository->all();
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function store(Request $request)
    {
        return $this->repository->create($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

    public function search(Request $request, array $param ){
        return $this->repository->search($param);
    }
}
