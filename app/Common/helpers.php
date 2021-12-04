<?php

use \Illuminate\Http\JsonResponse;

if (!function_exists('error_response')) {
    function error_response(string $message, int $code): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'code' => $code,
            'request' => request()->getMethod() . ' ' . request()->path()
        ]);
    }
}

if (!function_exists('success_response')) {
    function success_response(string $message = 'success'): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'code' => 0
        ]);
    }
}

if (!function_exists('fail_response')) {
    function fail_response(string $message, int $status): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'code' => -1,
            'request' => request()->getMethod() . ' ' . request()->path()
        ], $status);
    }
}

if (!function_exists('json_response')) {
    function json_response(array $data): JsonResponse
    {
        return response()->json($data);
    }
}
