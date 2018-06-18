<?php namespace Tekton\Recaptcha\Facades;

class Recaptcha extends \Dynamis\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'recaptcha';
    }
}
