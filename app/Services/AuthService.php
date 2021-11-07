<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return User::create([
            'login' => $dto->login,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        Auth::logout();
    }

    public function isAuth()
    {
        return Auth::check();
    }
}
