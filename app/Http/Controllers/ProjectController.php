<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::withCount('items') // Count items
                   ->with('items.comments') // Eager load items and their comments
                   ->get();

        // Add the total comment count for each project
        $projects->each(function($project) {
            $project->total_comments = $project->items->sum(fn($item) => $item->comments->count());
        });

        return view('projects/index', [
            'projects' => $projects,
        ]);
    }

    public function show(Project $project)
    {
        return view('projects/show', [
            'project' => $project,
        ]);
    }

    public function create(Request $request)
    {
        $project = new Project;

        $project->template = '<h2 dir="auto">Beschreibung (Haupt User Story):</h2>
        <p dir="auto">[WAS WILLST DU MACHEN UM WAS ZU ERREICHEN?]</p>
        <h2 dir="auto">Akzeptanzkriterien:</h2>
        <p dir="auto">[WAS MUSS ERFOLGREICH PASSIEREN, DAMIT DIESE USER STORY ABGESCHLOSSEN WERDEN KANN]</p>
        <h2 dir="auto">Zus&auml;tzliche Informationen oder Abh&auml;ngigkeiten:</h2>
        <p>[MEHR INFORMATIONEN]</p>';

        return view('projects/form', [
            'project' => $project,
        ]);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'mimes:jpg,jpeg,png,gif|max:20000',
            'description' => 'required|string',
            'template' => 'required|string',
        ]);

        if ($request->file('file')) {
            $path = $request->file('file')->store('projects', 'public'); // Stores in storage/app/public/uploads
            $fields['logo'] = $path;
        }

        $fields['user_id'] = auth()->id();

        Project::create($fields);

        return redirect()
            ->route('dashboard');
    }

    public function edit(Request $request, Project $project)
    {
        Gate::authorize('edit-project', $project);

        return view('projects/form', [
            'project' => $project,
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'mimes:jpg,jpeg,png,gif|max:20000',
            'description' => 'required|string',
            'template' => 'required|string',
        ]);

        if ($request->file('file')) {
            $path = $request->file('file')->store('projects', 'public'); // Stores in storage/app/public/uploads
            $fields['logo'] = $path;
        }

        $project->update($fields);

        return redirect()
            ->route('dashboard');
    }

    public function destroy(Project $project)
    {
        Gate::authorize('edit-project', $project);

        $project->delete();

        return redirect()
            ->route('dashboard');
    }
}
