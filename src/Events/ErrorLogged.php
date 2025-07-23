<?php

namespace SmartDebugger\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ErrorLogged
{
    use Dispatchable, SerializesModels;

    public $error;

    public function __construct($error)
    {
        $this->error = $error;
    }
}
