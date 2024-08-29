<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Validators\UserInfoValidator;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SmartRentaController extends BaseApiController
{
    public function __construct(
        UserService $user_service,
        UserInfoValidator $user_validator
    ) {
        $this->user_service = $user_service;
        parent::setService(UserService::class);
        parent::setRequest($user_validator);
    }

    public function getDataUserInfo(Request $request)
    {
        $data = $request->all();

        if(!isset($data['param']['UniqueID']))
        {
            return response()->json([
                'response_code' => [
                    'response_info' => '9',
                    'message' => '異常'
                ],
            ],400);
        } else {
            switch($data['param']['UniqueID'])
            {
                case '001':
                    return $this->getDataUserInfoTemplate('001');
                break;
                case '002':
                    return $this->getDataUserInfoTemplate('002');
                break;
                case '003':
                    return $this->getDataUserInfoTemplate('003');
                break;
                case '004':
                    return $this->getDataUserInfoTemplate('004');
                break;
                default:
                    return response()->json([
                        'response_code' => [
                            'response_info' => '910',
                            'message' => '該当利用者なし'
                        ],
                    ],404);
                    break;
            }
        }
    }

    public function getDataUserInfoTemplate($uuid)
    {
        return response()->json([
            'response_code' => [
                'response_info' => '0',
                'message' => '利用者情報を取得しました。'
            ],
            'LoginUser_info' => [
                'CompanyCode' => '1101'.$uuid,
                'CompanyName' => '(株)エースレンタル商会',
                'CustomerNumber' => '123456'.$uuid,
                'CustomerManagementNumber' => '11213'.$uuid,
                'CustomerName' => 'Name'.$uuid,
                'CustomerNameKana' => '中本聡'.$uuid,
                'PhoneNumber' => '090-1234-'.$uuid,
                'UniqueID' => $uuid
            ]
        ], 200);
    }
}
