<?php

use Carbon\Carbon;
use App\Services\ItemUpvoteService;
use App\Models\User;
use App\Models\Item;

function formatDateTime(Carbon $carbon) : string
{
    return $carbon->timezone(config('app.timezone'))->format('d.m.Y H:i');
}

function canUpvote(User $user, Item $item) : bool
{
    return ItemUpvoteService::canUpvote($user, $item);
}
