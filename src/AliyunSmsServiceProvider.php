<?php
namespace Wangjian\Alisms;

use Illuminate\Support\ServiceProvider;

class AliyunSmsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('alisms', function ($app) {
            return new SmsClient($app['config']['alisms.accessKeyId'], $app['config']['alisms.accessKeySecret']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['alisms'];
    }
}
