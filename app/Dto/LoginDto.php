<?php


namespace App\Dto;


class LoginDto implements Dto
{
    public $login;
    public $password;

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }
}
