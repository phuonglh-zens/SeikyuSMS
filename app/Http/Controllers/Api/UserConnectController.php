<?php

namespace App\Http\Controllers\Api;
use App\Http\Validators\UserConnectValidator;
use App\Services\UserConnectService;
use Symfony\Component\HttpFoundation\JsonResponse;

use Illuminate\Http\Request;

class UserConnectController extends BaseApiController
{
    protected $service;
    protected $request;

    public function __construct(
        UserConnectService $service,
        UserConnectValidator $request
    ) {
        $this->service = $service;
        parent::setService(UserConnectService::class);
        parent::setRequest($request);
    }

    public function list()
    {
        $data = $this->service->list();

        return $this->sendSuccessResponse("Success", JsonResponse::HTTP_OK, $data);
    }

    public function connect(Request $request)
    {
        if ($validateResponse = $this->sendValidateResponse($request)) {
            return $validateResponse;
        }

        $data = $this->service->connect($request);

        return $this->sendSuccessResponse("User has been successfully connected", JsonResponse::HTTP_OK, $data);
    }
}
