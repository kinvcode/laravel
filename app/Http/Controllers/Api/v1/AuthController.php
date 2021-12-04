<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return fail_response('Email and password do not match.', 422);
        }

        return $this->respondWithToken($token);
    }

    public function logout(Request $request)
    {
        auth('api')->logout(true);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }
}
