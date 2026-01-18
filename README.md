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
