<?php

namespace FakrulHasan\SmartDebugger\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $fillable = [
        'error_message',
        'stack_trace',
        'file',
        'line',
        'error_code',
    ];
}
