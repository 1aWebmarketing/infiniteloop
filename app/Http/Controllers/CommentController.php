<?php

namespace App\Http\Controllers;

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

        Comment::create($fields);


        return redirect()
            ->route('items.show', [
                'project' => $item->project->id,
                'item' => $fields['item_id']
            ]);
    }
}
