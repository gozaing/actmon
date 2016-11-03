<?php

namespace App\Providers;

use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\ServiceProvider;

/**
 * Class CaptchaServiceProvider
 * @package App\Providers
 */
class CaptchaServiceProvider extends ServiceProvider
{
    /** @var bool */
    protected $defer = true;

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
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(
            'Gregwar\Captcha\CaptchaBuilderInterface',
            function () {
                return new CaptchaBuilder();
            }
        );
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            '\Gregwar\Captcha\CaptchaBuilderInterface',
        ];
    }
}
