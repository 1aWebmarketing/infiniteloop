<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\Item;

class ItemUpvoteService
{
    public static function canUpvote(User $user, Item $item) : bool
    {
        if( Cache::get('user-' . $user->id . '-item-' . $item->id) )
        {
            return false;
        }

        return true;
    }

    public static function upvote(User $user, Item $item)
    {
        $item->increment('voting');
        Cache::put('user-' . $user->id . '-item-' . $item->id, 1);
    }
}
