<?php

namespace SmartDebugger\Commands;

use Illuminate\Console\Command;
use SmartDebugger\Models\ErrorLog;

class AnalyzeErrors extends Command
{
    protected $signature = 'debugger:analyze';
    protected $description = 'Analyze all previous errors and suggest fixes';

    public function handle()
    {
        $errors = ErrorLog::all();
        if ($errors->isEmpty()) {
            $this->info('কোনো এরর পাওয়া যায়নি।');
            return;
        }

        foreach ($errors as $error) {
            $this->line("ফাইল: {$error->file} | লাইন: {$error->line}");
            $this->line("এরর: {$error->message}");
            $this->line("সমাধান: {$error->solution}");
            $this->line("------------------------------");
        }
    }
}
