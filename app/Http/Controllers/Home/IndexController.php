<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use function success_response;

class IndexController extends Controller
{
    public function version(): JsonResponse
    {
        return success_response(['version' => '1.0.0']);
    }
}
