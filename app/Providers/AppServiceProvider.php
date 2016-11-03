<?php

namespace App\Providers;

use App\Http\Validators\CustomValidator;
use Illuminate\Support\ServiceProvider;
use App\DataAccess\Cache\DataCache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->resolver(function($translator, $data, $rules, $messages) {
            return new CustomValidator($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\EntryRepositoryInterface::class,
            function ($app) {
                return new \App\Repositories\EntryRepository(
                    new \App\DataAccess\Eloquent\Entry,
                    new DataCache($app['cache'], 'entry', 120)
                );
            }
        );
    }
}
