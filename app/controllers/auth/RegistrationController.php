<?php

use Acme\Forms\RegistrationForm;
use Acme\Registration\RegisterUserCommand;
use Laracasts\Validation\FormValidationException;

class RegistrationController extends \BaseController {

    /**
     * @var RegistrationForm
     */
    private $registrationForm;

    /**
     * Constructor
     *
     * @param RegistrationForm $registrationForm
     */
    function __construct(RegistrationForm $registrationForm)
    {
        $this->registrationForm = $registrationForm;

        $this->beforeFilter('guest');
    }

    /**
	 * Show a form to register the user
	 *
	 * @return Response
	 */
	public function getRegister()
	{
		return View::make('auth.register');
	}

    /**
     * Create a new Larabook user.
     *
     * @return string
     */
    public function postRegister()
    {
        try
        {
            $this->registrationForm->validate(Input::all());
        }
        catch (FormValidationException $e)
        {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }
        $user = $this->execute(RegisterUserCommand::class);

        Auth::login($user);

        Flash::overlay('Welcome to the site you are now logged in!');

        return Redirect::home();
    }

}
