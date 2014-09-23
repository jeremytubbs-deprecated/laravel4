<?php namespace Acme\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    /**
     * Register Acme event listeners.
     */
    public function register()
    {
        $this->app['events']->listen('Acme.*', 'Acme\Handlers\EmailNotifier');
    }

}