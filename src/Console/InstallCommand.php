<?php

namespace FakrulHasan\SmartDebugger\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'smart-debugger:install';
    protected $description = 'Install Smart Debugger package';

    public function handle()
    {
        $this->info('Publishing config, migrations, and views...');
        $this->call('vendor:publish', ['--tag' => 'config', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'migrations', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'views', '--force' => true]);

        $this->info('Running migrations...');
        $this->call('migrate');

        $this->info('Smart Debugger installed successfully!');
        return 0;
    }
}
