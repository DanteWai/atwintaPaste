<?php

namespace App\Http\Requests;

use App\Dto\LoginDto;

class LoginRequest extends ApiRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'login'=>'required',
            'password'=>'required',
        ];
    }

    public function getDto(): LoginDto
    {
        return new LoginDto(
            $this->get('login'),
            $this->get('password'),
        );
    }
}
