<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseApiController extends Controller
{
    /**
     * @var BaseService
     */
    protected $service;
    protected $request;

    public function setService($service)
    {
        $this->service = app()->make($service);
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function index(Request $request)
    {
        $list = $this->service->index($request);
        return $this->sendSuccessResponse("Success", JsonResponse::HTTP_OK, $list);
    }

    public function show($id)
    {
        $data = $this->service->show($id);
        if (!$data) {
            return $this->sendErrorResponse("Not found", JsonResponse::HTTP_NOT_FOUND);
        }

        return $this->sendSuccessResponse("Success", JsonResponse::HTTP_OK, $data);
    }

    public function store(Request $request)
    {
        if ($this->request->validate($request->all()) !== true) {
            return $this->sendErrorResponse(
                "Validation failed",
                JsonResponse::HTTP_PRECONDITION_FAILED,
                $this->request->validate($request->all())
            );
        };

        /**
         * @var User $user
         */
        //$user = auth('api')->user();
        $stored_data = $this->service->store($request);

        if (!$stored_data) {
            return $this->sendErrorResponse("Creation failed.", JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->sendSuccessResponse("Success", JsonResponse::HTTP_OK, $stored_data);
    }

    public function update(Request $request, $id)
    {
        if ($this->request->validate($request->all()) !== true) {
            return $this->sendErrorResponse(
                "Validation failed",
                JsonResponse::HTTP_PRECONDITION_FAILED,
                $this->request->validate($request->all())
            );
        };
      
        $is_updated = $this->service->update($request, $id);
        if ($is_updated) {
            $data = $this->service->show($id);
            return $this->sendSuccessResponse("Success", JsonResponse::HTTP_OK, $data);
        }

        return $this->sendErrorResponse("Not found", JsonResponse::HTTP_NOT_FOUND);
    }

    public function destroy($id)
    {
        $is_deleted =  $this->service->destroy($id);
        if ($is_deleted) {
            return $this->sendSuccessResponse("Success", JsonResponse::HTTP_OK);
        }
        return $this->sendErrorResponse("Not found", JsonResponse::HTTP_NOT_FOUND);
    }

    public function search(Request $request)
    {
        $data = $this->service->search($request);
        if ($data) {
            return $this->sendSuccessResponse("Success", JsonResponse::HTTP_OK, $data);
        }

        return $this->sendErrorResponse("Not found", JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * Return Success response
     * @param array $results
     * @param string $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccessResponse($message, $code = JsonResponse::HTTP_OK, $results = [])
    {
        $response = [
            'status' => $code,
            'message' => $message,
            'data' => $results,
        ];

        return response()->json($response, $code);
    }

    /**
     * Return error response
     * @param array $results
     * @param $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendErrorResponse($message, $code = JsonResponse::HTTP_NOT_FOUND, $results = [])
    {
        $response = [
            'status' => $code,
            'message' => $message,
            'data' => $results,
        ];

        return response()->json($response, $code);
    }

    public function sendValidateResponse($request)
    {
        $validationErrors = $this->request->validate($request->all());

        if ($validationErrors !== true) {
            return $this->sendErrorResponse(
                "Validation failed",
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                $validationErrors
            );
        }

        return null;
    }

}
