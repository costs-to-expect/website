<?php

namespace App\Providers;

use App\Request\Http;
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

        Http::getInstance()
            ->public()
            ->get('/v2', false, [__CLASS__, __METHOD__]);

        View()->composer(['layouts.default'], function($view) {
            $view->with(
                'api_status',
                Http::getInstance()->previousRequestStatusCode()
            );
        });
    }
}
