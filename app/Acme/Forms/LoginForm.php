<?php namespace Acme\Forms;

use Laracasts\Validation\FormValidator;

class LoginForm extends FormValidator {

    /**
     * Validation rules for the login form.
     *
     * @var array
     */
    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required'
    ];

}