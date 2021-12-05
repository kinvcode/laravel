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
    function success_response(array $data): JsonResponse
    {
        return response()->json($data);
    }
}

if (!function_exists('fail_response')) {
    function fail_response(string $message, $code, int $status): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'code' => $code,
            'request' => request()->getMethod() . ' ' . request()->path()
        ], $status);
    }
}
