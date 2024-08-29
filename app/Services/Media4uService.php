<?php


namespace App\Services;

use App\Models\User;
use App\Repositories\UserConnectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Media4uService extends BaseService
{
    function repository()
    {
        return UserConnectRepository::class;
    }

    function receiveStatus($request)
    {
        
    }
}
