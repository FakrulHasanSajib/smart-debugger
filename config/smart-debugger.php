<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Smart Debugger Settings
    |--------------------------------------------------------------------------
    |
    | এই কনফিগারেশন ফাইলটি দিয়ে তুমি বিভিন্ন সেটিংস কাস্টমাইজ করতে পারবে।
    | যেমন: OpenAI API key, live notification settings ইত্যাদি।
    |
    */

    'openai_api_key' => env('OPENAI_API_KEY', ''),

    'pusher' => [
        'app_id' => env('PUSHER_APP_ID', ''),
        'app_key' => env('PUSHER_APP_KEY', ''),
        'app_secret' => env('PUSHER_APP_SECRET', ''),
        'app_cluster' => env('PUSHER_APP_CLUSTER', 'mt1'),
    ],

    'enable_live_notification' => true,
];
