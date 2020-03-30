<?php

namespace EolabsIo\AmazonMwsResponseParser;

use EolabsIo\AmazonMwsResponseParser\AmazonMwsResponseParser;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AmazonMwsResponseParserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'amazon-mws-response-parser');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'amazon-mws-response-parser');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('amazon-mws-response-parser.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/amazon-mws-response-parser'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/amazon-mws-response-parser'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/amazon-mws-response-parser'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);

            Collection::macro('recursive', function () {
                return $this->map(function ($value) {
                    if (is_array($value) || is_object($value)) {
                        return collect($value)->recursive();
                    }

                    return $value;
                });
            });
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'amazon-mws-response-parser');

        // Register the main class to use with the facade
        $this->app->singleton('amazon-mws-response-parser', function () {
            return new AmazonMwsResponseParser;
        });
        
    }
}
