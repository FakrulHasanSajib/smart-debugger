<?php

namespace SmartDebugger;

use Illuminate\Support\ServiceProvider;

class SmartDebuggerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/smart-debugger.php', 'smart-debugger');
    }

    public function boot()
    {
        // Publish config & migration
        $this->publishes([
            __DIR__.'/../config/smart-debugger.php' => config_path('smart-debugger.php'),
        ], 'smart-debugger');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'smart-debugger');

        // Load routes & views
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'smart-debugger');
    }
}
