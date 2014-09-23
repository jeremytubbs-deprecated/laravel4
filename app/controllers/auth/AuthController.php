<?php

use Acme\Forms\LoginForm;

class AuthController extends \BaseController {

    /**
     * @var LoginForm
     */
    private $loginForm;

    /**
     * @param SignInForm $signInForm
     */
    public function __construct(LoginForm $loginForm)
    {
        $this->loginForm = $loginForm;

        $this->beforeFilter('csrf', ['on' => ['post']]);
        $this->beforeFilter('guest', ['except' => 'getLogout']);
    }

    /**
	 * Show the form for signing in.
	 *
	 * @return Response
	 */
	public function getLogin()
	{
		return View::make('auth.login');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postLogin()
	{
        $formData = Input::only('email', 'password');

        $this->loginForm->validate($formData);

        if ( ! Auth::attempt($formData))
        {
            Flash::message('We were unable to sign you in. Please check your credentials and try again!');

            return Redirect::back()->withInput();
        }

        Flash::message('Welcome back!');

        return Redirect::home();
	}

    /**
     * Log a user out.
     *
     * @return mixed
     */
    public function getLogout()
    {
        Auth::logout();

        Flash::message('You have now been logged out.');

        return Redirect::home();
    }
}