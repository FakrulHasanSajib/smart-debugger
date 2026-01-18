<?php

return [
    'enable_toast' => true,
    'error_solutions' => [
        'SQLSTATE[42S02]' => 'ডাটাবেজে টেবিল পাওয়া যায়নি। মাইগ্রেশন চালান: php artisan migrate',
        'Class not found' => 'নেমস্পেস ঠিক আছে কিনা চেক করুন অথবা composer dump-autoload চালান।',
        'Method not found' => 'মেথডটি ক্লাসে নেই, কোড ঠিকমত লিখেছেন কিনা দেখুন।',
        // আরও সাধারণ Error ও সমাধান এখানে যোগ করতে পারবেন
    ],
];
