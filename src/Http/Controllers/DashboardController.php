<?php

namespace FakrulHasan\SmartDebugger\Http\Controllers;

use Illuminate\Routing\Controller;
use FakrulHasan\SmartDebugger\Models\ErrorLog;

class DashboardController extends Controller
{
    public function index()
    {
        $errors = ErrorLog::latest()->paginate(15);

        return view('smart-debugger::dashboard', compact('errors'));
    }
}
