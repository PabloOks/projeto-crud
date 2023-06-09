<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Enums\ResponseStatusCode;

class Controller extends BaseController
{
    /**
     * Return a success response in JSON
     */
    public function success(?string $message = '', ?array $data = []): JsonResponse
    {
        $response = [];
        if ($message) $response['message'] = $message;
        if ($data) $response['data'] = $data;

        return response()->json(
            $response,
            ResponseStatusCode::Success->value
        );
    }

    /**
     * Return an error response in JSON
     */
    public function error(
        ResponseStatusCode $code,
        ?string $message = '',
        ?array $data = []
    ): JsonResponse {
        $response = [];
        if ($message) $response['message'] = $message;
        if ($data) $response['data'] = $data;

        return response()->json(
            $response,
            $code->value
        );
    }
}
