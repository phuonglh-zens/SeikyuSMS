<?php


namespace App\Services;

use App\Models\User;
use App\Repositories\UserConnectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserConnectService extends BaseService
{
    function repository()
    {
        return UserConnectRepository::class;
    }

    public function list()
    {
        return $this->repository->list();
    }

    public function connect($request)
    {
        $data = $request->all();

        return $this->repository->connect($data);
    }
}
