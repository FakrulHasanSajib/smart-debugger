<?php

namespace FakrulHasan\SmartDebugger\Console;

use Illuminate\Console\Command;

class QuickFixCommand extends Command
{
    protected $signature = 'smart-debugger:fix {type=common}';
    protected $description = 'Quick fix common Laravel errors';

    public function handle()
    {
        $type = $this->argument('type');

        if ($type === 'common') {
            $this->info('Running quick fixes: cache clear, config clear, route clear, view clear');

            $this->call('cache:clear');
            $this->call('config:clear');
            $this->call('route:clear');
            $this->call('view:clear');

            $this->info('Quick fixes done!');
        } else {
            $this->error("Unknown fix type: {$type}");
        }

        return 0;
    }
}
