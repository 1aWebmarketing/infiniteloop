<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewCommentNotification;
use App\Services\ChatGPTService;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Item $item)
    {
        $fields = $request->validate([
            'text' => 'required|string',
        ]);

        $fields['item_id'] = $item->id;
        $fields['user_id'] = auth()->id();

        $comment = Comment::create($fields);

        SendNewCommentNotification::dispatch($item, $comment);

        if(!str_contains($fields['text'], '/ki') === false){
            $fields['text'] = str_replace('/ki', '', $fields['text']);
            ChatGPTService::optimizeItem($item, $fields['text']);
        }

        return redirect()
            ->route('items.show', [
                'project' => $item->project->id,
                'item' => $item->uuid
            ]);
    }
}
