<?php

declare(strict_types=1);

namespace ArielMejiaDev\LarapexCharts\Tests;

use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use ArielMejiaDev\LarapexCharts\LarapexChartsServiceProvider;
use Illuminate\Support\Facades\File;

class TestCase extends TestbenchTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        File::deleteDirectory(resource_path('views/vendor/larapex-charts'));
    }

    /**
     * Sets the env data to interact as env file values
     *
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connection.testing', [
            'driver'    => 'sqlite',
            'database'  => ':memory:'
        ]);
    }

    // set providers to test the class
    protected function getPackageProviders($app): array
    {
        return [
            LarapexChartsServiceProvider::class,
        ];
    }

    // With this method I can use the facade instead of all class namespace
    protected function getPackageAliases($app): array
    {
        return [
            'LarapexChart' => LarapexChart::class
        ];
    }

}
