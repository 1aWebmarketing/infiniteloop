<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\ItemUpvoteService;
use Illuminate\Http\RedirectResponse;

class ItemUpvoteController extends Controller
{
    public function update(Item $item): RedirectResponse
    {
        if (ItemUpvoteService::canUpvote(auth()->user(), $item)) {
            ItemUpvoteService::upvote(auth()->user(), $item);

            return redirect()
                ->route('projects.show', [
                    'project' => $item->project->id,
                ])
                ->with('success', 'Upvoted successfully');
        }

        ItemUpvoteService::downvote(auth()->user(), $item);

        return redirect()
            ->route('projects.show', [
                'project' => $item->project->id,
            ])
            ->with('error', 'Vote removed');
    }
}
