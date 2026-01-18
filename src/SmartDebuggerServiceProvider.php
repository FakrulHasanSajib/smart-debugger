<?php

namespace FakrulHasan\SmartDebugger;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Log\Events\MessageLogged;
use FakrulHasan\SmartDebugger\Models\ErrorLog;

class SmartDebuggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__.'/../config/smart-debugger.php' => config_path('smart-debugger.php'),
        ], 'config');

        // Publish migrations
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

        // Register console commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\AnalyzeErrorsCommand::class,
                Console\SuggestPatchCommand::class,
                Console\QuickFixCommand::class,
                Console\InstallCommand::class,
            ]);
        }

        // ✅ MASTER FIX: Log Listener
        // যখনই লারাভেল কোনো এরর লগ করবে, আমরা সেটা ধরব
        Event::listen(MessageLogged::class, function (MessageLogged $event) {
            
            // চেক করি লগটি কোনো Exception কিনা
            if (isset($event->context['exception']) && $event->context['exception'] instanceof \Throwable) {
                $e = $event->context['exception'];

                try {
                    ErrorLog::create([
                        'error_message' => $e->getMessage(),
                        'stack_trace'   => $e->getTraceAsString(),
                        'file'          => str_replace(base_path().'/', '', $e->getFile()),
                        'line'          => $e->getLine(),
                        'error_code'    => method_exists($e, 'getCode') ? $e->getCode() : null,
                    ]);
                } catch (\Exception $writeError) {
                    // যদি ডেটাবেসে লিখতে সমস্যা হয়, তবে লুপ এড়াতে আমরা ইগনোর করব
                }
            }
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/smart-debugger.php',
            'smart-debugger'
        );
    }
}