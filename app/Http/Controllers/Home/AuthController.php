<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function auth;
use function fail_response;
use function request;
use function response;
use function success_response;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    // 忘记密码、重新发送验证邮件；

    /**
     * @param RegisterRequest $request
     * Description: 注册一个用户
     * Author: kinvcode@gmail.com
     * Time: 2021-12-03 17:20
     * @return Model
     */
    public function register(RegisterRequest $request): Model
    {
        $data = $request->only(['email', 'password']);
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * @param LoginRequest $request
     * Description: 登录
     * Author: kinvcode@gmail.com
     * Time: 2021-12-04 17:27
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return fail_response('Email and password do not match.', -1, 422);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @param Request $request
     * Description: 退出
     * Author: kinvcode@gmail.com
     * Time: 2021-12-04 17:27
     * @return void
     */
    public function logout(Request $request)
    {
        auth('api')->logout(true);
    }

    /**
     * @param $token
     * Description: 获取登录响应体
     * Author: kinvcode@gmail.com
     * Time: 2021-12-04 17:27
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    /**
     * Description: 获取已认证的用户信息
     * Author: kinvcode@gmail.com
     * Time: 2021-12-04 17:28
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return success_response(auth('api')->user()->toArray());
    }
}
