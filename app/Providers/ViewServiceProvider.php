<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * elements.admin.header 描画時に
         * App\Composers\UserCompopser の composer メソッドが実行されます
         */
        $this->app['view']->composer(
            'elements.admin.header',
            \App\Composers\UserComposer::class
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
