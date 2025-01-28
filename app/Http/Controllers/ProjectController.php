<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

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
