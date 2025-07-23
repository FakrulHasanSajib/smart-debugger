<?php

namespace SmartDebugger\Services;

use OpenAI\Laravel\Facades\OpenAI;

class AIDebugService
{
    public static function getBanglaSolution($errorMessage, $file, $line)
    {
        $prompt = "Laravel error: {$errorMessage} (File: {$file}, Line: {$line}).
        বাংলায় বুঝিয়ে বলো কেন এই এরর হচ্ছে এবং কীভাবে সমাধান করতে হবে।";

        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a Laravel debugging assistant who replies in Bangla.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return $result['choices'][0]['message']['content'] ?? 'সমাধান পাওয়া যায়নি।';
    }
}
