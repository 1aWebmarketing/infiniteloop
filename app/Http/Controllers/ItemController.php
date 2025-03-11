<?php

namespace App\Http\Controllers;

use App\Services\ChatGPTService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Project;
use App\Services\ItemUpvoteService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use League\HTMLToMarkdown\HtmlConverter;

class ItemController extends Controller
{
    public function show(Request $request, Project $project, Item $item)
    {
        if($request->user()->cannot('viewAny', $item)) {
            abort(403, 'Operation failed successfully');
        }

        view()->share('metaTitle', $item->title);

//        $converter = new HtmlConverter(['header_style' => 'atx']);
//        $markdown = $converter->convert($item->story);
//        $item->markdown = preg_replace('/\\\\([\\[\\]])/', '$1', $markdown);

        $creativesMarkdown = "";

        if($item->creatives->count())
        {
            $creativesMarkdown = "\n\n## Creatives\n\n";

            foreach($item->creatives as $creative) {
                if($creative->type === 'IMAGE') {
                    $creativesMarkdown .= "![" . Str::replace(['[', ']'], ['\[', '\]'], $creative->name) . "](" . asset('storage/' . $creative->path) . ")\n";
                } else
                {
                    $creativesMarkdown .= "[" . Str::replace(['[', ']'], ['\[', '\]'], $creative->name) . "](" . asset('storage/' . $creative->path) . ")\n";
                }
            }
        }

        $item->story_w_creatives = ($item->translated['story'] ?? '') . $creativesMarkdown;

        return view('items/show', [
            'item' => $item,
            'editable' => $request->user()->can('update', $item),
        ]);
    }

    public function create(Request $request, Project $project)
    {
        view()->share('metaTitle', __('items.create'));

        $item = Item::create([
            'project_id' => $project->id,
            'user_id' => auth()->id(),
            'title' => 'New Feature ' . Carbon::now()->format('d.m.Y H:i'),
            'story' => $project->template,
        ]);

        return redirect()
            ->route('items.edit', [
                'project' => $project,
                'item' => $item
            ]);

//        $s = '<h2 dir="auto">Beschreibung (Haupt User Story):</h2>
//        <p dir="auto">[WAS WILLST DU MACHEN UM WAS ZU ERREICHEN?]</p>
//        <h2 dir="auto">Akzeptanzkriterien:</h2>
//        <p dir="auto">[WAS MUSS ERFOLGREICH PASSIEREN, DAMIT DIESE USER STORY ABGESCHLOSSEN WERDEN KANN]</p>
//        <h2 dir="auto">Zus&auml;tzliche Informationen oder Abh&auml;ngigkeiten:</h2>
//        <p>[MEHR INFORMATIONEN]</p>';
//
//        return view('items/form', [
//            'item' => $item,
//        ]);
    }

    public function edit(Request $request, Project $project, Item $item)
    {
        if( $request->user()->cannot('update', $item) ) {
            abort(403);
        }

        view()->share('metaTitle', __('items.edit'));

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
        $fields['translated'] = ChatGPTService::translateAndMarkdown($fields['title'], $fields['story']);

        $item = Item::create($fields);

        ItemUpvoteService::upvote(auth()->user(), $item);

        return redirect()
            ->route('projects.show', [
                'project' => $fields['project_id']
            ]);
    }
    public function update(Request $request, Project $project, Item $item)
    {
        if( $request->user()->cannot('update', $item) ) {
            abort(403);
        }

        $fields = $request->validate([
            'title' => 'required|string',
            'story' => 'required|string',
            'priority' => 'required',
            'type' => 'required',
        ]);

        $fields['translated'] = ChatGPTService::translateAndMarkdown($fields['title'], $fields['story']);

        $item->update($fields);

        return redirect()
            ->route('projects.show', [
                'project' => $item->project_id,
            ]);
    }

    public function upvote(Item $item)
    {
        if( ItemUpvoteService::canUpvote(auth()->user(), $item) )
        {
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

    public function destroy(Request $request, Project $project, Item $item)
    {
        if( $request->user()->cannot('delete', $item) ) {
            abort(403);
        }

        $item->delete();

        return redirect()
            ->route('projects.show', [
                'project' => $project->id,
            ]);
    }
}
