<?php

namespace FakrulHasan\SmartDebugger\Console;

use Illuminate\Console\Command;
use FakrulHasan\SmartDebugger\Models\ErrorLog;
use Illuminate\Support\Facades\File;

class SuggestPatchCommand extends Command
{
    protected $signature = 'smart-debugger:patch';
    protected $description = 'Generate Git patch suggestion for recent errors';

    public function handle()
    {
        $this->info('Generating git patch suggestion...');

        $error = ErrorLog::latest()->first();

        if (!$error) {
            $this->info('No errors to generate patch for.');
            return 0;
        }

        $patchContent = $this->generatePatch($error);

        $patchFile = base_path('smart-debugger-fix.patch');
        File::put($patchFile, $patchContent);

        $this->info("Patch file generated at: {$patchFile}");
        return 0;
    }

    protected function generatePatch(ErrorLog $error)
    {
        $patch = <<<PATCH
From abcdef1234567890 Mon Sep 17 00:00:00 2001
From: Smart Debugger <no-reply@smartdebugger.dev>
Date: Thu, 24 Jul 2025 12:00:00 +0600
Subject: [PATCH] Fix suggested for error: {$error->error_message}

---
 // Please manually check and fix the code at {$error->file} line {$error->line}
-- 
1.9.1
PATCH;

        return $patch;
    }
}
