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

        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/phpsoft.base'),
        ]);

        // Publish config files
        $this->publishes([
            __DIR__ . '/../config/jwt.php' => config_path('jwt.php'),
            __DIR__ . '/../config/entrust.php' => config_path('entrust.php'),
        ]);

        // Register commands
        $this->commands('phpsoft.base.command.migration');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->bindShared('phpsoft.base.command.migration', function () {
            return new MigrationCommand();
        });
    }
}
