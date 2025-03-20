<?php

namespace App\Http\Controllers;

use App\Models\Project;

class DashboardController extends Controller
{
    public function __invoke()
    {
        view()->share('metaTitle', 'Projects');

        $projects = Project::where('team_id', auth()->user()->current_team_id)
            ->withCount('items') // Count items
            ->with('items.comments') // Eager load items and their comments
            ->get();

        // Add the total comment count for each project
        $projects->each(function ($project) {
            $project->total_comments = $project->items->sum(fn ($item) => $item->comments->count());
            $project->activeItemsCount = $project->items()->statusInProgress()->count();
            $project->createdItemsCount = $project->items()->statusCreated()->count();
            $project->doneItemsCount = $project->items()->statusDone()->count();
        });

        return view('dashboard/dashboard', [
            'projects' => $projects,
        ]);
    }
}
