<?php

namespace FakrulHasan\SmartDebugger\Console;

use Illuminate\Console\Command;
use FakrulHasan\SmartDebugger\Models\ErrorLog;
use Illuminate\Support\Facades\Http; // API কল করার জন্য এটি লাগবে

class AnalyzeErrorsCommand extends Command
{
    protected $signature = 'smart-debugger:analyze';
    protected $description = 'Analyze the logged errors using Gemini AI';

    public function handle()
    {
        $this->info('Analyzing error logs with AI...');

        // লেটেস্ট ৫টি এরর নেই
        $errors = ErrorLog::latest()->take(5)->get();

        if ($errors->isEmpty()) {
            $this->info('No errors logged yet.');
            return 0;
        }

        foreach ($errors as $error) {
            $this->line("🔴 Error: " . $error->error_message);
            $this->line("📂 File: " . $error->file . " (Line: " . $error->line . ")");

            // ১. প্রথমে কনফিগার ফাইল থেকে চেক করি (লোকাল সল্যুশন)
            $solutions = config('smart-debugger.error_solutions', []);
            $matchedSolution = null;

            foreach ($solutions as $key => $solution) {
                if (stripos($error->error_message, $key) !== false) {
                    $matchedSolution = $solution;
                    break;
                }
            }

            if ($matchedSolution) {
                $this->info("✅ Solution (Local): " . $matchedSolution);
            } 
            else {
                // ২. লোকাল না পেলে Gemini AI কে জিজ্ঞেস করি
                $this->comment("🤖 Asking Gemini AI...");
                $aiSolution = $this->askGemini($error);
                
                if ($aiSolution) {
                    $this->info("✨ AI Suggestion: " . $aiSolution);
                } else {
                    $this->error("❌ Could not get AI suggestion. Check API Key.");
                }
            }

            $this->line(str_repeat('-', 50));
        }

        return 0;
    }

private function askGemini($error)
    {
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            $this->error("GEMINI_API_KEY is missing in .env file!");
            return null;
        }

        // প্রম্পট: আমরা এরর ডিটেইলস দিচ্ছি এবং বাংলায় সমাধান চাচ্ছি
        $prompt = "I have a Laravel Error: '{$error->error_message}' in file '{$error->file}' at line {$error->line}. 
        Please explain why this happens and give a code solution in Bengali (Bangla). Keep it short and precise.";

        // ✅ ফিক্স: আপনার লিস্ট থেকে পাওয়া সঠিক মডেলের নাম ব্যবহার করা হলো
        $modelName = 'gemini-2.5-flash'; 
        
        try {
            // SSL ভেরিফিকেশন অফ রাখা হয়েছে যাতে লোকাল পিসিতে সমস্যা না হয়
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])->post("https://generativelanguage.googleapis.com/v1beta/models/{$modelName}:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]);

            $data = $response->json();

            // যদি এখনো কোনো এরর আসে, সেটা দেখাবে
            if (isset($data['error'])) {
                $this->error("API Error: " . $data['error']['message']);
                return null;
            }

            // সঠিক উত্তর রিটার্ন করা
            return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        } catch (\Exception $e) {
            $this->error("System Error: " . $e->getMessage());
            return null;
        }
    }
}