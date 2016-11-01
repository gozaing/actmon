<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

Class DevelopServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $provider = [
        // 開発時に利用するサービス・プロバイダ
        'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',
        'Barryvdh\Debugbar\ServiceProvider'
    ];

    public function register()
    {
        // APP_ENVがlocalの場合にのみサービス・プロバイダを登録する
        if ($this->app->isLocal()) {
            $this->registerServiceProviders();
        }
    }

    protected function registerServiceProviders()
    {
        foreach ($this->provider as $provider) {
            $this->app->register($provider);
        }
    }

}
