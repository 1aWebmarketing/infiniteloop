<?php

use Carbon\Carbon;

function formatDateTime(Carbon $carbon)
{
    return $carbon->timezone(config('app.timezone'))->format('d.m.Y H:i');
}
