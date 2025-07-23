<?php

namespace SmartDebugger\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $fillable = [
        'file', 'line', 'message', 'solution'
    ];
}
