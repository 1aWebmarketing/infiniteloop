<?php

use App\Services\QueueWorker;
use Illuminate\Support\Facades\Schedule;

Schedule::call(new QueueWorker)->everyMinute()->name('QueueWorker::_invoke');
