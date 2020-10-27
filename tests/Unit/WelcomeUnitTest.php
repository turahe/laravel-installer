<?php


namespace Tests\Unit;

use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase as Orchestra;

class WelcomeUnitTest extends Orchestra
{
    /** @test */
    public function it_can_show_all_the_brands()
    {
        $router = $this->getRouter();

        $router->get('welcome', 'Turahe\LaravelInstaller\Controllers\WelcomeController@welcome')
            ->name('install.welcome');

    }
    protected function getLastRouteMiddlewareFromRouter($router)
    {
        return last($router->getRoutes()->get())->middleware();
    }

    protected function getRouter()
    {
        return app('router');
    }

    protected function getRouteResponse()
    {
        return function () {
            return (new Response())->setContent('<html></html>');
        };
    }
}
