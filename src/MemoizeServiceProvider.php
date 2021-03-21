<?php

namespace Aliem\Memoize;

use Illuminate\Support\ServiceProvider;

class MemoizeServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('memoize', function ($app) {
			return new Memoize();
		});
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}
}
