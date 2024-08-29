<?php


namespace App\Services;

use App\Models\User;
use App\Repositories\UserInfoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserInfoService extends BaseService
{
    function repository()
    {
        return UserInfoRepository::class;
    }

    function registerUser($request)
    {
        return $this->repository->registerUser($request);
    }
}
