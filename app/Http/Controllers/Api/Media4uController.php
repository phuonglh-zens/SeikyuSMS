<?php

namespace App\Http\Controllers\Api;
use App\Http\Validators\Media4uValidator;
use App\Services\Media4uService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;

class Media4uController extends BaseApiController
{
    protected $service;
    protected $request;

    public function __construct(
        Media4uService $service,
        Media4uValidator $request
    ) {
        $this->service = $service;
        parent::setService(Media4uService::class);
        parent::setRequest($request);
    }

    public function receiveStatus(Request $request)
    {
        
        if ($validateResponse = $this->sendValidateResponse($request)) {
            return $validateResponse;
        }
        
        $statusFailed = [2, 4, 11, 24, 27, 32, 39, 42];
        if(in_array($request['status'], $statusFailed)) {
            return $this->sendErrorResponse("Failure", 550, ['sms-sending-status' => $request['status']]);
        }

        return $this->sendSuccessResponse("Success", JsonResponse::HTTP_OK, ['sms-sending-status' => $request['status']]);
    }
}
