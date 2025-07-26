<?php

namespace FakrulHasan\SmartDebugger\Middleware;

use Closure;
use FakrulHasan\SmartDebugger\Models\ErrorLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CaptureErrorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (\Throwable $e) {
            ErrorLog::create([
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
                'file' => str_replace(base_path().'/', '', $e->getFile()),
                'line' => $e->getLine(),
                'error_code' => method_exists($e, 'getCode') ? $e->getCode() : null,
            ]);

            Log::error($e);

            throw $e;
        }
    }
}
