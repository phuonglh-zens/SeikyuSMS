<?php


namespace App\Repositories;

use App\Models\UserInfo;
use App\Models\UserConnect;

class UserConnectRepository extends BaseRepository
{
    /**
     * Specify Model class name
     * @return mixed
     */
    function model()
    {
        return UserConnect::class;
    }

    public function list()
    {
        $auth = auth()->user();

        $connectors = $auth->connectors()->with('userInfo')->get();

        return $connectors;
    }

    public function connect($data)
    {
        $UserConnect = UserInfo::where('uuid', $data['uuid'])->first();

        if($UserConnect) {
            UserConnect::updateOrCreate([
                'user_id' => auth()->user()->id,
                'user_connect_id' => $UserConnect->id
            ]);
            return $UserConnect;
            
        } else {
            return false;
        }
    }
}
