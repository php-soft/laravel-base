<?php

namespace PhpSoft\Base\Providers;

use Illuminate\Support\ServiceProvider;
use PhpSoft\Base\Commands\MigrationCommand;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        // Set views path
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'phpsoft.base');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
    }
}
