<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use App\Services\Response\ResponseService;

class AuthController extends Controller
{
    public function username()
    {
        return 'login';
    }

    public function login(LoginRequest $request, AuthService $auth)
    {
        $isAuth = $auth->login($request->getDto());

        if (!$isAuth) {
            return ResponseService::send(
                false,
                401,
                ['message' => __('auth.incorrect')]
            );
        }

        return ResponseService::success(
            new UserResource($auth->user())
        );
    }

    public function register(RegisterRequest $request, AuthService $auth)
    {
        $user = $auth->register($request->getDto());
        return ResponseService::success(
            new UserResource($user)
        );
    }

    public function logout(AuthService $auth)
    {
        if ($auth->isAuth()) {
            $auth->logout();
        }

        return ResponseService::success([
            'message' =>  __('auth.logout')
        ]);
    }

    public function check(AuthService $auth)
    {
        if (!$auth->isAuth()) {
            return ResponseService::notAuthorize();
        }

        return ResponseService::success(
            new UserResource($auth->user())
        );
    }
}
