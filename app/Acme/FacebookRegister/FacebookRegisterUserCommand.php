<?php namespace Acme\FacebookRegister;

class FacebookRegisterUserCommand {

    public $id;

    public $email;

    public $access_token;

    function __construct($id, $email, $access_token)
    {
        $this->id = $id;
        $this->email = $email;
        $this->access_token = $access_token;
    }

} 