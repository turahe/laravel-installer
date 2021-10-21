<?php

namespace Tests\Integration;

use Orchestra\Testbench\TestCase as Orchestra;
use Turahe\LaravelInstaller\Providers\LaravelInstallerServiceProvider;

/**
 * Class TestCase.
 */
class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelInstallerServiceProvider::class,
        ];
    }
}
