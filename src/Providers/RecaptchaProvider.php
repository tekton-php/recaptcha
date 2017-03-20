<?php namespace Tekton\Recaptcha\Providers;

use Tekton\Support\ServiceProvider;
use Tekton\Recaptcha\RecaptchaManager;

class RecaptchaProvider extends ServiceProvider {

    function register() {
        $this->app->register(\Tekton\API\Providers\ApiProvider::class);

        $this->app->singleton('recaptcha', function($app) {
            return new RecaptchaManager();
        });
    }

    function boot() {

    }
}
