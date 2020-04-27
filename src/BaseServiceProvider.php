<?php

namespace Hooraweb\Base;

use Hooraweb\Base\Models\User;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->publishes([
            __DIR__.'/config/base-auth.php' => config_path('base-auth.php'),
            __DIR__.'/Helpers/enum.php' => base_path('app/Helper/enum.php')
        ]);
    }

    public function register()
    {

        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('UserModal', User::class);
        });
    }
}