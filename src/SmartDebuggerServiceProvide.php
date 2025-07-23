<?php

namespace SmartDebugger;

use Illuminate\Support\ServiceProvider;

class SmartDebuggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $laravelVersion = app()->version();

        // Laravel version অনুযায়ী route ফাইল লোড করা
        if (version_compare($laravelVersion, '11.0.0', '<')) {
            // Laravel 9 এবং 10 এর জন্য
            $this->loadRoutesFrom(__DIR__ . '/routes_v9_to_10.php');
        } else {
            // Laravel 11 এবং 12 এর জন্য
            $this->loadRoutesFrom(__DIR__ . '/routes_v11_plus.php');
        }

        // Config publish
        $this->publishes([
            __DIR__.'/config/smartdebugger.php' => config_path('smartdebugger.php'),
        ], 'config');

        // View publish (যদি থাকে)
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/smartdebugger'),
        ], 'views');

        // Lang publish (যদি থাকে)
        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/smartdebugger'),
        ], 'lang');

        // অন্য যেকোন initialization এখানে দিবে
    }

    public function register()
    {
        // Configuration merge করতে পারো এখানে
        $this->mergeConfigFrom(
            __DIR__.'/config/smartdebugger.php', 'smartdebugger'
        );
    }
}
