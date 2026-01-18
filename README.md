# Smart Debugger - Laravel AI Error Analyzer

**Smart Debugger** is a powerful Laravel package that captures application errors in real-time and uses **Google Gemini AI** to analyze them and provide **smart solutions in Bengali**.

It logs errors into the database and provides a dedicated dashboard to view them. You can also run a simple artisan command to ask AI for a fix!

---

## 🚀 Features

- **Auto Error Capture:** Automatically listens to Laravel logs and saves errors to the database.
- **Smart Dashboard:** View all errors in a clean UI at `/smart-debugger/dashboard`.
- **AI-Powered Analysis:** Uses Google Gemini AI (Model: `gemini-2.5-flash`) to analyze errors.
- **Bengali Solutions:** Provides code fixes and explanations in **Bengali (Bangla)**.
- **One-Command Fix:** Analyze errors directly from the terminal.
- **SSL Bypass:** Optimized for local development environments (fixes SSL certificate issues).

---

## 📦 Installation

You can install the package via composer:

```bash
composer require fakrulhasan/smart-debugger
1. Publish Assets & Config
Publish the configuration file, migrations, and assets using the following command:

Bash

php artisan vendor:publish --provider="FakrulHasan\SmartDebugger\SmartDebuggerServiceProvider"
2. Run Migrations
Create the necessary tables for logging errors:

Bash

php artisan migrate
⚙️ Configuration
1. Get Google Gemini API Key
To use the AI features, you need a Google Gemini API Key.

Go to Google AI Studio

Create a new API Key (it's free!).

2. Set Environment Variable
Open your project's .env file and add the API key:

Code snippet

GEMINI_API_KEY=your_google_gemini_api_key_here
🛠 Usage
🔍 1. View Error Dashboard
Visit the following URL in your browser to see the list of captured errors: http://your-project.test/smart-debugger/dashboard

🤖 2. Analyze Errors with AI
To get an AI-generated solution for your latest errors, run:

Bash

php artisan smart-debugger:analyze
Output Example:

Plaintext

Analyzing error logs with AI...

🔴 Error: Division by zero
📂 File: routes/web.php (Line: 16)

✨ AI Suggestion:
আপনার Laravel প্রোজেক্টে 'Division by zero' ত্রুটিটি দেখাচ্ছে...
সমাধান: ভাগ করার আগে ভাজক শূন্য কিনা তা চেক করুন।

Code Solution:
if ($divisor == 0) { ... }
🔧 Troubleshooting
Q: AI is returning "Not Found" error. A: Make sure you have set the correct GEMINI_API_KEY in your .env file and run php artisan config:clear.

Q: Errors are not showing in the dashboard. A: Ensure you have run php artisan migrate. The package uses Laravel's default logging system, so make sure your LOG_CHANNEL in .env is set to stack or daily.

📄 License
The MIT License (MIT). Please see License File for more information.

👨‍💻 Author
Fakrul Hasan - GitHub:
