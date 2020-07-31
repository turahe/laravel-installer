<?php

namespace Turahe\LaravelInstaller\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Turahe\LaravelInstaller\Middleware\canInstall;
use Turahe\LaravelInstaller\Middleware\canUpdate;

class LaravelInstallerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->publishFiles();
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->mergeConfigFrom(__DIR__.'/../Config/installer.php', 'installer');
//        $this->mapWebRoutes();
    }

    /**
     * Bootstrap the application events.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'installer');
        $router->middlewareGroup('install', [CanInstall::class]);
        $router->middlewareGroup('update', [CanUpdate::class]);
    }

    /**
     * Publish config file for the installer.
     *
     * @return void
     */
    protected function publishFiles()
    {
        if (function_exists('config_path')) { // function not available and 'publish' not relevant in Lumen
            $this->publishes([
                __DIR__ . '/../Config/installer.php' => base_path('config/installer.php'),
            ], 'laravelinstaller');
        }

        $this->publishes([
            __DIR__.'/../assets' => public_path('installer'),
        ], 'laravelinstaller');


        $this->publishes([
            __DIR__.'/../Views' => base_path('resources/views/vendor/installer'),
        ], 'laravelinstaller');

        $this->publishes([
            __DIR__.'/../Lang' => base_path('resources/lang'),
        ], 'laravelinstaller');
    }

}
