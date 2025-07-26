<?php

namespace FakrulHasan\SmartDebugger;

use Illuminate\Support\ServiceProvider;

class SmartDebuggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__.'/../config/smart-debugger.php' => config_path('smart-debugger.php'),
        ], 'config');

        // Publish migration files
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'migrations');

        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/smart-debugger'),
        ], 'views');

        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'smart-debugger');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Register commands if running in console
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\AnalyzeErrorsCommand::class,
                Console\SuggestPatchCommand::class,
                Console\QuickFixCommand::class,
                Console\InstallCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Merge config file so user can override
        $this->mergeConfigFrom(
            __DIR__.'/../config/smart-debugger.php',
            'smart-debugger'
        );
    }
}
