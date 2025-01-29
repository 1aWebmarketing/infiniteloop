<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

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
}
