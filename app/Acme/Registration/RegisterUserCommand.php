<?php namespace Acme\Registration;

class RegisterUserCommand {

    public $email;

    public $password;

    function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

} 