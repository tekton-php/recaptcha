<?php namespace Tekton\Recaptcha\Providers;

use Illuminate\Support\ServiceProvider;
use Tekton\Recaptcha\RecaptchaManager;

class RecaptchaProvider extends ServiceProvider
{
    function provides()
    {
        return ['recaptcha'];
    }

    function register()
    {
        $this->app->register(\Tekton\API\Providers\ApiProvider::class);

        $this->app->singleton('recaptcha', function($app) {
            $config = $app['config']->get('recaptcha', []);
            $api = $app['api'];
            return new RecaptchaManager($config, $api);
        });
    }
}
