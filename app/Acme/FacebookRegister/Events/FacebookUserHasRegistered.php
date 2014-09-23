<?php namespace Acme\Registration\Events;

use Acme\Users\User;

class FacebookUserHasRegistered {

    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

} 