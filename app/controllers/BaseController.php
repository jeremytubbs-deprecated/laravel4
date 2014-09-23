<?php

use Laracasts\Commander\CommanderTrait;

class BaseController extends Controller {

	use CommanderTrait;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		View::share('currentUser', Auth::user());

		$this->beforeFilter(function()
		{
			Event::fire('clockwork.controller.start');
		});

		$this->afterFilter(function()
		{
			Event::fire('clockwork.controller.end');
		});
	}
}
