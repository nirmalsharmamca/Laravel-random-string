<?php

namespace Nirmal\Random;

use Illuminate\Support\ServiceProvider;

class RandomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    
	/**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        $this->app->singleton('Random', function() {
			return new Random;
		});
	
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array("Random");
    }
	
	
}
