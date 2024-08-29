<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Validators\UserInfoValidator;
use App\Services\UserInfoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class UserInfoController extends BaseApiController
{
    protected $service;
    protected $validator;

    public function __construct(
        UserInfoService $service,
        UserInfoValidator $validator
    ) {
        $this->service = $service;
        parent::setService(UserInfoService::class);
        parent::setRequest($validator);
    }

    /**
     * Display a listing of the resource.
     */

    public function register(Request $request)
    {
        if ($validateResponse = $this->sendValidateResponse($request)) {
            return $validateResponse;
        }

        $data = $this->service->registerUser($request);

        return $this->sendSuccessResponse("User information has been registered.", JsonResponse::HTTP_OK, $data);
    }
}
