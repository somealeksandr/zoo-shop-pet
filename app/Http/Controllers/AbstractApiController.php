<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class AbstractApiController
{
    protected function success($data = [], $message = ''): JsonResponse
    {
        if (is_object($data) && method_exists($data, 'toArray')) {
            $data = $data->toArray();
        }

        $errors = [];
        $success = true;

        return response()->json(compact('data', 'message', 'errors', 'success'));
    }

    protected function error($errors = [], $message = '', $data = []): JsonResponse
    {
        if (is_object($data) && method_exists($data, 'toArray')) {
            $data = $data->toArray();
        }

        $success = false;

        return response()->json(compact('data', 'message', 'errors', 'success'));
    }
}
