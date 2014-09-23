<?php

use Acme\Users\User;

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
			$facebook_user = Facebook::object('me')->fields('id', 'email')->get();
		} catch (FacebookQueryBuilderException $e) {
			return Redirect::to('/')->with('error', $e->getPrevious()->getMessage());
		}

		// Create the user if not exists or update existing
		$user = User::createOrUpdateFacebookObject($facebook_user);
		$user->access_token = $token->access_token;
		$user->save();
		// $user = $this->execute(FacebookRegisterUserCommand::class);

		// Log the user into Laravel
		Facebook::auth()->login($user);

		return Redirect::to('/')->with('message', 'Successfully logged in with Facebook');
	}

}