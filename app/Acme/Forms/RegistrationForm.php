<?php namespace Acme\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator {

    /**
     * Validation rules for the registration form.
     *
     * @var array
     */
    protected $rules = [
        'email'    => 'required|email|unique:users',
        'password' => 'required|confirmed'
    ];

}