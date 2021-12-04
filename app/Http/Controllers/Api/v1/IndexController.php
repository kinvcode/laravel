<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function version(): JsonResponse
    {
        return json_response(['version' => '1.0.0']);
    }
}
