<?php


namespace App\Dto;


class RegisterDto implements Dto
{
    public $login;
    public $password;
    public $email;

    public function __construct(string $login, string $password, string $email)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
    }
}
