<?php


namespace App\Repositories;

use App\Models\UserInfo;
use App\Models\UserHistory;
use App\Models\UserCollationLog;

class UserInfoRepository extends BaseRepository
{
    /**
     * Specify Model class name
     * @return mixed
     */
    function model()
    {
        return UserInfo::class;
    }

    function registerUser($request)
    {
        $key = $request->only('uuid', 'customer_number');
        $userData = $this->getArrUserInfo($request);

        $user = UserInfo::updateOrCreate($key, $userData);

        UserCollationLog::updateOrCreate([
            'device_token' => $request['device_token'],
            'user_id' => $user->id
        ], [
            'updated_at' => now()
        ]);

        return $user;
    }

    private function getArrUserInfo($request)
    {
        $arr = $request->only(
            'uuid', 
            'customer_number', 
            'customer_management_number', 
            'customer_name', 
            'customer_name_kana', 
            'phone_number', 
            'company_code', 
            'company_name'
        );

        return $arr;
    }
}
