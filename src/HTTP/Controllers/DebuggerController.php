<?php

namespace SmartDebugger\Http\Controllers;

use Illuminate\Routing\Controller;
use SmartDebugger\Models\ErrorLog;

class DebuggerController extends Controller
{
    public function index()
    {
        $errors = ErrorLog::latest()->get();
        return view('smart-debugger::dashboard', compact('errors'));
    }
}
