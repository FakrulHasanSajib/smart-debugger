<?php

namespace FakrulHasan\SmartDebugger\Console;

use Illuminate\Console\Command;
use FakrulHasan\SmartDebugger\Models\ErrorLog;

class AnalyzeErrorsCommand extends Command
{
    protected $signature = 'smart-debugger:analyze';
    protected $description = 'Analyze the logged errors and suggest solutions';

    public function handle()
    {
        $this->info('Analyzing error logs...');

        $errors = ErrorLog::latest()->take(10)->get();

        if ($errors->isEmpty()) {
            $this->info('No errors logged yet.');
            return 0;
        }

        $solutions = config('smart-debugger.error_solutions');

        foreach ($errors as $error) {
            $this->line("Error: " . $error->error_message);

            $matchedSolution = null;
            foreach ($solutions as $key => $solution) {
                if (stripos($error->error_message, $key) !== false) {
                    $matchedSolution = $solution;
                    break;
                }
            }

            if ($matchedSolution) {
                $this->line("Solution (বাংলায়): " . $matchedSolution);
            } else {
                $this->line("Solution: No suggestion available.");
            }

            $this->line(str_repeat('-', 40));
        }

        return 0;
    }
}
