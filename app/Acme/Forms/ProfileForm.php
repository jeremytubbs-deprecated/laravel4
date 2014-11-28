<?php namespace Acme\Forms;

use Laracasts\Validation\FormValidator;

class ProfileForm extends FormValidator {

    /**
     * Validation rules for the login form.
     *
     * @var array
     */
    protected $rules = [
    	'username' => 'unique:users',
        'email'    => 'required|email|unique:users'
    ];

}