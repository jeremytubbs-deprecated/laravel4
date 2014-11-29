<?php

use Acme\Users\User;
use Acme\Registration\RegisterUserCommand;

class FacebookController extends \BaseController {

	public function createFacebook()
	{
		return Redirect::to(Facebook::getLoginUrl());
	}

	public function storeFacebook()
	{
		try {
			$token = Facebook::getTokenFromRedirect();
			if ( ! $token) return Redirect::to('/')->with('error', 'Unable to obtain access token.');
		} catch (FacebookQueryBuilderException $e) {
			return Redirect::to('/')->with('error', $e->getPrevious()->getMessage());
		}

		if ( ! $token->isLongLived()) {
			/**
			 * Extend the access token.
			 */
			try {
				$token = $token->extend();
			} catch (FacebookQueryBuilderException $e) {
				return Redirect::to('/')->with('error', $e->getPrevious()->getMessage());
			}
		}

		Facebook::setAccessToken($token);

		/**
		 * Get basic info on the user from Facebook.
		 */
		try {
			$facebook_user = Facebook::object('me')->fields('id', 'email', 'first_name', 'last_name', 'birthday', 'locale', 'timezone', 'gender')->get();
		} catch (FacebookQueryBuilderException $e) {
			return Redirect::to('/')->with('error', $e->getPrevious()->getMessage());
		}

		// Create the user if not exists or update existing
		$user = User::createOrUpdateFacebookObject($facebook_user);
		// $user->facebook_user_id = $facebook_user['id'];
		$user->access_token = $token->access_token;
		$user->save();

		// Log the user into Laravel
		Facebook::auth()->login($user);

		//$user = $this->execute(RegisterUserCommand::class);

		Flash::overlay('Welcome to the site you are now logged in!');

		return Redirect::to('/');
	}

}