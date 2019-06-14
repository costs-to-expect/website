<?php

namespace App\Providers;

use App\Request\Api;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View()->composer(['layouts.default'], function($view) {
            $view->with(
                'footer',
                Config::get('web.app')
            );
        });

        Api::getInstance()
            ->public()
            ->get('/v1');

        View()->composer(['layouts.default'], function($view) {
            $view->with(
                'api_status',
                (Api::getInstance()->previousStatusCode() === 503 ? false : true)
            );
        });
    }
}
