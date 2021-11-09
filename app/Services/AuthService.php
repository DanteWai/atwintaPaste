<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthService
{
    public function login($dto)
    {
        return Auth::attempt([
            'login' => $dto->login,
            'password' => $dto->password,
        ]);
    }

    public function register($dto)
    {
        $user = User::create([
            'login' => $dto->login,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);

        Auth::login($user);

        return $user;
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        Auth::guard('web')->logout();
    }

    public function isAuth()
    {
        return Auth::check();
    }
}
