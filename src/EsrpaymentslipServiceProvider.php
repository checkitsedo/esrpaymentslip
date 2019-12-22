<?php

namespace Checkitsedo\Esrpaymentslip;

use Illuminate\Support\ServiceProvider;

class EsrpaymentslipServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Checkitsedo\Esrpaymentslip\Controllers\EsrpaymentslipController');
        $this->loadViewsFrom(__DIR__.'/views','esrpaymentslips');
		
		require_once __DIR__.'/Helpers/EsrpaymentslipHelper.php';
		require_once __DIR__.'/Pdf/Download.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
		
		$this->loadMigrationsFrom(__DIR__.'/database/migrations');
		
		$this->publishes([
			__DIR__.'/public/images' => public_path('checkitsedo/images'),
		], 'public');
		
		$this->publishes([
			__DIR__.'/public/css' => public_path('checkitsedo/css'),
		], 'public');
    }
}
