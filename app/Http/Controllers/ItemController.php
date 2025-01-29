<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Project;
use Illuminate\Support\Facades\Cache;

class ItemController extends Controller
{
    public function show(Request $request, Project $project, Item $item)
    {
        return view('items/show', [
            'item' => $item
        ]);
    }

    public function create(Request $request, Project $project)
    {
        $item = new Item;
        $item->project_id = $project->id;
        $item->story = '<h2 dir="auto">Beschreibung (Haupt User Story):</h2>
        <p dir="auto">[WAS WILLST DU MACHEN UM WAS ZU ERREICHEN?]</p>
        <h2 dir="auto">Akzeptanzkriterien:</h2>
        <p dir="auto">[WAS MUSS ERFOLGREICH PASSIEREN, DAMIT DIESE USER STORY ABGESCHLOSSEN WERDEN KANN]</p>
        <h2 dir="auto">Zus&auml;tzliche Informationen oder Abh&auml;ngigkeiten:</h2>
        <p>[MEHR INFORMATIONEN]</p>';

        return view('items/form', [
            'item' => $item,
        ]);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string',
            'project_id' => 'required',
            'story' => 'required|string',
            'priority' => 'required',
            'type' => 'required',
        ]);

        $fields['user_id'] = auth()->id();

        Item::create($fields);


        return redirect()
            ->route('projects.show', [
                'project' => $fields['project_id']
            ]);
    }

    public function upvote(Item $item)
    {
        if( Cache::get('user-' . auth()->id() . '-item-' . $item->id) )
        {
            return redirect()
                ->route('projects.show', [
                    'project' => $item->project->id,
                ]);
        }

        $item->increment('voting');

        Cache::put('user-' . auth()->id() . '-item-' . $item->id, 1);

        return redirect()
            ->route('projects.show', [
                'project' => $item->project->id,
            ]);
    }
}
