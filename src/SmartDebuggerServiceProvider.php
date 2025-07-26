<?php

namespace FakrulHasan\SmartDebugger;

use Illuminate\Support\ServiceProvider;

class SmartDebuggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/smart-debugger.php' => config_path('smart-debugger.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/smart-debugger'),
        ], 'views');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'smart-debugger');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\AnalyzeErrorsCommand::class,
                Console\SuggestPatchCommand::class,
                Console\QuickFixCommand::class,
                Console\InstallCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/smart-debugger.php',
            'smart-debugger'
        );
    }
}
