<?php


namespace App\Http\Requests;


use App\Dto\RegisterDto;

class RegisterRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'login'=>'required',
            'password'=>'required',
            'email'=>'required|email',
        ];
    }

    public function getDto(): RegisterDto
    {
        return new RegisterDto(
            $this->get('login'),
            $this->get('password'),
            $this->get('email'),
        );
    }
}
