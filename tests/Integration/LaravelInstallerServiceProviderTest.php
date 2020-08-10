<?php


namespace Tests\Integration;

class LaravelInstallerServiceProviderTest extends TestCase
{
    /** @test */
    public function it_has_config_file()
    {
        $this->assertTrue(is_array(config('installer')));
    }
}
