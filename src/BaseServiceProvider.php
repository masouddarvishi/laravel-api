<?php

namespace Hooraweb\LaravelApi;

use Hooraweb\LaravelApi\Models\Permission;
use Hooraweb\LaravelApi\Models\Role;
use Hooraweb\LaravelApi\Models\Tag;
use Hooraweb\LaravelApi\Models\Taxonomy;
use Hooraweb\LaravelApi\Models\User;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
//        $this->mergeConfigFrom(__DIR__ . '/config/laravel-api.php', 'laravel-api');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->loadFactoriesFrom(__DIR__ . '/database/factories');

        $this->publishes([
//            __DIR__.'/config/base-auth.php' => config_path('base-auth.php'),
//            __DIR__.'/Helpers/enum.php' => base_path('app/Helper/enum.php')
//            __DIR__ . '/database/migrations/' => database_path('migrations')
        ]);
    }

    public function register()
    {

        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('User', User::class);
            $loader->alias('Role', Role::class);
            $loader->alias('Permission', Permission::class);
            $loader->alias('Tag', Tag::class);
            $loader->alias('Taxonomy', Taxonomy::class);
        });
    }
}