<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class QueueWorker
{
    public function __invoke()
    {
        Artisan::call('queue:work --stop-when-empty');
    }
}
