<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://foocart.justinc.dev';

    /**
     * Run setUp for testing
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->prepareForTests();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Initialize test database
     *
     */
    public function prepareForTests()
    {
        Config::set('database.default', 'sqlite_testing');
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }
}
